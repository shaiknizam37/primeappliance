<?php
class User_Model extends CI_Model {

    function custom_query($query) {
        return $this->db->query($query)->result_array();
    }

    function login($email='',$password='') {
      $query="SELECT * FROM `user` WHERE `email`='$email' AND `password`='$password' AND `user_type`=1 AND `status`=1";
        return $this->db->query($query)->result_array();
    }

}
