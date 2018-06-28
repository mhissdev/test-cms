<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('templates/admin_header_open'); ?>
<?php $this->load->view('templates/admin_header_close'); ?>

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h3>Categories</h3>
                <p>TODO: Categories Table</p>
            </div>
            <div class="col-md-4">
                <h3><?php echo $form_title; ?></h3>
                <?php
                // Action message
                $action_message = $this->session->flashdata('action_message');
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
                <!-- Categories Form -->
                <?php echo form_open(current_url()); ?>
                <div class="form-group">
                    <label for="category_title">Category Title <span class="text-danger">*</span></label>
                    <input type="text" id="category_title" class="form-control" name="category_title" placeholder="Category Title" 
                    value="<?php echo set_value('category_title', $category_title); ?>">
                </div>
                <div class="form-group">
                    <input type="submit" name="category_submit" value="<?php echo $form_button_value; ?>" class="btn btn-success">
                </div>
                </form>
            </div>
        </div>
    </div>

<?php $this->load->view('templates/admin_footer_open'); ?>
<?php $this->load->view('templates/admin_footer_close'); ?>
