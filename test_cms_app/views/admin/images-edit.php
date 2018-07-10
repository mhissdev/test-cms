<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('templates/admin_header_open'); ?>
<?php $this->load->view('templates/admin_header_close'); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <h3>Edit Image Details</h3>
                <?php
                // Validation errors
                if(isset($validation_errors))
                {
                    // Output Bootstrap alert message
                    echo $this->bootstrap_alerts->validation($validation_errors);
                }

                ?>
                <?php echo form_open(current_url()); ?>
                <div class="form-group">
                    <label for="image_title">Image Title <span class="text-danger">*</span></label>
                    <input type="text" name="image_title" id="image_title" class="form-control" value="<?php echo set_value('image_title', $image_title); ?>">
                </div>
                <div class="form-group">
                    <label for="image_description">Image Description</label>
                    <textarea class="form-control" id="image_description" name="image_description" rows="2"><?php echo set_value('image_description', $image_description); ?></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" name="image_edit_submit" value="Update" class="btn btn-success">
                </div>
                <?php echo form_close(); ?>
            </div>
            <div class="col-md-8">
                <img class="img-fluid" src="<?php echo base_url() . $this->config->item('image_upload_dir') . $image_filename;?>">
            </div>
        </div>
    </div>

<?php $this->load->view('templates/admin_footer_open'); ?>
<?php $this->load->view('templates/admin_footer_close'); ?>