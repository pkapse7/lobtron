
<div class="main-content">

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">All <?=$title?></h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#addModal" id="btnAdd">Add <?=substr($title, 0, -1);?></button>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="con_table" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Photo</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="show_data">
                            </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- container-fluid -->
</div>
            <!-- End Page-content -->
<div id="addModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form class="custom-validation add-contact" method="post" action="" enctype="multipart/form-data">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Add <?=substr($title, 0, -1);?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <label>First Name *</label>
                          <input type="text" class="form-control customcardinput" name="first_name" id="first_name" required="" placeholder="Enter First Name" onkeypress="return onlyAlphabets(event,this);">
                          <span class="errors" id="fname_err" style="color:red; font-size:13px"></span>
                      </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label>Last Name *</label>
                        <input type="url" class="form-control customcardinput" name="last_name" id="last_name" required="" placeholder="Enter Last Name" onkeypress="return onlyAlphabets(event,this);">
                        <span class="errors" id="lname_err" style="color:red; font-size:13px"></span>
                    </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <label>Email *</label>
                          <input type="email" class="form-control customcardinput" name="email" id="email" required="" placeholder="Enter Email">
                          <span class="errors" id="email_err" style="color:red; font-size:13px"></span>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                          <label>Phone *</label>
                          <input type="tel" class="form-control customcardinput" name="phone" id="phone" required="" placeholder="Enter Phone No" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" maxlength="10">
                          <span class="errors" id="phone_err" style="color:red; font-size:13px"></span>
                      </div>
                  </div>
              </div>
              <div class="form-group">
                  <label>Address </label>
                  <textarea class="form-control" rows="2" name="address" id="address"></textarea>
              </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Status *</label>
                            <select class="form-control customcardinput select2 select2-hidden-accessible" name="status" id="type_select" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                <option value="">--Select Status--</option>
                                <option value="0">Active</option>
                                <option value="1">Inactive</option>
                            </select>
                            <span class="errors" id="type_err" style="color:red; font-size:13px"></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                          <label>Photo </label>
                          <input type="file" class="form-control customcardinput" name="photo" id="photo">
                          <span class="errors" id="photo_err" style="color:red; font-size:13px"></span>
                      </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <img id="contact_img_tag" alt="No Photo" src="<?php echo base_url('assets/uploads/600px-No_image_available.svg (2).png') ?>" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal" >Close</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light" id="btnSave">Submit</button>
            </div>
        </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="editModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form class="custom-validation update-contact" method="post" action="" autocomplete="off" enctype="multipart/form-data">
          <input value="" name="original_email" id="original_email" type="hidden" >
          <input value="" name="original_phone" id="original_phone" type="hidden" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Update <?=substr($title, 0, -1);?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" name="contactID" id="contactID_e" class="form-control">
            <div class="modal-body">
              <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <label>First Name *</label>
                          <input type="text" class="form-control customcardinputs" name="first_name" id="first_name_e" required="" placeholder="Enter First Name" onkeypress="return onlyAlphabets(event,this);">
                          <span class="errors" id="fname_e_err" style="color:red; font-size:13px"></span>
                      </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label>Last Name *</label>
                        <input type="url" class="form-control customcardinputs" name="last_name" id="last_name_e" required="" placeholder="Enter Last Name" onkeypress="return onlyAlphabets(event,this);">
                        <span class="errors" id="lname_e_err" style="color:red; font-size:13px"></span>
                    </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <label>Email *</label>
                          <input type="email" class="form-control customcardinputs" name="email" id="email_e" required="" placeholder="Enter Email">
                          <span class="errors" id="email_e_err" style="color:red; font-size:13px"></span>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                          <label>Phone *</label>
                          <input type="tel" class="form-control customcardinputs" name="phone" id="phone_e" required="" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" maxlength="10">
                          <span class="errors" id="phone_e_err" style="color:red; font-size:13px"></span>
                      </div>
                  </div>
              </div>
              <div class="form-group">
                  <label>Address </label>
                  <textarea class="form-control" rows="2" name="address" id="address_e"></textarea>
              </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Status *</label>
                            <select class="form-control customcardinputs select2 select2-hidden-accessible" name="status" id="type_select_e" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                        <option value="">--Select Status--</option>
                                        <option value="0">Active</option>
                                        <option value="1">Inactive</option>
                                    </select>
                            </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                          <label>Photo </label>
                          <input type="file" class="form-control customcardinputs" name="photo" id="photo_e">
                          <span class="errors" id="photo_e_err" style="color:red; font-size:13px"></span>

                      </div>
                    </div>
                    <div class="col-md-3">
                        <img id="contact-img-tag-upd" class="banner_photo" alt="No photo" src="<?php echo base_url('assets/uploads/default.png') ?>" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal" >Close</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light" id="btnUpdate">Submit</button>
            </div>
        </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="custom-validation delete-contact" method="post" action="" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Delete <?=substr($title, 0, -1);?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" name="deleteConId" id="deleteConId" class="form-control">
            <div class="modal-body">
                <center><h5>Are you sure to delete this record ?</h5></center>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal" >Close</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light" id="btnDelete">Submit</button>
            </div>
        </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
