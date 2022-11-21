<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Update Details</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Update</a></li>
                                <li class="breadcrumb-item active">Profile</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form class="update-profile" method="post" action="" enctype="multipart/form-data">
                                <input value="<?=$profile->company_name?>" name="original_name" type="hidden" >
                                <input value="<?=$profile->email?>" name="original_email" type="hidden" >
                                <input value="<?=$profile->phone?>" name="original_phone" type="hidden" >
                                <input value="<?=base64_encode($profile->companyID)?>" id="companyID " name="companyID" type="hidden" class="form-control">
                                <div class="form-group row mb-4">
                                    <label for="projectname" class="col-form-label col-lg-2">Company Name *</label>
                                    <div class="col-lg-10">
                                        <input value="<?=$profile->company_name?>" id="company_name_p" name="company_name" type="text" class="form-control projectname" placeholder="Enter Company Name" onkeypress="return onlyAlphabets(event,this);">
                                        <span class="errors" id="name_err" style="color:red; font-size:13px"></span>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label for="projectname" class="col-form-label col-lg-2">Phone *</label>
                                    <div class="col-lg-10">
                                        <input value="<?=$profile->phone?>" id="phone_p" name="phone" type="tel" class="form-control projectname" placeholder="Enter Phone No" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" maxlength="10">
                                        <span class="errors" id="phone_err" style="color:red; font-size:13px"></span>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label for="projectname" class="col-form-label col-lg-2">Email *</label>
                                    <div class="col-lg-10">
                                        <input value="<?=$profile->email?>" id="email_p" name="email" type="text" class="form-control projectname" placeholder="Enter Project Name...">
                                        <span class="errors" id="email_err" style="color:red; font-size:13px"></span>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label for="projectname" class="col-form-label col-lg-2">Website *</label>
                                    <div class="col-lg-10">
                                        <input value="<?=$profile->website?>" id="website_p" name="website" type="text" class="form-control projectname" placeholder="Enter Project Name...">
                                        <span class="errors" id="website_err" style="color:red; font-size:13px"></span>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label for="projectdesc" class="col-form-label col-lg-2">Address</label>
                                    <div class="col-lg-10">
                                        <textarea class="form-control" id="address_p" name="address" rows="1" placeholder="Enter Project Description..."><?=$profile->address?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label for="projectname" class="col-form-label col-lg-2">Status</label>
                                    <div class="col-lg-10">
                                        <select class="form-control customcardinput select2 select2-hidden-accessible" name="status" id="type_select" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                            <option value="0" <?php if($profile->status==0){ echo 'selected';} ?>>Active</option>
                                            <option value="1" <?php if($profile->status==1){ echo 'selected';} ?>>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label for="projectname" class="col-form-label col-lg-2">Photo</label>
                                    <div class="col-lg-6">
                                          <input type="file" class="form-control projectname" name="photo" id="photo_p">
                                          <span class="errors" id="photo_err" style="color:red; font-size:13px"></span>
                                    </div>
                                    <div class="col-lg-4">
                                      <img id="contact_img_tag" width="120" height="90" alt="No Photo" src="<?php if(!empty($profile->photo)){ echo base_url($profile->photo);}else{ echo base_url('assets/uploads/600px-No_image_available.svg (2).png');} ?>" />
                                    </div>
                                </div>
                                <div class="row justify-content-end">
                                    <div class="col-lg-10">
                                        <button type="submit" class="btn btn-primary" id="updateProfile">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
