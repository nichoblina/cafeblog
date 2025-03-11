<div class="row align-items-center mt-2">
    <!-- Registration Form -->
    <div class="col-md-6">
        <div class="custom-card register-card">
            <div class="custom-card-body">
                <h3 class="mb-4 font-weight-bold"><?php echo $title; ?></h3>

                <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

                <?php echo form_open('users/register'); ?>
                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control title-input" placeholder="Enter your name" value="<?php echo set_value('name'); ?>">
                    </div>

                    <div class="form-group mb-3">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control title-input" placeholder="Enter a username" value="<?php echo set_value('username'); ?>">
                    </div>

                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control title-input" placeholder="Enter your email" value="<?php echo set_value('email'); ?>">
                    </div>

                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control title-input" placeholder="Enter a password">
                    </div>

                    <div class="form-group mb-4">
                        <label for="password2">Confirm Password</label>
                        <input type="password" name="password2" class="form-control title-input" placeholder="Confirm your password">
                    </div>

                    <hr>

                    <button type="submit" class="btn btn-primary w-100" disabled>
                        <?php echo icon_submit(); ?>
                        Register
                    </button>

                    <div class="mt-3 text-center">
                        <p>Already have an account? <a href="<?php echo base_url(); ?>users/login" class="text-primary">Login here</a></p>
                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>

    <!-- Hero Text -->
    <div class="col-md-6 text-center">
        <h1 class="hero-title">Join Our Community</h1>
        <p class="hero-subtitle">Connect, share, and grow with people who share your passion.</p>
        <p class="hero-text">Sign up now and be part of something awesome!</p>
    </div>
</div>
<script>
function validateForm() {
    const inputs = document.querySelectorAll('input[type="text"], input[type="email"], input[type="password"]');
    const submitButton = document.querySelector('button[type="submit"]');
    let isValid = true;

    inputs.forEach(input => {
        if (!input.value.trim()) {
            isValid = false;
        }
    });

    submitButton.disabled = !isValid;
}

// Add event listeners to all input fields
document.querySelectorAll('input').forEach(input => {
    input.addEventListener('input', validateForm);
});
</script>
