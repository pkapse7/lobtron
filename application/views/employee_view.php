
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
                        <table id="emp_table" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Employee Name</th>
                                <th>Email</th>
                                <th>Department</th>
                                <th>Designation</th>
                                <th>Type</th>
                                <th>Salary</th>
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
    <div class="modal-dialog">
        <form class="custom-validation add-employee" method="post" action="" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Add <?=substr($title, 0, -1);?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Employee Name *</label>
                    <input type="text" class="form-control customcardinput" name="employee_name" id="employee_name" required="" placeholder="Enter Employee Name">
                    <span class="errors" id="name_err" style="color:red; font-size:13px"></span>
                </div>
                <div class="form-group">
                    <label>Designation *</label>
                    <input type="text" class="form-control customcardinput" name="designation" id="designation" required="" placeholder="Enter Designation">
                    <span class="errors" id="designation_err" style="color:red; font-size:13px"></span>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Department *</label>
                            <select class="form-control customcardinput select2 select2-hidden-accessible" name="departmentID" id="dept_select" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                <option value="">--Select Department--</option>
                            </select>
                            <span class="errors" id="dept_err" style="color:red; font-size:13px"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Employee Type *</label>
                            <select class="form-control customcardinput select2 select2-hidden-accessible" name="employee_type" id="type_select" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                        <option value="">--Select--</option>
                                        <option value="0">Admin</option>
                                        <option value="1">Employee</option>
                                    </select>
                            <span class="errors" id="type_err" style="color:red; font-size:13px"></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Salary *</label>
                    <input type="number" class="form-control customcardinput" name="salary" id="salary" required="" placeholder="Enter Salary" min="1000">
                    <span class="errors" id="salary_err" style="color:red; font-size:13px"></span>
                </div>
                <div class="form-group">
                    <label>Email *</label>
                    <input type="text" class="form-control customcardinput" name="email" id="email" required="" placeholder="Enter Email" onkeyup="ValidateEmail();">
                    <span class="errors" id="email_err" style="color:red; font-size:13px"></span>
                </div>
                 <div class="form-group">
                    <label>Password *</label>
                    <input type="password" class="form-control customcardinput" name="password" name="password" id="passwords" required="" placeholder="Enter Password">
                    <span class="errors" id="pwd_err" style="color:red; font-size:13px"></span>
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
    <div class="modal-dialog">
        <form class="custom-validation update-employee" method="post" action="" autocomplete="off">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Update <?=substr($title, 0, -1);?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" name="employeeID" id="employeeID_e" class="form-control">
            <input type="hidden" name="original_email" id="original_email" class="form-control">
            
            <div class="modal-body">
                <div class="form-group">
                    <label>Employee Name *</label>
                    <input type="text" class="form-control customcardinputs" name="employee_name" id="employee_name_e" required="" placeholder="Enter Employee Name">
                    <span class="errors" id="name_e_err" style="color:red; font-size:13px"></span>
                </div>
                <div class="form-group">
                    <label>Designation *</label>
                    <input type="text" class="form-control customcardinputs" name="designation" id="designation_e" required="" placeholder="Enter Designation">
                    <span class="errors" id="designation_e_err" style="color:red; font-size:13px"></span>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Department *</label>
                            <select class="form-control customcardinputs select2 select2-hidden-accessible" name="departmentID" id="dept_select_e" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                <option value="">--Select Department--</option>
                            </select>
                            <span class="errors" id="dept_e_err" style="color:red; font-size:13px"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Employee Type *</label>
                            <select class="form-control customcardinputs select2 select2-hidden-accessible" name="employee_type" id="type_select_e" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                        <option value="">--Select--</option>
                                        <option value="0">Admin</option>
                                        <option value="1">Employee</option>
                                    </select>
                            <span class="errors" id="type_e_err" style="color:red; font-size:13px"></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Salary *</label>
                    <input type="number" class="form-control customcardinputs" name="salary" id="salary_e" required="" placeholder="Enter Salary" min="1000">
                    <span class="errors" id="salary_e_err" style="color:red; font-size:13px"></span>
                </div>
                <div class="form-group">
                    <label>Email *</label>
                    <input type="text" class="form-control customcardinputs" name="email" id="email_e" required="" placeholder="Enter Email" onkeyup="ValidateEmails();">
                    <span class="errors" id="email_e_err" style="color:red; font-size:13px"></span>
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
        <form class="custom-validation delete-Banner" method="post" action="" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Delete <?=substr($title, 0, -1);?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" name="deleteEmpId" id="deleteEmpId" class="form-control">
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
        