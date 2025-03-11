<a href="<?php echo base_url(); ?>posts" class="link d-flex align-items-center mb-3">
    <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5"/>
    </svg>
    Return
</a>

<div>
    <h2 class="font-weight-bold"><?= $title; ?></h2>
    <?php echo validation_errors(); ?>
    <?php echo form_open('posts/update', ['id' => 'postForm']); ?>
        <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
        <div class="form-group my-3">
            <label>Title</label>
            <input type="text" class="form-control title-input" value="<?php echo $post['title']; ?>" name="title" placeholder="Add Title" required>
        </div>
        <div class="form-group">
            <label>Body</label>
            <textarea class="form-control" name="body" id="editor1" placeholder="Add Body" required><?php echo $post['body']; ?></textarea>
        </div>
        <div class="form-group my-3">
        <label>Category</label>
            <select class="form-control title-input" name="category_id" required>
                <?php foreach($categories as $category): ?>
                <option value="<?php echo $category['id']; ?>" <?php echo ($post['category_id'] == $category['id']) ? 'selected' : ''; ?>><?php echo $category['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group my-3">
            <label class="d-block">Upload Image</label>
            <div class="d-flex align-items-center">
                <button type="button" id="browseBtn" class="btn btn-warning mb-0">Browse...</button>
                <span id="fileName" class="ml-3">
                    <?php echo !empty($post['post_image']) ? $post['post_image'] : 'No file selected'; ?>
                </span>
                <input type="file" name="postImage" id="postImageInput" class="d-none" hidden>
            </div>
            <div class="mt-2" id="imageContainer" style="<?= !empty($post['post_image']) ? '' : 'display: none;'; ?>">
                <img id="imagePreview" src="<?= !empty($post['post_image']) ? base_url('assets/images/posts/' . $post['post_image']) : ''; ?>" 
                    alt="Preview" class="img-fluid" style="max-width: 200px;">
            </div>
        </div>
        <hr>
        <a href="#" class="btn btn-primary d-inline-flex align-items-center" onclick="event.preventDefault(); document.getElementById('postForm').submit();">
            <?php echo icon_submit(); ?> Submit
        </a>
    </form>

    <script>
        //  Clicks the hidden file input
        document.addEventListener("DOMContentLoaded", function() {
            let browseBtn = document.getElementById('browseBtn');
            let fileInput = document.getElementById('postImageInput');
            let fileNameText = document.getElementById("fileName");
            let imagePreview = document.getElementById("imagePreview");
            let imageContainer = document.getElementById("imageContainer");

            if (browseBtn && fileInput) {
                // Open file dialog on button click
                browseBtn.addEventListener('click', function() {
                    fileInput.click();
                });

                // Handle file selection
                fileInput.addEventListener("change", function() {
                    let fileName = fileInput.files.length > 0 ? fileInput.files[0].name : "No file selected";
                    fileNameText.textContent = fileName;

                    if (fileInput.files.length > 0) {
                        let reader = new FileReader();
                        reader.onload = function(e) {
                            imagePreview.src = e.target.result;
                            imageContainer.style.display = "block"; // Show preview
                        };
                        reader.readAsDataURL(fileInput.files[0]);
                    } else {
                        imageContainer.style.display = "none"; // Hide preview if no file
                    }
                });
            } else {
                console.error("browseBtn or postImageInput not found in the document.");
            }
    });

    </script>
</div>