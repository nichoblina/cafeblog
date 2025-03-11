<a href="<?php echo base_url(); ?>posts" class="link d-flex align-items-center mb-3">
    <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5"/>
    </svg>
    Return
</a>

<?php if (!empty($post['post_image'])) : ?>
    <img src="<?php echo site_url('assets/images/posts/' . $post['post_image']); ?>" 
            alt="Post Image" class="img-fluid mb-3" style="max-height: 300px; object-fit: cover;">
<?php endif; ?>

<div>
    <h2 class="font-weight-bold"><?php echo $post['title']; ?></h2>
    <small class="post-date">Posted on: <?php echo $post['created_at']; ?></small>
    <div class="post-body my-3">
        <p class="lead font-weight-light">
            <?php echo $post['body']; ?>
        </p>
    </div>
</div>

<hr>

<div class="comments-section my-3">
    <h4 class="my-3">Discussion</h4>
    <?php if ($comments) : ?>
        <?php foreach($comments as $comment) : ?>
            <div class="comment card mb-3">
                <div class="card-body">
                    <div class="mb-2">
                        <h5 class="card-title"><?php echo $comment['name']; ?></h5>
                        <small class="post-date">Commented on: <?php echo $comment['created_at']; ?></small>
                    </div>
                    <p class="card-text"><?php echo $comment['body']; ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>No comments yet</p>
    <?php endif; ?>

    <hr>

    <div class="my-3">
        <h4 class="my-3">Join the Conversation</h4>
        <?php echo validation_errors(); ?>
        <?php echo form_open('comments/create/' . $post['id']); ?>
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" placeholder="Your name" class="form-control title-input">
            </div>
            <div class="form-group">
                <label>Comment</label>
                <textarea name="body" placeholder="Write your thoughts" class="form-control title-input"></textarea>
            </div>
            <div class="mt-3 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary" disabled>
                    <?php echo icon_submit(); ?>
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>

<?php if ($this->session->userdata('logged_in')) : ?>
    <hr>
    <div class="btn-group">
        <?php echo form_open("/posts/edit/" .$post["slug"]); ?>
            <input type="submit" value="Edit" class="btn btn-secondary mr-2">
        </form>
        <?php echo form_open("/posts/delete/" .$post["id"]); ?>
            <input type="submit" value="Delete" class="btn btn-danger">
        </form>
    </div>
<?php endif; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const nameInput = document.querySelector('input[name="name"]');
    const bodyInput = document.querySelector('textarea[name="body"]');
    const submitButton = document.querySelector('button[type="submit"]');

    function checkInputs() {
        submitButton.disabled = !(nameInput.value.trim() && bodyInput.value.trim());
    }

    nameInput.addEventListener('input', checkInputs);
    bodyInput.addEventListener('input', checkInputs);
});
</script>