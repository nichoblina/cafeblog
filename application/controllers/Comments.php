<?php
    class Comments extends CI_Controller {
        public function create($post_id) {
            $data['post'] = $this->post_model->get_posts($post_id);

            // Form validation
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('body', 'Body', 'required');

            // Check form validated
            if(!$this->form_validation->run()) {
                $this->load->view('templates/header');
                $this->load->view('posts/view', $data);
                $this->load->view('templates/footer');
            } else {
                $this->comment_model->create_comment($post_id);
                redirect('posts/' . $post_id);
            }
        }
    }