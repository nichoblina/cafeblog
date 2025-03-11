<?php
    class Posts extends CI_Controller {
        //  Index page
        public function index() {
            //  Page name
            $data['title'] = 'Latest Posts';

            //  Get posts from Post_model
            $data['posts'] = $this->post_model->get_posts();

            //  Load views
            $this->load->view('templates/header');
            $this->load->view('posts/index', $data);
            $this->load->view('templates/footer');
        }

        //  View page (after clicking Read More)
        public function view($id = NULL) {
            //  Get post from Post_model via id
            $data['post'] = $this->post_model->get_posts($id);     

            //  If post is empty, show 404
            if (empty($data['post'])) {
                show_404();
            }

            $data['title'] = $data['post']['title'];
            $data['comments'] = $this->comment_model->get_comments($id);

            //  Load views
            $this->load->view('templates/header');
            $this->load->view('posts/view', $data);
            $this->load->view('templates/footer');
        }

        //  Create Post Page
        public function create() {
            //  Check if logged in
            if (!$this->session->userdata('logged_in'))
                redirect('users/login');

            //  Page name
            $data['title'] = 'Create Post';

            $post_image = NULL;

            $data['categories'] = $this->post_model->get_categories();

            //  Runs validation
            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('body', 'Body', 'required');
            $this->form_validation->set_rules('category_id', 'Category', 'required', [
                'required' => 'Please select a valid category.'
            ]);

            //  If validation fails, reload page
            if (!$this->form_validation->run()) {
                $this->load->view('templates/header');
                $this->load->view('posts/create', $data);
                $this->load->view('templates/footer');
            } else {
                if (!empty($_FILES['postImage']['name'])) {
                    //  Configure image (if any)
                    $config['upload_path'] = './assets/images/posts';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size'] = '2048';
                    $config['max_width'] = '2000';
                    $config['max_height'] = '2000';
    
                    $this->load->library('upload', $config);
    
                    if (!$this->upload->do_upload('postImage')) {
                        $error = $this->upload->display_errors();
                        echo "<pre>Error uploading file:\n";
                        print_r($error);
                        echo "</pre>";
                        exit(); // Stop execution to see the error
                    } else {
                        $upload_data = $this->upload->data();
                        $post_image = $upload_data['file_name'];
                    }
                }

                $this->post_model->create_post($post_image);
                redirect('posts');
            }
        }

        //  Edit Post Page
        public function edit($id) {
            //  Check if logged in
            if (!$this->session->userdata('logged_in'))
                redirect('users/login');

            //  Page name
            $data['title'] = 'Edit Post';

            //  Get post from Post_model via id
            $data['post'] = $this->post_model->get_posts($id);
            $data['categories'] = $this->post_model->get_categories();

            //  If post is empty, show 404
            if (empty($data['post'])) {
                show_404();
            }

            //  Load views
            $this->load->view('templates/header');
            $this->load->view('posts/edit', $data);
            $this->load->view('templates/footer');
        }

        //  Update post
        public function update() {
            //  Check if logged in
            if (!$this->session->userdata('logged_in'))
                redirect('users/login');
            
            $post_id = $this->input->post('id');

            //  Runs validation
            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('body', 'Body', 'required');
            $this->form_validation->set_rules('category_id', 'Category', 'required', [
                'required' => 'Please select a valid category.'
            ]);

            //  Create slug
            $slug = url_title($this->input->post('title'));

            //  If validation fails, reload page
            if (!$this->form_validation->run()) {
                // Reload edit form with validation errors
                $data['title'] = 'Edit Post';
                $data['post'] = $this->post_model->get_posts($slug);
                $data['categories'] = $this->category_model->get_categories();

                $this->load->view('templates/header');
                $this->load->view('posts/edit', $data);
                $this->load->view('templates/footer');
            } else {
                // Proceed with update logic
                $this->post_model->update_post($post_id);
                redirect('posts');
            }
        }

        //  Delete post
        public function delete($id) {
            //  Deletes post from Post_model
            $this->post_model->delete_post($id);
            //  Returns to index page (posts)
            redirect('posts');
        }
    }
?>