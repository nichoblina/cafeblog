<?php
    class Categories extends CI_Controller {
        //  Set up index page
        public function index() {
            $data['title'] = 'Categories';
            $categories = $this->category_model->get_categories();

            //  Add post count to each category
            foreach ($categories as &$category) {
                $category['post_count'] = $this->category_model->get_post_count($category['id']);
            }

            $data['categories'] = $categories;

            $this->load->view('templates/header');
            $this->load->view('categories/index', $data);
            $this->load->view('templates/footer');
        }
        
        //  Create a category
        public function create() {
            $data['title'] = 'Create Category';
            $category_image = NULL;
        
            $this->form_validation->set_rules('name', 'Name', 'required');
            
            if (!$this->form_validation->run()) {
                $this->load->view('templates/header');
                $this->load->view('categories/create', $data);
                $this->load->view('templates/footer');
            } else {
                // Check if there's a file selected
                if (!empty($_FILES['categoryImage']['name'])) {
                    // Configure image upload
                    $config['upload_path'] = './assets/images/categories';
                    $config['allowed_types'] = 'gif|jpg|jpeg|png';
                    $config['max_size'] = '5120'; // Increased to 5MB
                    $config['max_width'] = '4096';  // Common wallpaper width
                    $config['max_height'] = '2304'; // Common wallpaper height
        
                    $this->load->library('upload', $config);
        
                    if (!$this->upload->do_upload('categoryImage')) {
                        $error = $this->upload->display_errors();
                        echo "<pre>Error uploading file:\n";
                        print_r($error);
                        echo "</pre>";
                        exit(); // Stop execution to see the error
                    } else {
                        $upload_data = $this->upload->data();
                        $category_image = $upload_data['file_name'];
                    }
                }
        
                // Insert category with or without image
                $this->category_model->create_category($category_image);
                redirect('categories');
            }
        }
        

        //  Get posts
        public function posts($id) {
            $category  = $this->category_model->get_categories($id);
            
            if (empty($category)) 
                show_404();

            $data['title'] = $category['name'] . " Posts";
            $data['posts'] = $this->post_model->get_posts_by_category($id);

            $this->load->view('templates/header');
            $this->load->view('posts/index', $data);
            $this->load->view('templates/footer');
        }
    }