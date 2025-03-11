<div class="d-flex justify-content-between align-items-center text-align mb-3">
    <h2 class="font-weight-bold"><?= $title ?></h2>
    <?php if($this->session->userdata('logged_in')) : ?>
        <a class="btn btn-warning d-flex align-items-center" href="<?php echo base_url(); ?>categories/create">
            <?php echo icon_add(); ?>
            Create new category
        </a>
    <?php endif; ?>
</div>

<div class="row">
    <?php foreach ($categories as $category) : ?>
        <?php 
            $imagePath = 'assets/images/categories/' . $category['category_image'];
            $defaultImage = site_url('assets/images/categories/empty-image.webp');
            
            // Check if the image is not null and the file exists
            $imageURL = (!empty($category['category_image']) && file_exists(FCPATH . $imagePath)) 
                        ? site_url($imagePath) 
                        : $defaultImage;
        ?>
        <div class="col-12 col-md-4 mb-4 d-flex align-items-stretch">
            <div class="custom-card w-100">
                <div class="custom-card-img-wrapper">
                    <img src="<?php echo $imageURL; ?>" 
                         alt="<?php echo $category['name']; ?>" 
                         class="custom-card-img">
                </div>
                
                <div class="custom-card-body">
                    <h5 class="custom-card-title"><?php echo $category['name']; ?></h5>
                    <p class="custom-card-text"><?php echo $category['post_count']; ?> Posts</p>
                </div>
                <div class="custom-card-footer">
                    <a href="<?php echo site_url('/categories/posts/' . $category['id']); ?>" class="custom-card-link">View Posts</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
