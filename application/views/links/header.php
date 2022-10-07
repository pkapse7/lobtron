<!DOCTYPE html>
<html lang="en">
<head>
        
        <meta charset="utf-8" />
        <title><?=$title?> | Supermarket-Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?=base_url('assets/')?>images/cpschool_trans.png">

        <!-- Bootstrap Css -->
        <link href="<?=base_url('assets/')?>css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="<?=base_url('assets/')?>css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="<?=base_url('assets/')?>css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

        

    </head>

    <body data-sidebar="dark">

        <!-- Begin page -->
        <div id="layout-wrapper">

            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="<?=base_url('')?>" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="<?=base_url('assets/')?>images/cpmm_logo.png" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="<?=base_url('assets/')?>images/cpmm.png" alt="" height="17">
                                </span>
                            </a>

                            <a href="<?=base_url('')?>" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="<?=base_url('assets/')?>images/cpmm_logo.png" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="<?=base_url('assets/')?>images/cpmm.png" alt="" height="19">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>

                        <!-- App Search-->
                        <form class="app-search d-none d-lg-block">
                            <div class="position-relative">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="bx bx-search-alt"></span>
                            </div>
                        </form>
                        
                    </div>

                    <div class="d-flex">

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="<?=base_url('assets/')?>images/users/avatar-2.jpg"
                                    alt="Header Avatar">
                                <span class="d-none d-xl-inline-block ml-1"><?=$this->session->userdata('name')?></span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <!-- item-->
                                <a class="dropdown-item text-danger" href="<?=site_url('admin-logout')?>"><i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i> Logout</a>
                            </div>
                        </div>

                    </div>
                </div>
            </header> 
        <?php include dirname(__FILE__) . '/side_nav.php'; ?>    
            