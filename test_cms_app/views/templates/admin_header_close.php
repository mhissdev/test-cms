<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
    </head>
    <body>
        
    <!-- Main navigation -->
    <nav class="navbar fixed-top navbar-expand-md navbar-dark bg-custom">
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navigation" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="main-navigation">
            <!-- <div class="container"> -->
                <?php $this->navigation_admin->output($nav_name); ?>
                <span class="navbar-text welcome" style="margin-right:20px;"><?php echo $this->auth->getWelcome(); ?></span>
                <a href="<?php echo base_url(); ?>/account/logout" class="btn btn-primary">Logout</a>
            <!-- </div> -->
        </div> 
    </nav>
