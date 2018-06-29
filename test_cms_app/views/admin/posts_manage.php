<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('templates/admin_header_open'); ?>
        <!-- JQuery UI -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
        <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
<?php $this->load->view('templates/admin_header_close'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3><?php echo $form_title; ?></h3>
                <?php echo form_open(current_url()); ?>
                <div class="row">
                    <div class="col-md-8">
                        <div class="card form-card">
                            <div class="form-group">
                                <label for="post_title">Post Title <span class="text-danger">*</span></label>
                                <input type="text" id="post_title" class="form-control" name="post_title" placeholder="Title" 
                                value="<?php echo set_value('post_title', $post_title); ?>">
                            </div>
                            <div class="form-group">
                                <label for="post_leading">Leading Text</label>
                                <textarea class="form-control" id="post_leading" name="post_leading" rows="2" 
                                    placeholder="Leading paragraph goes here..."></textarea>
                            </div>
                            <div class="form-group">
                                <label for="post_content">Main Content</label>
                                <textarea class="form-control" id="post_content" name="post_content" rows="12" 
                                placeholder="Main content goes here..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card form-card">
                            <div class="form-group">
                                <label for="post_description">Post Description</label>
                                <p class="small">This is used for SEO purposes and should be a short summary of your content</p>
                                <textarea class="form-control" id="post_description" name="post_description" rows="2" 
                                placeholder="SEO description goes here..."></textarea>
                            </div>
                            <div class="form-group">
                                <label for="post_date">Post Date <span class="text-danger">*</span></label>
                                <input type="text" id="post_date" class="form-control" name="post_date" value="">
                            </div>
                            <div class="form-group">
                                <label for="post_category">Category <span class="text-danger">*</span></label>
                                <?php 
                                $extra = 'class="form-control" id="post_category"';
                                echo form_dropdown('post_category', $post_categories, '0', $extra); 
                                ?>
                            </div>
                            <div class="form-group">
                                <label for="post_status">Status <span class="text-danger">*</span></label>
                                <?php 
                                $extra = 'class="form-control" id="post_status"';
                                echo form_dropdown('post_status', $post_statuses, '0', $extra); 
                                ?>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="post_submit" value="<?php echo $form_button_value; ?>" class="btn btn-success float-right">
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>

<?php $this->load->view('templates/admin_footer_open'); ?>
<script src="<?php echo base_url() . 'js/tinymce/tinymce.min.js' ?>"></script>
<script>
    // JQuery UI Datepicker
    $(document).ready(function(){        
        // Init datepicker
        $('#post_date').datepicker();

        // Set format ("yy-mm-dd")
        $('#post_date').datepicker('option', 'dateFormat', 'dd-mm-yy');

        // Tiny MCE
            tinymce.init({
            selector: '#post_content',
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table contextmenu paste code'
            ],
            toolbar: 'undo redo | styleselect | bold italic | bullist numlist | link image | code'
        });
    });

</script>
<?php $this->load->view('templates/admin_footer_close'); ?>