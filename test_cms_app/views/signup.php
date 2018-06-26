<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>TODO: Site Name</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css">
    </head>
    <body>
        <!-- Site header -->
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1><a href="<?php echo base_url(); ?>">Test CMS</a></h1>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h3>Sign Up:</h3>
                    <!-- Validation errors -->
                    <?php
                    if(isset($validation_errors))
                    {
                        $str = '<div class="alert alert-danger" role="alert">';
                        $str .= '<p>Please fix the following errors:-</p><ul>';
                        $str .= $validation_errors . '</ul></div>';
                        echo($str);
                    }

                    ?>

                    <!-- Sign Up Form -->
                    <?php echo form_open('account/signup'); ?>
                        <div class="form-group">
                            <label for="email">Email<span class="text-danger">*</span></label>
                            <input type="email" id="email" class="form-control" name="email" placeholder="Enter Your Email" value="<?php echo set_value('email');?>">
                        </div>
                        <div class="form-group">
                            <label for="firstname">First Name<span class="text-danger">*</span></label>
                            <input type="text" id="firstname" class="form-control" name="firstname" placeholder="Enter Your First Name">
                        </div>
                        <div class="form-group">
                            <label for="lastname">Last Name<span class="text-danger">*</span></label>
                            <input type="text" id="lastname" class="form-control" name="lastname" placeholder="Enter Your Last Name">
                        </div>
                        <div class="form-group">
                            <label for="password">Password <span class="text-danger">*</span></label>
                            <input type="password" id="password" class="form-control" name="password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="password2">Password Confirm <span class="text-danger">*</span></label>
                            <input type="password" id="password2" class="form-control" name="password2" placeholder="Re-enter Password">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="signup-submit" value="Sign Up" class="btn btn-success">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>
