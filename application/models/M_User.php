<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_User extends CI_Model
{
    public function getUser($user_id = null)
    {
        if ($user_id === null) {
            return $this->db->get('master_user')->result_array();
        } else {
            return $this->db->get_where('master_user', ['user_id' => $user_id])->result_array();
        }
    }
}
