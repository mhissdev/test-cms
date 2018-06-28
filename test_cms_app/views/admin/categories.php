<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php $this->load->view('templates/admin_header_open'); ?>
<!-- Datatable CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<?php $this->load->view('templates/admin_header_close'); ?>

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h3>Categories</h3>
                <?php
                // Categories table
                if(count($categories) === 0)
                {
                    echo('<p>Currently no categories to display</p>');
                }
                else
                {
                    // Build table HTML
                    $str = '<table class="table table-striped table-bordered" id="table-datatables">';
                    $str .= '<thead><tr><th>ID</th><th>Category Title</th><th>#</th></tr></thead><tbody>';

                    foreach($categories as $category)
                    {
                        $str .= '<tr><td>' . $category['Post_Category_ID'] . '</td>';
                        $str .= '<td>' . $category['Post_Category_Title'] . '</td>';
                        $str .= '<td><a href="' . base_url() . 'admin/categories/';
                        $str .= $category['Post_Category_ID'] . '"><i class="fas fa-edit"></i></a></td></tr>';
                    }

                    $str .= '</tbody></table>';

                    // Output table
                    echo $str;
                }
                ?>
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
                    <?php
                        if($form_button_value == 'Update')
                        {
                            echo '<a href="' . base_url() . 'admin/categories/" class="btn btn-danger">Cancel</a>';
                        }
                    ?>
                    <input type="submit" name="category_submit" value="<?php echo $form_button_value; ?>" class="btn btn-success">
                </div>
                </form>
            </div>
        </div>
    </div>

<?php $this->load->view('templates/admin_footer_open'); ?>
<!-- Datatables JS -->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script>
    // Datatables init
    $(document).ready(function(){
        $('#table-datatables').DataTable({
            "order": [[ 1, "asc" ]],
        });
    });
</script>
<?php $this->load->view('templates/admin_footer_close'); ?>
