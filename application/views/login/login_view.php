<!DOCTYPE html>
<html lang="en">
<head>
        
        <meta charset="utf-8" />
        <title><?=$title?> | Labtron</title>
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

    <body>
        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card overflow-hidden">
                            <div class="bg-soft-primary">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="text-primary p-4">
                                            <h5 class="text-primary">Welcome Back !</h5>
                                            <p>Sign in to continue to LABTRON.</p>
                                        </div>
                                    </div>
                                    <div class="col-5 align-self-end">
                                        <img src="<?=base_url('assets/')?>images/profile-img.png" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0"> 
                                <div>
                                    <a href="index.html">
                                        <div class="avatar-md profile-user-wid mb-4">
                                            <span class="avatar-title rounded-circle bg-light">
                                                <img src="<?=base_url('assets/')?>images/cpschool_trans.png" alt="" class="rounded-circle" height="34">
                                            </span>
                                        </div>
                                    </a>
                                </div>
                                <div class="p-2">
                                    <form class="form-horizontal" action="<?=site_url('login')?>" method="post" >
        
                                        <div class="form-group">
                                            <label for="username">Username *</label>
                                            <input type="text" class="form-control" id="username" name="email" placeholder="Enter username">
                                        </div>
                
                                        <div class="form-group">
                                            <label for="userpassword">Password *</label>
                                            <input type="password" class="form-control" id="userpassword" name="password" placeholder="Enter password">
                                        </div>

                                        <?php if (isset($_SESSION['error_msg'])): ?>
                                            <p class="text-sm text-red-500" style="color:red;"><?=$_SESSION['error_msg']; ?></p>
                                        <?php endif; ?>
                                        
                                        <div class="mt-3">
                                            <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Log In</button>
                                        </div>
                                        
                                    </form>
                                </div>
            
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            <div>
                                <p>© <?=date('Y')?> <b>LABTRON</b> Design & Developed <i class="mdi mdi-heart text-danger"></i> by me</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- JAVASCRIPT -->
        <script src="<?=base_url('assets/')?>libs/jquery/jquery.min.js"></script>
        <script src="<?=base_url('assets/')?>libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?=base_url('assets/')?>libs/metismenu/metisMenu.min.js"></script>
        <script src="<?=base_url('assets/')?>libs/simplebar/simplebar.min.js"></script>
        <script src="<?=base_url('assets/')?>libs/node-waves/waves.min.js"></script>
        
        <!-- App js -->
        <script src="<?=base_url('assets/')?>js/app.js"></script>
    </body>
</html>
