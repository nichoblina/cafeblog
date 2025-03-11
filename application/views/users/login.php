<div class="row align-items-center mt-2">
    <!-- Login Form -->
    <div class="col-md-6">
        <div class="custom-card login-card">
            <div class="custom-card-body">
                <h3 class="mb-4 font-weight-bold"><?php echo $title; ?></h3>

                <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

                <?php echo form_open('users/login'); ?>
                    <div class="form-group mb-3">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control title-input" placeholder="Enter your username" value="<?php echo set_value('username'); ?>">
                    </div>

                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control title-input" placeholder="Enter your password">
                    </div>

                    <hr>

                    <button type="submit" class="btn btn-primary w-100" disabled>
                        <?php echo icon_submit(); ?>
                        Login
                    </button>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>

    <!-- Hero Text -->
    <div class="col-md-6 text-center">
        <h1 class="hero-title">Welcome Back</h1>
        <p class="hero-subtitle">Sign in to access your account</p>
        <p class="hero-text">Don't have an account? <a href="<?php echo base_url('users/register'); ?>" class="text-primary">Register here</a></p>
    </div>
</div>
<script>
function validateForm() {
    const inputs = document.querySelectorAll('input[type="text"], input[type="password"]');
    const submitButton = document.querySelector('button[type="submit"]');
    let isValid = true;

    inputs.forEach(input => {
        if (!input.value.trim()) {
            isValid = false;
        }
    });

    submitButton.disabled = !isValid;
}

document.querySelectorAll('input').forEach(input => {
    input.addEventListener('input', validateForm);
});
</script>
