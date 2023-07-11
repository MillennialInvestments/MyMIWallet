<div class="form-group">
    <label for="email" class="sr-only">Email address:</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" value="<?php echo set_value('email', isset($user) ? $user->email : ''); ?>" required>
</div>