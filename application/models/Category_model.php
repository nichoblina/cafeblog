<?php
    class Category_model extends CI_Model {
        //  Construct
        public function __construct() {
            $this->load->database();
        }

        //  Get categories
        public function get_categories($id = FALSE) {
            if (!$id) {
                $this->db->order_by('name');
                $query = $this->db->get('categories');
                return $query->result_array();
            }
            
            $query = $this->db->get_where('categories', array('id' => $id));
            return $query->row_array();
        }

        //  Get post count for a specific category
        public function get_post_count($category_id) {
            $this->db->where('category_id', $category_id);
            return $this->db->count_all_results('posts');
        }

        //  Create a category
        public function create_category($category_image) {
            $data = array(
                'name' => $this->input->post('name'),
                'category_image' => $category_image
            );

            //  Insert category into database
            return $this->db->insert('categories', $data);
        }
    }