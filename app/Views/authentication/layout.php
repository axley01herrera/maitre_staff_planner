<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Maitre Staff Planner | <?php echo $pageTitle;?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Software" name="description" />
        <meta content="Axley Herrera" name="author" />

        <!-- APP ICON -->
        <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.ico');?>">

        <!-- CSS -->
        <link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/icons.min.css');?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/app.min.css');?>" id="app-style" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/libs/animate/animate.css');?>" rel="stylesheet">
        <link  href="<?php echo base_url('assets/libs/sweetalert/sweetalert2.css');?>" rel="stylesheet">

        <!-- JS -->
        <script src="<?php echo base_url('assets/libs/jquery.js');?>"></script>
        <script src="<?php echo base_url('assets/libs/sweetalert/sweetalert2.js');?>"></script>
        <script src="<?php echo base_url('assets/libs/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
        <script src="<?php echo base_url('assets/libs/metismenujs/metismenujs.min.js');?>"></script>
        <script src="<?php echo base_url('assets/libs/simplebar/simplebar.min.js');?>"></script>
        <script src="<?php echo base_url('assets/libs/feather-icons/feather.min.js');?>"></script>
    </head>
    <body>
        <div id="main-modal"></div>
        <div class="authentication-bg min-vh-100">
            <div class="container">
                <div class="d-flex flex-column min-vh-100 px-3 pt-4">
                    <nav class="navbar navbar-expand-lg" style="position: top; background-color: #ffffff;">
                        <div class="container-fluid">
                            <h2 class="text-primary fw-bolder">MAITRE STAFF PLANNER</h2>
                            <ul class="navbar-nav ms-auto me-5 mb-2 mb-lg-0 ">
                            
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-success" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <?php 
                                            if($language == 'es')
                                            {
                                        ?>
                                                <img src="<?php echo base_url('assets/images/flags/spain.jpg');?>" alt="ES" class="img-fluid" width="50px">
                                        <?php 
                                            }
                                            else
                                            {
                                        ?>
                                                <img src="<?php echo base_url('assets/images/flags/us.jpg');?>" alt="EN" class="img-fluid" width="50px">
                                        <?php
                                            }
                                        ?>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item locale" href="<?php echo base_url($route).'?language=es';?>">
                                                <img src="<?php echo base_url('assets/images/flags/spain.jpg');?>" alt="ES" class="img-fluid" width="25px"> <?php echo lang('Text.spanish');?>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item locale" href="<?php echo base_url($route).'?language=en';?>">
                                                <img src="<?php echo base_url('assets/images/flags/us.jpg');?>" alt="EN" class="img-fluid" width="25px"> <?php echo lang('Text.english');?>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <div class="row justify-content-center my-auto">
                        <div class="col-md-8 col-lg-6 col-xl-4">
                            <?php echo view($page);?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="text-center text-muted p-4">
                                <p class="mb-0">&copy; <script>document.write(new Date().getFullYear())</script></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php echo view('global/js');?>
    </body>
</html>
