<div class="d-flex justify-content-between align-items-center text-align mb-3">
    <h2 class="font-weight-bold"><?= $title ?></h2>
    <?php if ($this->session->userdata('logged_in')) : ?>
        <a class="btn btn-warning d-flex align-items-center" href="<?php echo base_url(); ?>posts/create">
            <?php echo icon_add(); ?>
            Create new post
        </a>
    <?php endif; ?>
</div>
<?php if (empty($posts)) : ?>
    <div class="alert alert-warning" role="alert">
        No posts available.
    </div>
<?php else : ?>
<?php foreach ($posts as $post) : ?>
    <div class="post my-4 w-100" ondblclick="window.location.href='<?php echo site_url('/posts/' . $post['post_id']); ?>'">
        <?php if (!empty($post['post_image'])) : ?>
            <img src="<?php echo site_url('assets/images/posts/' . $post['post_image']); ?>" 
                 alt="Post Image" class="img-fluid mb-3" style="max-height: 300px; object-fit: cover;">
        <?php endif; ?>
        <div>
            <span class="category-label">
                <?php echo $post['category_name']; ?>
            </span>
            <h3 class="post-title display-5 font-weight-normal my-1">
                <a href="<?php echo site_url('/posts/' . $post['post_id']); ?>">
                    <?php echo $post['title']; ?>
                </a>
            </h3>
            <small class="post-date">Posted on: <?php echo $post['created_at']; ?></small><br>
        </div>
        <p class="my-4 lead font-weight-light">
            <?php
            if (str_word_count($post['body']) > 50) :
                echo word_limiter($post['body'], 50);
            ?>
                <a class="link" href="<?php echo site_url('/posts/' . $post['post_id']); ?>">Read More</a>
            <?php else :
                echo $post['body'];
            endif; ?>
        </p>

        <?php if ($this->session->userdata('logged_in') && $this->session->userdata('user_id') == $post['user_id']) : ?>
            <hr>
            <div class="d-flex justify-content-end">
            <a href="<?php echo site_url('/posts/edit/' . $post['post_id']); ?>" class="btn btn-secondary mr-3">
            <?php echo icon_edit(); ?> Edit
            </a>
            <a href="<?php echo site_url('/posts/delete/' . $post['post_id']); ?>" class="btn btn-danger">
            <?php echo icon_delete(); ?> Delete
            </a>
            </div>
        <?php endif; ?>
    </div>
<?php endforeach; ?>
<?php endif; ?>