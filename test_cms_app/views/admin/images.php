<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('templates/admin_header_open'); ?>
<?php $this->load->view('templates/admin_header_close'); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <h3>Upload Image</h3>
                <?php
                // Validation errors
                if(isset($validation_errors))
                {
                    // Output Bootstrap alert message
                    echo $this->bootstrap_alerts->validation($validation_errors);
                }

                // Action message
                if(isset($action_message))
                {
                    // Output Bootstrap alert message
                    echo $this->bootstrap_alerts->alert($action_message);
                }
                ?>
                <?php echo form_open_multipart(current_url()); ?>
                <div class="form-group">
                    <label for="image_upload_title">Image Title</label>
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
            <div class="col-md-8">
                <h3>Images</h3>
                <?php
                // Output images in table
                if(count($images) === 0)
                {
                    echo '<p>Currently no images to display</p>';
                }
                else
                {
                    // Build table
                    $str = '<table class="table table-striped table-bordered" id="table-datatables">';
                    $str .= '<thead><tr><th>Image</th><th>Title</th><th>Description</th><th>#</th></tr></thead><tbody>';

                    // Build rows
                    foreach($images as $image)
                    {
                        // Start row
                        $str .= '<tr>';

                        // Image
                        $str .= '<td style="width: 200px;"><img src="'. base_url() . $this->config->item('image_upload_dir');
                        $str .= $image['Image_Filename'] . '" class="img-fluid img-thumbnail"></td>';

                        // Title
                        $str .= '<td>' . $this->security->xss_clean($image['Image_Title']) . '</td>';

                        // Description
                        $str .= '<td>' . $this->security->xss_clean($image['Image_Description']) . '</td>';

                        // Edit link
                        $str .= '<td><a href="' . base_url() . 'admin/images/edit/' . $image['Image_ID'] . '"><i class="fas fa-edit"></i></a></td>';

                        // End row
                        $str .= '</tr>';
                    }

                    $str .= '</tbody></table>';

                    // Output table
                    echo $str;
                }
                ?>
            </div>
        </div>
    </div>

<?php $this->load->view('templates/admin_footer_open'); ?>
<?php $this->load->view('templates/admin_footer_close'); ?>
