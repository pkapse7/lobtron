

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Change Password</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Settings</a></li>
                                <li class="breadcrumb-item active">Change Password</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row" style="overflow-x: auto;">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form class="custom-validation" action="<?=site_url('change-password')?>" method="POST">
                                <div class="form-group">
                                    <label>New Password</label>
                                    <input type="password" id="pass2" class="form-control" name="password" required placeholder="New Password"/>
                                </div>
                                <div class="form-group">
                                    <label>Conform New Password</label>
                                    <div class="mt-2">
                                        <input type="password" class="form-control" name="confirm_password" required data-parsley-equalto="#pass2"placeholder="Re-Type New Password"/>
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <div>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                            Submit
                                        </button>
                                        <button type="reset" class="btn btn-secondary waves-effect">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
</div>    
