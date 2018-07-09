<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('templates/admin_header_open'); ?>
<?php $this->load->view('templates/admin_header_close'); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <h3>Images</h3>
                <?php
                // Validation errors
                if(isset($validation_errors))
                {
                    // Output Bootstrap alert message
                    echo $this->bootstrap_alerts->validation($validation_errors);
                }
                ?>
                <?php echo form_open_multipart(current_url()); ?>
                <div class="form-group">
                    <label for="image_upload_title">Image Title <span class="text-danger">*</span></label>
                    <input type="text" name="image_upload_title" id="image_upload_title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="image_upload_description">Image Description</label>
                    <textarea class="form-control" id="image_upload_description" name="image_upload_description" rows="2"></textarea>
                </div>
                <div class="form-group">
                    <label for="image_upload_file">Select Image (jpg, png, or gif):</label>
                    <input type="file" id="image_upload_file" name="image_upload_file" class="form-control-file">
                </div>
                <div class="form-group">
                    <input type="submit" name="image_upload_submit" value="Upload" class="btn btn-success">
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>

<?php $this->load->view('templates/admin_footer_open'); ?>
<?php $this->load->view('templates/admin_footer_close'); ?>
