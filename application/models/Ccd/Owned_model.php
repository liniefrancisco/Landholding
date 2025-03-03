<?php
class Owned_model extends CI_Model{
  //==================================================
  //DATATABLES
  //==================================================
  function __construct() {
    // Set table name
    $this->table = "land_info";
    // Set orderable column fields
    if ($this->uri->segment(3) == 'get_owned_land') {
        $this->column_order = array('lot', 'street', 'lot_type', 'lot_size', 'tag');
    }
    // Set searchable column fields
    if($this->uri->segment(3) == 'get_owned_land'){
      $this->column_search = array('land_info.is_no','street', 'baranggay', 'municipality', 'province',"concat(street,', ',baranggay,', ',municipality,', ',province)", 'date_approved', 'lot', 'lot_type', 'lot_size', 'tag');
    }
    // Set default order
    $this->order = array('land_info.is_no' => 'desc');
  }
    
  /*
   * Fetch members data from the database
   * @param $_POST filter data based on the posted parameters
   */
  public function getRows($postData){
    $this->_get_datatables_query($postData);
    if($postData['length'] != -1){
      $this->db->limit($postData['length'], $postData['start']);
    }
    $query = $this->db->get();
    return $query->result();
  }

  /*
   * Count all records
   */
  public function countAll(){
    $this->db->from($this->table);
    return $this->db->count_all_results();
  }
    
  /*
   * Count records based on the filter params
   * @param $_POST filter data based on the posted parameters
   */
  public function countFiltered($postData){
    $this->_get_datatables_query($postData);
    $query = $this->db->get();
    return $query->num_rows();
  }

  function count_all_owned_list() {
    $this->db->from('uploaded_documents');
    $this->db->where('status','Checked Documents');
    return $this->db->count_all_results();
  }
    
  /*
   * Perform the SQL queries needed for an server-side processing requested
   * @param $_POST filter data based on the posted parameters
   */
  private function _get_datatables_query($postData){
    $this->db
    ->from('land_info')
    ->join('lot_location', 'lot_location.is_no = land_info.is_no', 'left')
    ->join('uploaded_documents', 'uploaded_documents.is_no = land_info.is_no', 'left')
    ->join( 'owner_info', 'owner_info.is_no = land_info.is_no', 'left')
    ->where('land_info.tag', 'New')
    ->where('land_info.status', 'Approved')
    ->where('uploaded_documents.status', 'Checked Documents');
 
    $i = 0;
    // loop searchable columns 
    foreach($this->column_search as $item){
      // if datatable send POST for search
      if($postData['search']['value']){
        // first loop
        if($i===0){
          // open bracket
          $this->db->group_start();
          $this->db->like($item, $postData['search']['value']);
        }else{
          $this->db->or_like($item, $postData['search']['value']);
        }
             
        // last loop
        if(count($this->column_search) - 1 == $i){
          // close bracket
          $this->db->group_end();
        }
      }
      $i++;
    }
         
    if(isset($postData['order'])){
      $this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
    }else if(isset($this->order)){
      $order = $this->order;
      $this->db->order_by(key($order), $order[key($order)]);
    }
  }
  //==================================================
  //END DATATABLES
  //==================================================

	//==================================================
  //QUERY
  //==================================================
  public function getli_status_pending(){
    $query = $this->db->query("SELECT * FROM land_info WHERE tag='New'  AND status='Pending' AND tag= 'New'");
    return $query->num_rows();
  }
  public function getud_status_pending(){
    $query = $this->db->query("SELECT status FROM uploaded_documents WHERE status='Pending Documents' ");
    return $query->num_rows();
  }
   public function getud_status_checked(){
    $query = $this->db->query("SELECT status FROM uploaded_documents WHERE status='Checked Documents' ");
    return $query->num_rows();
  }
  //==================================================
  //END QUERY
  //==================================================

  //==================================================
  //MESSAGE NOTIFICATION
  //==================================================
  public function get_all_notification_no($recpt){
    $sql = "SELECT * FROM notification WHERE recipient = ? ";
    $query = $this->db->query($sql, array($recpt));
    return $query->num_rows();
  }
  public function get_notif_per_user($recp){
    $query = $this->db->get_where('notification', array('recipient'=> $recp));
    return $query->result_array();
  }
  //==================================================
  //END MESSAGE NOTIFICATION
  //==================================================
}