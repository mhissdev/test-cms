<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('templates/admin_header_open'); ?>
<?php $this->load->view('templates/admin_header_close'); ?>

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h3>Settings</h3>
            </div>
            <div class="col-md-4">
            	<h3>Change Password</h3>
            	<?php
            	// Action message
                if(isset($action_message))
                {
                    // Output Bootstrap alert message
                    echo $this->bootstrap_alerts->alert($action_message);
                }

            	// Validation errors
                if(isset($validation_errors))
                {
                    // Output Bootstrap alert message
                    echo $this->bootstrap_alerts->validation($validation_errors);
                }
            	?>
            	<?php echo form_open(current_url()); ?>
            	<div class="form-group">
            		<label for="password_old">Old Password <span class="text-danger">*</span></label>
            		<input type="password" id="passowrd_old" name="password_old" class="form-control">
            	</div>
            	<div class="form-group">
            		<label for="password">New Password <span class="text-danger">*</span></label>
            		<input type="password" id="password" name="password" class="form-control">
            	</div>
            	<div class="form-group">
            		<label for="password2">Re-enter New Password <span class="text-danger">*</span></label>
            		<input type="password" name="password2" id="passowrd2" class="form-control">
            	</div> 
            	<div class="form-group">
            		<input type="submit" name="password_submit" value="Update Password" class="btn btn-success">
            	</div>
            	<?php echo form_close(); ?>
            </div>
        </div>
    </div>

<?php $this->load->view('templates/admin_footer_open'); ?>
<?php $this->load->view('templates/admin_footer_close'); ?>