<a href="<?php echo base_url(); ?>posts" class="link d-flex align-items-center mb-3">
    <?php echo icon_return(); ?>
    Return
</a>

<h2 class="font-weight-bold"><?= $title; ?></h2>
<?php echo validation_errors(); ?>
<?php echo form_open_multipart('posts/create', ['id' => 'postForm']); ?>
    <div class="form-group my-3">
        <label>Title</label>
        <input type="text" class="form-control title-input" name="title" placeholder="Add Title" required>
    </div>
    <div class="form-group my-3">
        <label>Body</label>
        <textarea class="form-control" id="editor1" name="body" placeholder="Add Body" required></textarea>
    </div>
    <div class="form-group my-3">
        <label>Category</label>
        <select class="form-control title-input" name="category_id" required>
            <option value="" selected disabled>Select Category</option>
            <?php foreach($categories as $category): ?>
                <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group my-3">
        <label class="d-block">Upload Image</label>
        <div class="d-flex align-items-center">
            <button type="button" id="browseBtn" class="btn btn-warning mb-0">Browse...</button>
            <span id="fileName" class="ml-3">No file selected</span>
            <input type="file" name="postImage" id="postImageInput" class="d-none">
        </div>
        <div class="mt-2" id="imageContainer" style="display: none;">
            <img id="imagePreview" src="" alt="Preview" class="img-fluid" style="max-width: 200px;">
        </div>
    </div>
    <hr>
    <a href="#" class="btn btn-primary d-inline-flex align-items-center" onclick="event.preventDefault(); document.getElementById('postForm').submit();">
        <?php echo icon_submit(); ?> 
        Submit
    </a>
</form>

<script>
    //  Clicks the hidden file input
    document.addEventListener("DOMContentLoaded", function() {
        let browseBtn = document.getElementById('browseBtn');
        let fileInput = document.getElementById('postImageInput');

        if (browseBtn && fileInput) {
            browseBtn.addEventListener('click', function() {
                console.log('clicked');
                fileInput.click();
            });

            fileInput.addEventListener('change', function() {
                console.log("File input changed");
                console.log(fileInput.files.length);
            });
        } else {
            console.error("browseBtn or postImageInput not found in the document.");
        }
    });

    //  Previews the image if available
    document.getElementById('postImageInput').addEventListener('change', function(event) {
        let input = event.target;
        let image = document.getElementById('imagePreview');
        let container = document.getElementById('imageContainer');

        if (input.files && input.files[0]) {
            let reader = new FileReader();

            reader.onload = function(e) {
                image.src = e.target.result;
                container.style.display = "block"; // Show preview
            }

            reader.readAsDataURL(input.files[0]);
        } else {
            image.src = "";
            container.style.display = "none"; // Hide preview if no file
        }
    });

    //  Updates the file name
    document.getElementById("categoryImageInput").addEventListener("change", function() {
        let fileName = this.files.length > 0 ? this.files[0].name : "No file selected";
        document.getElementById("fileName").textContent = fileName;
    });
</script>