<?php
class Account_model extends CI_Model{
    //==================================================
    //QUERY
    //==================================================
    public function remove_user($id){
        $this->db->delete('users', array('user_id' => $id));
    }
    public function getuser_lists(){
        $query = $this->db->get('users');
        return $query->result_array();   
    }
    public function getUser(){
        $user = $this->db->get('users');
        return $user->result_array();
    }
    public function getuser_byid($id){
        $sql = "SELECT * from users WHERE user_id = ? ";
        $query = $this->db->query($sql, array($id));
        return $query->row_array();
    }
    //==================================================
    //END QUERY
    //==================================================

    //==================================================
    //INSERT, UPDATE, DELETE
    //==================================================
    public function create_account(){
        $data = array(
           'firstname' => $this->input->post('fname'),
           'lastname' => $this->input->post('lname'),
           'position' => $this->input->post('position'),
           'username' => $this->input->post('username'),
           'password' => $this->encryption->encrypt($this->input->post('password')),
           'user_type' => $this->input->post('user_type'),
        );
        $this->db->insert('users', $data);
    }
    public function update_userlog(){
        $uname = $this->input->post('username');

        $this->db->where('username', $uname);
        $this->db->update('users', array('last_login' => date('M-d-Y H:i:s'), 'logged' => "true"));
    } 
    public function set_active_time($id){
        $this->db->where('user_id', $id);
        $this->db->update('users', array('time_active' => date('M-d-Y H:i:s') ));
    }
    public function logout($uid){
        $this->db->where('user_id', $uid);
        $this->db->update('users', array('logged' => "false" ));
    } 
    public function update_profile($id){
        $img = $this->input->post('file');
        $user = $this->session->userdata('user_type');
        //deleting previous image
        $query = $this->db->get_where('users', array('user_id'=>$id));
        foreach ($query->result_array() as $u){
            unlink("assets/img/users/".$user.'/'.$u['image']);
        }
        //end deleting

        if($_FILES AND $_FILES["file"]['name']):
             if(!file_exists('./assets/img/users/'.$user)):
                @mkdir('./assets/img/users/'.$user);
            endif;

            if(!file_exists('./assets/img/users/'.$user.'/'.$img)):
                @mkdir('./assets/img/users/'.$user.'/'.$img);
            endif;

            $targetPaths = getcwd().'/assets/img/users/'.$user.'/'.$img;
            $img = $this->upload_images($targetPaths,"file");

            // Save
            $data = array(
                'image' => $img,
            );
            $this->db->where('user_id', $id);
            $this->db->update('users', $data);
            $this->session->set_userdata($data);
            // Close               
             
        endif;              
    }
    public function update_credentials($id){
        $in = array(
                'username' => $this->input->post('username'),
                'password' => $this->encryption->encrypt($this->input->post('pass'))
            );
        $this->db->where('user_id', $id);
        $this->db->update('users', $in);
        $this->session->set_userdata($in);
    }
    public function upload_images($targetPaths, $image_name){
        $filename = '';
        $tmpFilePaths = $_FILES[$image_name]['tmp_name'];
        //Make sure we have a filepath
        if ($tmpFilePaths != ""){
            //Setup our new file path
            $filename =  $_FILES[$image_name]['name'];
            $newFilePath = $targetPaths . $filename;
            //Upload the file into the temp dir
            move_uploaded_file($tmpFilePaths, $newFilePath);
        }
        return $filename;
    }
    //==================================================
    //END INSERT, UPDATE, DELETE
    //==================================================

    //==================================================
    //VALIDATION
    //==================================================
    public function validate(){
        $user = array();
        $uname = $this->input->post('username');
        $pword = $this->input->post('password');
        $query = $this->db->select('*')->from('users')
                          ->where(array('username' => $uname))
                          ->get()->result_array(); 

        foreach ($query as $u) {
            if ($this->encryption->decrypt($u['password']) == $pword && $u['username'] == $uname){
                $user = $u;
            }
        }
        return $user;
    }
    public function check_username($un){
        $user   = array();
        $query  = $this->db->select('*')->from('users')
                           ->where(array('username' => $un))
                           ->get()->result_array();       

        foreach ($query as $u){
            $user = $u;
        }
        return $user;
    }
    //==================================================
    //END VALIDATION
    //==================================================
}