<!DOCTYPE html>
<html>

    <head>
        <title>ConnectKarma</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" href="<?php echo base_url('/assets/'); ?>css/styles.css">
        <link rel="stylesheet" href="<?php echo base_url('/assets/'); ?>css/animate.css">
        <link rel="stylesheet" href="<?php echo base_url('/assets/'); ?>css/font-awesome.css">
        <link rel="stylesheet" href="<?php echo base_url('/assets/'); ?>css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url('/assets/'); ?>css/messages.css">
        <link rel="icon" href="<?php echo base_url('/assets/'); ?>images/favicon.ico" type="image/x-icon" />
        
        <script src="<?php echo base_url('/assets/'); ?>js/jquery.min.js"></script>
        <script src="<?php echo base_url('/assets/'); ?>js/script.js"></script>
    </head>

    <body>

        <header>
            <div class="main">
                <div class="logo">
                    <a href="<?php echo base_url('index.php/User/'); ?>"><img src="<?php echo base_url('/assets/'); ?>images/logo-1.png" alt="Logo"/></a>
                </div>
                <div class="navigation wow zoomIn">
                    <nav>
                        <ul>
                            <li><a href="<?php echo base_url('index.php/DataAnalytics/'); ?>">Data Analytic</a> <span>/</span></li>
                            <li><a href="<?php echo base_url('index.php/Event/'); ?>">Events</a> <span>/</span></li>
                            <li><a href="<?php echo base_url('index.php/About/'); ?>">About</a> <span>/</span></li>
                            <li><a href="<?php echo base_url('index.php/Blog/'); ?>">Blog</a> <span>/</span></li>
                            <!--<li><a href="<?php //echo base_url('index.php/News');   ?>">News</a></li>-->
                            <li><a href="<?php echo base_url('index.php/Contact/'); ?>">Contact</a> <span>/</span></li>
                            <li>
                                <a id="User_Register" href="<?php echo base_url('index.php/User/register'); ?>">User Register</a>
                                <a id="Logout" href="<?php echo base_url('index.php/User/Logout'); ?>">Logout</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>

        <?php
        /* echo MSG_INFO;
          echo MSG_SUCCESS;
          echo MSG_WARNING;
          echo MSG_ERROR; */
        ?>

        <div class="messages">
            <div class="info" id="MSG_INFO"></div>       
            <div class="success" id="MSG_SUCCESS"></div>
            <div class="warning" id="MSG_WARNING"></div>            
            <div class="error" id="MSG_ERROR"></div>
        </div>

        <style>
            #Logout {
                display: none
            }
        </style>