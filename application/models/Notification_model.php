<?php
class Notification_model extends CI_Model{
	public function getnumrows_unread_notification($recpt){ 
		$sql = "SELECT status FROM notification WHERE recipient = ? AND status='unread' ";
		$query = $this->db->query($sql, array($recpt));
    	return $query->num_rows();
	}
	public function getnumrows_read_notification($recpt){
		$sql = "SELECT status FROM notification WHERE recipient = ? AND status='read' ";
		$query = $this->db->query($sql, array($recpt));
    	return $query->num_rows();
	}
	public function get_all_notification_no($recpt){
		$sql = "SELECT * FROM notification WHERE recipient = ? ";
		$query = $this->db->query($sql, array($recpt));
        return $query->num_rows();
    }
	public function notify_user($form_type, $is_no, $action, $recipient){
		$data = array(
		 	'form_type'     => $form_type,
		 	'reference_id'  => $is_no,
		 	'action'        => $action,
		 	'recipient'     => $recipient,
		 	'status'        => "unread",
		 	'date'          => date('Y-m-d g:i:s'),
		);
		$this->db->insert('notification', $data);
	}
	public function get_all_notifications(){
        $query = $this->db->get('notification');
        return $query->result_array();
    }
    public function get_notif_per_user($recp){
      	$query = $this->db->get_where('notification', array('recipient'=> $recp));
      	return $query->result_array();
	}
    public function read_notification($id){
        $data = array(
            'status' => "read",
        );
        $this->db->where('id', $id);
        $this->db->update('notification', $data);
    }
    public function read_all_notification($user_n){
        $data = array(
            'status' => "read",
        );
      	$this->db->where('recipient', $user_n);
        $this->db->update('notification', $data);
    }
    public function delete_all_notification($user_n){
    	$this->db->where('recipient', $user_n);
		$this->db->delete('notification');
    }
    public function getnotif_byid($id){
        $query = $this->db->get_where('notification', array('reference_id'=> $id));
        return $query->row_array();
    }
    public function delete_notif($id){
        $this->db->delete('notification', array('reference_id' => $id));
    }
    public function getform_by_id($id){
        $query = $this->db->get_where('forms', array('form_no'=> $id));
        return $query->row_array();
    }
}