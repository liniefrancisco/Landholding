<?php 
class Legal_model extends CI_Model{
  public function getregistry_land(){
    $query = $this->db->query("SELECT * FROM land_info WHERE status='Approved' ");
    return $query->result_array();
  }
  public function getowner_info(){
    $query = $this->db->get('owner_info');
    return $query->result_array();
  }
  public function getlot_location(){
    $query = $this->db->get('lot_location');
    return $query->result_array();
  }
  public function getli_byid($id){
    $query = $this->db->get_where('land_info', array('is_no'=> $id));
    return $query->row_array();
  }
  public function getoi_byid($id){
    $query = $this->db->get_where('owner_info', array('is_no'=> $id));
    return $query->row_array();
  }
  public function getll_byid($id){
    $query = $this->db->get_where('lot_location', array('is_no'=> $id));
    return $query->row_array();
  }
  public function getcp_byid($id){
    $query = $this->db->get_where('contact_person', array('owner_id'=> $id));
    return $query->row_array();
  }
  public function getud_byid($id){
    $query = $this->db->get_where('uploaded_documents', array('is_no'=> $id));
    return $query->row_array();
  }
  public function get_paid_rpt($id){
    $sql = "SELECT * from real_property_tax where is_no = ? ";
    $query = $this->db->query($sql, array($id));
    return $query->result_array();
  }
  public function getesupload_byid($id){
    $query = $this->db->get_where('es_uploads', array('reference_id'=> $id));
    return $query->row_array();
  }
  public function getlpf_reqbyid($id){
    $sql = "SELECT * from request_check_payment where  is_no = ? ";
    $query = $this->db->query($sql, array($id));
    return $query->row_array();     
  }
  public function getca_purpose($id){
    $sql= "SELECT purpose, other_purpose, reference_no from payment_requests where rcp_no = ? ";
    $query = $this->db->query($sql, array($id));
    return $query->result_array();
  }

  public function getland_info(){
    $query = $this->db->query("SELECT * FROM land_info WHERE tag='New'  AND status='Pending'");
    return $query->result_array();
  }
  public function getcontact_person(){
    $query = $this->db->get('contact_person');
    return $query->result_array();
  }
  public function getli_status_approved(){
    $query = $this->db->query("SELECT status FROM land_info WHERE status='Approved' and tag = 'New'");
    return $query->num_rows(); 
  }
  public function getli_status_disapproved(){
    $query = $this->db->query("SELECT status FROM land_info WHERE status='Disapproved' AND tag = 'New'");
    return $query->num_rows(); 
  }
  public function getnum_pending_payment_requests(){
    $query= $this->db->query("SELECT * from payment_requests where status = 'Pending'");
    return $query->num_rows();      
  }
  public function getpending_rcp_numrows(){
    $query= $this->db->query("SELECT status from request_check_payment WHERE  status = 'Pending' ");
    return $query->num_rows();
  }
  public function get_pending_es_aspayment(){
    $query = $this->db->query("SELECT status FROM land_info WHERE status='Pending' AND tag='New LAPF-ES' ");
    return $query->num_rows(); 
  }
  public function get_pending_js_aspayment(){
    $query = $this->db->query("SELECT status FROM land_info WHERE status='Pending' AND tag='New LAPF-JS' ");
    return $query->num_rows(); 
  }
  public function get_disapproved_es_aspayment(){
    $query = $this->db->query("SELECT status FROM land_info WHERE status='Disapproved' AND tag='New LAPF-ES' ");
    return $query->num_rows(); 
  }
  public function get_disapproved_js_aspayment(){
    $query = $this->db->query("SELECT status FROM land_info WHERE status='Disapproved' AND tag='New LAPF-JS' ");
    return $query->num_rows(); 
  }
  public function getrstr_byid($id){
    $query = $this->db->get_where('restrictions_to_land_title', array('is_no'=> $id));
    return $query->row_array();
  }
  public function getamount_basis_byid($id){
    $query = $this->db->get_where('amount_basis', array('reference_id'=> $id));
    return $query->row_array();
  }
  public function getbidding_byid($id){
    $query = $this->db->get_where('bidding_details', array('reference_id'=> $id));
    return $query->row_array();
  }
  public function getcustomer_byid($id){
    $query = $this->db->get_where('customer_info', array('reference_id'=> $id));
    return $query->row_array();
  }
  public function getcusbalinf_byid($id){
    $query = $this->db->get_where('customer_bal_info', array('reference_id'=> $id));
    return $query->row_array();
  }
  public function getcusaddr_byid($id){
    $query = $this->db->get_where('customer_address', array('customer_id'=> $id));
    return $query->row_array();
  }
  public function getca_details($id){
    $sql = "SELECT reference_no, amount, ca_no, remaining_balance from payment_transaction where rcp_no = ? ORDER BY transaction_date ASC ";
    $query = $this->db->query($sql, array($id));
    return $query->result_array();
  }
  public function get_assessment($is_no){
    $sql = "SELECT percentage FROM assessment_level WHERE is_no = ? ";
    $query = $this->db->query($sql, array($is_no));
    return $query->row_array();
  }
  public function getoa_byid($id){
    $query = $this->db->get_where('owner_address', array('owner_id'=> $id));
    return $query->row_array();
  }
  public function getli_approved(){
    $query = $this->db->query("SELECT * FROM land_info WHERE status='Approved' AND tag='New'");
    return $query->result_array();
  }
  public function get_all_li(){
    $query = $this->db->from('land_info')->where('tag','New')->get();
    return $query->result_array();
  }
  public function getnum_payment_disapproved(){
    $query= $this->db->query("SELECT * from payment_requests where status = 'Disapproved'");
    return $query->num_rows();      
  } 
  public function checked_docu($id, $name){
    $data = array(
      'status' => "Checked Documents",
      'checked_by' => $name,
      'date_checked' => date("Y-m-d")
    );
    $this->db->where('is_no', $id);
    $this->db->update('uploaded_documents', $data);
  }
  public function incomplete_docu($id,$name,$message){
    $data = array(
      'status' => "Incomplete Documents",
      'disapproved_by' => $name,
      'date_disapproved' => date("Y-m-d"),
      'reason_incomplete' =>$message
    );
    $this->db->where('is_no', $id);
    $this->db->update('uploaded_documents', $data);
  }

  public function getupload_info(){
    $query = $this->db->get('uploaded_documents');
    return $query->result_array();
  }

  public function getli_status_pending(){
    $query = $this->db->query("SELECT * FROM land_info WHERE tag='New'  AND status='Pending' AND tag= 'New'");
    return $query->num_rows(); 
  }

  public function getud_status_pending(){
    $this->db->from('land_info as li');
    $this->db->join('uploaded_documents as ud','ud.is_no = li.is_no');
    $this->db->where('li.tag','New');
    $this->db->where('li.status','Pending');
    $this->db->where('ud.status','Uploaded Documents');
    return $this->db->get()->num_rows(); 
  }
  public function getud_status_approved(){
    $this->db->from('land_info as li');
    $this->db->join('uploaded_documents as ud','ud.is_no = li.is_no');
    $this->db->where('li.tag','New');
    $this->db->where('li.status','Approved');
    $this->db->where('ud.status','Checked Documents');
    return $this->db->get()->num_rows(); 
  }
  public function getud_status_disapproved(){
    $this->db->from('land_info as li');
    $this->db->join('uploaded_documents as ud','ud.is_no = li.is_no');
    $this->db->where('li.tag','New');
    $this->db->where('li.status','Disapproved');
    $this->db->where('ud.status','Checked Documents');
    return $this->db->get()->num_rows(); 
  }

  public function getud_status_uploaded(){
    $query = $this->db->query("SELECT status FROM uploaded_documents WHERE status='Uploaded Documents'");
    return $query->num_rows(); 
  } 
  public function getud_status_checked(){
    $this->db->from('land_info as li');
    $this->db->join('uploaded_documents as ud','ud.is_no = li.is_no');
    $this->db->where('li.tag','New');
    $this->db->where('li.status','Pending');
    $this->db->where('ud.status','Checked Documents');
    return $this->db->get()->num_rows(); 
  } 
  public function getud_status_incomplete(){
    $query = $this->db->query("SELECT status FROM uploaded_documents WHERE status='Incomplete Documents' ");
    return $query->num_rows(); 
  } 
  public function getud_status_resubmit(){
    $query = $this->db->query("SELECT status FROM uploaded_documents WHERE status='Resubmit Documents'");
    return $query->num_rows(); 
  }   

    public function get_owned_land($province,$city){
      $this->db->select('info.is_no as iis_no, info.*, loc.*');
      $this->db->from('land_info as info');
      $this->db->join('lot_location as loc','loc.is_no = info.is_no','left');
      $this->db->join('uploaded_documents as uploads','uploads.is_no = info.is_no','left');
      $this->db->where('uploads.status','Checked Documents');

      if(!empty($province)){
        if($province != 'all'){
          $this->db->like('province',$province);
        }
      }

      if($city != 'all'){
        $this->db->like('municipality',$city);
      }
      return  $this->db->get()->result_array();

    }
    public function get_rpt_land($province,$city){
              $this->db->select('info.is_no as iis_no, info.*, loc.*, uploads.*,tax.*');
              $this->db->from('land_info as info');
              $this->db->join('lot_location as loc','loc.is_no = info.is_no','left');
              $this->db->join('uploaded_documents as uploads','uploads.is_no = info.is_no','left');
              $this->db->join('real_property_tax as tax','tax.is_no = info.is_no','left'); 
              $this->db->where('uploads.status','Checked Documents');
              $this->db->group_by('info.is_no');
              if(!empty($province)){
                if($province != 'all'){
                  $this->db->like('province',$province);
                }
              }

              if($city != 'all'){
                $this->db->like('municipality',$city);
              }

      return  $this->db->get()->result_array();
    }

    public function get_count_rpt($is_no){
      return $this->db->get_where('real_property_tax',['is_no'=>$is_no])->num_rows();
    }
    public function uploaded_documents_count(){
      $query = $this->db->get_where('uploaded_documents',['status' => 'Uploaded Documents']);
      return $query->num_rows();
    }

    public function insert_tax_computation($data){
      return $this->db->insert("tax_computation", $data);
    }

    public function get_tax_computation($is_no){
      return  $this->db->order_by('date_added','desc')->limit(1)->get_where('tax_computation',['is_no' => $is_no])->row_array();
    }
    public function get_all_tax_computation($is_no){
      return  $this->db->order_by('date_added','desc')->get_where('tax_computation',['is_no' => $is_no])->result_array();
    }
}