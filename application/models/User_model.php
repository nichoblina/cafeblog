<?php
    class User_model extends CI_Model {
        public function register($enc_password) {
            $data = array(
                'name' => $this->input->post('name'),
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'password' => $enc_password,
            );

            //  Insert user
            return $this->db->insert('users', $data);
        }

        public function login($username, $password) {
            $this->db->where('username', $username);
            $query = $this->db->get('users');
            $result = $query->row_array();
        
            if ($result && $result['password'] === md5($password)) {
                return $result['id'];
            }
            return false;
        }
        

        //  Check if username exists
        public function check_username_exists($username) {
            $query = $this->db->get_where('users', array(
                'username' => $username
            ));

            if (empty($query->row_array()))
                return true;
            
            return false;
        }

        //  Check if email exists
        public function check_email_exists($email) {
            $query = $this->db->get_where('users', array(
                'email' => $email
            ));

            if (empty($query->row_array()))
                return true;
            
            return false;
        }
    }