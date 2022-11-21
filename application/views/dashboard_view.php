
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-18">Dashboard</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                            <li class="breadcrumb-item active">Dashboard</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-xl-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card mini-stats-wid">
                                            <div class="card-body">
                                              <div class="row justify-content-center">
                                                <div class="col-lg-12">
                                                    <div class="text-center mb-5">
                                                        <h4 class="display-4 ">Hi there! Good
                                                          <?php $current_time= Date('G');
                                                            if ($current_time >= 12 && $current_time <= 18) {
                                                              echo 'afternoon.';
                                                            }elseif ($current_time >= 18 && $current_time <= 24) {
                                                              echo 'evening.';
                                                            }elseif ($current_time >= 5 && $current_time <= 12) {
                                                              echo 'morning.';
                                                            }else{
                                                              echo 'night.';
                                                            }
                                                         ?>
                                                      </h4>
                                                        <?php if($this->session->userdata('type')== 0){ ?>
                                                        <h4 class="text-uppercase">A warm welcome and all our good wishes to you in our company.</h4>
                                                        <?php }else if($this->session->userdata('type')== 1){ ?>
                                                        <h4 class="text-uppercase">Welcome to our group! We hope for a long and successful journey with you.</h4>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                  <div class="col-md-8 col-xl-6">
                                                      <div>
                                                          <?php if($this->session->userdata('type')== 0){ ?>
                                                            <img src="<?=base_url()?>assets/images/error-img.png" alt="" class="img-fluid">
                                                          <?php }else if($this->session->userdata('type')== 1){ ?>
                                                            <img src="<?=base_url()?>assets/images/profile-img.png" alt="" class="img-fluid">
                                                          <?php } ?>
                                                      </div>
                                                  </div>
                                              </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- end row -->


                            </div>
                        </div>
                        <!-- end row -->
                    </div>
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
