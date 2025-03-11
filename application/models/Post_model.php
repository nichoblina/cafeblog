<?php
    class Post_model extends CI_Model {
        //  Connect to database
        public function __construct() {
            $this->load->database();
        }

        //  Get posts
        public function get_posts($id = FALSE) {
            //  Join categories table with posts table
            $this->db->select('posts.id AS post_id, posts.*, categories.name AS category_name');
            $this->db->join('categories', 'categories.id = posts.category_id');


            //  If no id, get all posts
            if (!$id) {
                $this->db->order_by('posts.id', 'DESC');
                $query = $this->db->get('posts');
                return $query->result_array();
            }

            //  Get post by id
            $query = $this->db->get_where('posts', array('posts.id' => $id));
            return $query->row_array();
        }

        //  Get categories
        public function get_categories() {
            $this->db->order_by('name');
            $query = $this->db->get('categories');
            return $query->result_array();
        }

        //  Get posts by category
        public function get_posts_by_category($category_id) {
            $this->db->select('posts.id AS post_id, posts.*, categories.name AS category_name');
            $this->db->join('categories', 'categories.id = posts.category_id');
            $this->db->where('posts.category_id', $category_id);
            $this->db->order_by('posts.id', 'DESC');
            $query = $this->db->get('posts');
            return $query->result_array();
        }

        //  Create post
        public function create_post($post_image) {
            //  Create slug
            $slug = url_title($this->input->post('title'));
            
            //  Create data array for post
            $data = array(
                'title' => $this->input->post('title'),
                'slug' => $slug,
                'body' => $this->input->post('body'),
                'post_image' => $post_image,
                'category_id' => $this->input->post('category_id'),
                'user_id' => $this->session->userdata('user_id')
            );

            //  Insert post into database
            return $this->db->insert('posts', $data);
        }

        //  Update post
        public function update_post($id) {            
            // Check if post exists
            $query = $this->db->get_where('posts', array('id' => $id));
            if ($query->num_rows() == 0) {
                return false;
            }

            //  Create slug
            $slug = url_title($this->input->post('title'));
            
            //  Create data array for post
            $data = array(
                'title' => $this->input->post('title'),
                'slug' => $slug,
                'body' => $this->input->post('body'),
                'category_id' => $this->input->post('category_id')
            );

            //  Update post in database
            $this->db->where('id', $id);
            return $this->db->update('posts', $data);
        }

        //  Delete post
        public function delete_post($id) {
            //  Delete using $id from the table 'posts'
            $this->db->where('id', $id);
            $this->db->delete('posts');
            return true;
        }
    }