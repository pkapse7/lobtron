
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-18"><?=$title?></h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-xl-12">
                                
                                <!-- end card -->

                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Personal Information</h4>
                                        <div class="table-responsive">
                                            <table class="table table-nowrap mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">Name :</th>
                                                        <td><?=$profile_data->employee_name?></td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <th scope="row">E-mail :</th>
                                                        <td><?=$profile_data->email?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Department :</th>
                                                        <td><?=$profile_data->department_name?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Designation :</th>
                                                        <td><?=$profile_data->designation?></td>
                                                    </tr>
                                                    <tr>
                                                        <th cope="row">Salary :</th>
                                                        <td>Rs. <?=$profile_data->salary?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card -->
 
                                <!-- end card -->
                            </div>         
                            
                            
                        </div>
                        <!-- end row -->

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
            </div>
            <!-- end main content-->

        