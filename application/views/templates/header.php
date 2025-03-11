<html>
    <head>
        <title>CafeBlog</title>
        <link rel="stylesheet" href="https://bootswatch.com/4/flatly/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/style.css">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-wood">
                <div class="container">
                    <a class="navbar-brand" href="<?php echo base_url() . '/home' ?>">caféBlog</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse px-2" id="navbarNav">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>about">About</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>posts">Blog</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>categories">Categories</a></li>
                        </ul>

                    <!-- Register/Login or Logout Button -->
                    <?php if (!$this->session->userdata('logged_in')) : ?>
                        <a href="<?php echo base_url(); ?>users/register" class="custom-btn-nav">Register/Login</a>
                    <?php else : ?>
                        <a href="<?php echo base_url(); ?>users/logout" class="custom-btn-nav">Logout</a>
                    <?php endif; ?>
                    </div>
                </div>
        </nav>

        <div class="container mt-2">
            <!-- Flash messages -->
            <?php if($this->session->flashdata('user_registered')): ?>
            <div class="alert alert-success">
                <?php echo $this->session->flashdata('user_registered'); ?>
            </div>
            <?php endif; ?>

            <?php if($this->session->flashdata('user_loggedin')): ?>
            <div class="alert alert-success">
                <?php echo $this->session->flashdata('user_loggedin'); ?>
            </div>
            <?php endif; ?>

            <?php if($this->session->flashdata('login_failed')): ?>
            <div class="alert alert-danger">
                <?php echo $this->session->flashdata('login_failed'); ?>
            </div>
            <?php endif; ?>

            <?php if($this->session->flashdata('user_loggedout')): ?>
            <div class="alert alert-success">
                <?php echo $this->session->flashdata('user_loggedout'); ?>
            </div>
            <?php endif; ?>

            <?php if($this->session->flashdata('post_created')): ?>
            <div class="alert alert-success">
                <?php echo $this->session->flashdata('post_created'); ?>
            </div>
            <?php endif; ?>

            <?php if($this->session->flashdata('post_updated')): ?>
            <div class="alert alert-success">
                <?php echo $this->session->flashdata('post_updated'); ?>
            </div>
            <?php endif; ?>

            <?php if($this->session->flashdata('post_deleted')): ?>
            <div class="alert alert-danger">
                <?php echo $this->session->flashdata('post_deleted'); ?>
            </div>
            <?php endif; ?>
        </div>

        <div class="container py-5">
