<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('templates/admin_header_open'); ?>
<?php $this->load->view('templates/admin_header_close'); ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Posts</h3>
                <p>TODO: Posts Table</p>
                <p><a href="<?php echo base_url(); ?>admin/posts/manage/" class="btn btn-primary">Add New Post</a></p>
            </div>
        </div>
    </div>

<?php $this->load->view('templates/admin_footer_open'); ?>
<?php $this->load->view('templates/admin_footer_close'); ?>
