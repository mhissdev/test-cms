<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('templates/admin_header_open'); ?>
<!-- Datatables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<?php $this->load->view('templates/admin_header_close'); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h3>Posts</h3>
                <?php
                // Action message
                $action_message = $this->session->flashdata('action_message');
                if(isset($action_message))
                {
                    // Output Bootstrap alert message
                    echo $this->bootstrap_alerts->alert($action_message);
                }
                ?>

                <?php
                // Posts Table
                if(count($posts) === 0)
                {
                    echo('<p>Currently no posts to display</p>');
                }
                else
                {
                    // Build HTML table
                    $str = '<table class="table table-striped table-bordered" id="table-datatables">';
                    $str .= '<thead><tr><th>Title</th><th>Category</th><th>Status</th><th>Date</th><th>Author</th><th>#</th></tr></thead><tbody>';

                    foreach($posts as $post)
                    {
                        $str .= '<tr><td>' . $post['Post_Title'] . '</td>';
                        $str .= '<td>' . $post['Post_Category_Title'] . '</td>';
                        $str .= '<td>' . $post['Post_Status_Title'] . '</td>';
                        $str .= '<td>' . date('Y-m-d', $post['Post_Date']) . '</td>';
                        $str .= '<td>' . $post['User_Firstname'] . ' ' . $post['User_Lastname'] . '</td>';
                        $str .= '<td><a href="' . base_url() . 'admin/posts/manage/' . $post['Post_ID'] . '"><i class="fas fa-edit"></i></a></td></tr>';
                    }

                    $str .= '</tbody></table>';

                    // Output table
                    echo $str;
                }

                ?>

                <p><a href="<?php echo base_url(); ?>admin/posts/manage/" class="btn btn-primary">Add New Post</a></p>
            </div>
        </div>
    </div>

<?php $this->load->view('templates/admin_footer_open'); ?>
<!-- Datatables JS -->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script>
    // Datatables instantiate
    $(document).ready(function(){
        $('#table-datatables').DataTable({
            "order": [[ 1, "asc" ]],
        });
    });
</script>
<?php $this->load->view('templates/admin_footer_close'); ?>
