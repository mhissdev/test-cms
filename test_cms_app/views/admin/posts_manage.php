<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('templates/admin_header_open'); ?>
        <!-- JQuery UI -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<?php $this->load->view('templates/admin_header_close'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3><?php echo $form_title; ?></h3>
                <?php
                // Validation errors
                if(isset($validation_errors))
                {
                    // Output Bootstrap alert message
                    echo $this->bootstrap_alerts->validation($validation_errors);
                }
                ?>
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
                                    placeholder="Leading paragraph goes here..."><?php echo set_value('post_leading', $post_leading); ?></textarea>
                            </div>
                            <div class="form-group">
                                <p class="small btn btn-primary" id="image-insert">Insert Image</p>
                                <textarea class="form-control" id="post_content" name="post_content" rows="12" 
                                placeholder="Main content goes here..."><?php echo set_value('post_content', $post_content); ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card form-card">
                            <div class="form-group">
                                <label for="post_description">Post Description</label>
                                <p class="small">This is used for SEO purposes and should be a short summary of your content</p>
                                <textarea class="form-control" id="post_description" name="post_description" rows="2" 
                                placeholder="SEO description goes here..."><?php echo set_value('post_description', $post_description); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="post_date">Post Date <span class="text-danger">*</span></label>
                                <input type="text" id="post_date" class="form-control" name="post_date">
                            </div>
                            <div class="form-group">
                                <label for="post_category">Category <span class="text-danger">*</span></label>
                                <?php 
                                $extra = 'class="form-control" id="post_category"';
                                echo form_dropdown('post_category_id', $post_categories, set_value('post_category_id', $post_category_id), $extra); 
                                ?>
                            </div>
                            <div class="form-group">
                                <label for="post_status">Status <span class="text-danger">*</span></label>
                                <?php 
                                $extra = 'class="form-control" id="post_status"';
                                echo form_dropdown('post_status_id', $post_statuses, set_value('post_status_id', $post_status_id), $extra); 
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

    <!-- Select Image Modal -->
    <div class="modal fade" id="image-select-modal" tabindex="-1" role="dialog" aria-labelledby="image-select-label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="image-select-label">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php

                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!--
    <div class="modal-fade" id="select-image" tabindex="-1" role="dialog" aria-labelledby="select-image" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                The Content...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    -->

<?php $this->load->view('templates/admin_footer_open'); ?>
<script src="<?php echo base_url() . 'js/tinymce/tinymce.min.js' ?>"></script>
<script>
    // JQuery UI Datepicker
    $(document).ready(function(){        
        // Init datepicker
        $('#post_date').datepicker();

        // Set format ("yyyy-mm-dd")
        $('#post_date').datepicker('option', 'dateFormat', 'yy-mm-dd');
        $('#post_date').datepicker('setDate', '<?php echo set_value('post_date', $post_date); ?>');

        // Tiny MCE
        tinymce.init({
        selector: '#post_content',
        menubar: false,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code'
            ],
            toolbar: 'undo redo | bold italic | bullist numlist | link | code'
        });

        // Insert Image Button
        $('#image-insert').click(function(){
            // var content = '<img src="" alt="Some Image">';
            $('#image-select-modal').modal();
            var content = '<p>TODO:</p>';
            tinymce.activeEditor.execCommand('mceInsertContent', false, content);
        });
    });

</script>
<?php $this->load->view('templates/admin_footer_close'); ?>