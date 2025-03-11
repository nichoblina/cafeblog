<a href="<?php echo base_url(); ?>categories" class="link d-flex align-items-center mb-3">
    <?php echo icon_return(); ?>
    Return
</a>

<div class="d-flex justify-content-between align-items-center text-align mb-3">
    <h2 class="font-weight-bold">
        <?= $title; ?>
    </h2>
</div>
<?php echo validation_errors(); ?>
<?php echo form_open_multipart('/categories/create', ['id' => 'categoryForm']); ?>
<div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" class="form-control title-input" placeholder="Enter category name">
</div>
<div class="form-group my-3">
        <label class="d-block">Upload Image</label>
        <div class="d-flex align-items-center">
            <button type="button" id="browseBtn" class="btn btn-warning mb-0">Browse...</button>
            <span id="fileName" class="ml-3">No file selected</span>
            <input type="file" name="categoryImage" id="categoryImageInput" class="d-none">
        </div>
        <div class="mt-2" id="imageContainer" style="display: none;">
            <img id="imagePreview" src="" alt="Preview" class="img-fluid" style="max-width: 200px;">
        </div>
    </div>
<hr>
<a href="#" class="btn btn-primary d-inline-flex align-items-center" onclick="event.preventDefault(); document.getElementById('categoryForm').submit();">
    <?php echo icon_submit(); ?>
    Submit
</a>
</form>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Initialize elements
        const browseBtn = document.getElementById('browseBtn');
        const fileInput = document.getElementById('categoryImageInput');
        const fileName = document.getElementById('fileName');
        const imagePreview = document.getElementById('imagePreview');
        const imageContainer = document.getElementById('imageContainer');

        // Handle browse button click
        browseBtn?.addEventListener('click', () => fileInput.click());

        // Handle file selection
        fileInput?.addEventListener('change', function() {
            // Update filename display
            fileName.textContent = this.files.length > 0 ? this.files[0].name : "No file selected";

            // Handle image preview
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    imagePreview.src = e.target.result;
                    imageContainer.style.display = "block";
                };
                reader.readAsDataURL(this.files[0]);
            } else {
                imagePreview.src = "";
                imageContainer.style.display = "none";
            }
        });
    });
</script>
