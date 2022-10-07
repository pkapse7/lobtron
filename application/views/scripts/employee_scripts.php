<link href="<?=base_url('assets/')?>libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url('assets/')?>libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" /> 
<!-- Required datatable js -->
<script src="<?=base_url('assets/')?>libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url('assets/')?>libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- Datatable init js -->
 <script src="<?=base_url('assets/')?>js/pages/datatables.init.js"></script>     

<script type="text/javascript">
    $(document).ready(function() {
        empTable = $("#emp_table").DataTable({
            'ajax': '<?= site_url("show-employee")?>',
            'orders': []
        }); 

        $('#btnSave').click(function(){

            if($('#employee_name').val() == ''){
                $("#name_err").html("Please enter Employee Name").show();
                return false;
            }
            if($('#designation').val() == ''){
                $("#designation_err").html("Please enter Designation").show();
                return false;
            }
            if($('#dept_select').val() == ''){
                $("#dept_err").html("Please select Department").show();
                return false;
            }
            if($('#type_select').val() == ''){
                $("#type_err").html("Please select Type").show();
                return false;
            }

            if($('#salary').val() == ''){
                $("#salary_err").html("Please enter Salary").show();
                return false;
            }

            if($('#email').val() == ''){
                $("#email_err").html("Please enter Email").show();
                return false;
            }

            if($('#email').val() != ''){
                if(ValidateEmail($('#email').val()) == false){
                  $("#email_err").html("Please enter valid email").show();
                  return false;
                }
            }

            if($('#passwords').val() == ''){
                $("#pwd_err").html("Please enter Password").show();
                return false;
            }
            
            $.ajax({
                type: 'ajax',
                method: 'post',
                url: '<?=site_url("add-employee")?>',
                data: $('.add-employee').serialize(),
                async: false,
                dataType: 'json',
                success: function(data) {
                    if(data == "fail"){
                        $("#email_err").html("This email is already exists").show();
                    }else if(data == 'success'){
                        $('.add-employee')[0].reset();
                        $('#addModal').modal('hide');
                        empTable.ajax.reload(null, false);  
                    }          
                },

            });

            return false;
        });
        
    
    
    $('#emp_table').on('click', '.deleteRecord', function() {
            var empId = $(this).data('id');
            $('#deleteModal').modal('show');
            $('#deleteEmpId').val(empId);
    });
    // delete emp record
    $('#btnDelete').on('click', function() {
        var empId = $('#deleteEmpId').val();
        $.ajax({
            type: "POST",
            url: "<?=site_url("delete-employee")?>",
            dataType: "JSON",
            data: {
                employeeID: empId
            },
            success: function(data) {
                if(data == true){
                    $('#deleteModal').modal('hide');
                    empTable.ajax.reload(null, false);
                }
               
            }
        });
        return false;
    });
    
    $('#emp_table').on('click', '.editRecord', function(event) {
            event.preventDefault();  
        var empId = $(this).data('id');
//        alert(storyId);
        $.post('<?php echo base_url("EmployeeController/getEmployeeById"); ?>', {empId: empId}, 
            function(response) {
                var data = response.trim();
                var array = JSON.parse(data);
                console.log(array);
                $('#employeeID_e').val(empId);
                $('#employee_name_e').val(array.employee_name);
                $('#designation_e').val(array.designation);
                $('#dept_select_e').val(array.departmentID);
                $('#type_select_e').val(array.employee_type);
                $('#salary_e').val(array.salary);
                $('#email_e').val(array.email);
                $('#original_email').val(array.email);
               
                $('#editModal').modal('show');
                empTable.ajax.reload(null, false);
        });     
    });

    $('#btnUpdate').on('click', function() {
        if($('#employee_name_e').val() == ''){
            $("#name_e_err").html("Please enter Employee Name").show();
            return false;
        }
        if($('#designation_e').val() == ''){
            $("#designation_e_err").html("Please enter Designation").show();
            return false;
        }
        if($('#dept_select_e').val() == ''){
            $("#dept_e_err").html("Please select Department").show();
            return false;
        }
        if($('#type_select_e').val() == ''){
            $("#type_e_err").html("Please select Type").show();
            return false;
        }

        if($('#salary_e').val() == ''){
            $("#salary_e_err").html("Please enter Salary").show();
            return false;
        }

        if($('#email_e').val() == ''){
            $("#email_e_err").html("Please enter Email").show();
            return false;
        }

        if($('#email_e').val() != ''){
            if(ValidateEmails($('#email_e').val()) == false){
              $("#email_e_err").html("Please enter valid email").show();
              return false;
            }
        }
        
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: '<?=site_url("edit-employee")?>',
            data: $('.update-employee').serialize(),
            async: false,
            dataType: 'json',
            success: function(data) {
                if(data == "fail"){
                    $("#email_e_err").html("This email is already exists").show();
                }else if(data == 'success'){
                    $('.update-employee')[0].reset();
                    $('#editModal').modal('hide');
                    empTable.ajax.reload(null, false);  
                }          
            },

        });
        return false;
    });

        $.ajax({
            url: '<?=site_url("select-department")?>',
            type: 'GET'
        }).done(function(cat) {
        var objcat = $.parseJSON(cat);
        $.each(objcat, function(i, objcat) {
            $('#dept_select').append($('<option>', {
                value: objcat.departmentID,
                text: objcat.department_name
            }));
        });
        $.each(objcat, function(i, objcat) {
            $('#dept_select_e').append($('<option>', {
                value: objcat.departmentID,
                text: objcat.department_name
            }));
        });
        
        }).fail(function() {
        //log("error");
        }).always(function() {
        //log("complete");
        });  


        $('.customcardinput').bind('change', function() {
            var email_id = $('#email').val();

            if($('#employee_name').val() == ''){
                $("#name_err").html("Please enter Employee Name").show();
                return false;
            }else{
                $("#name_err").html("").show();
            }
            if($('#designation').val() == ''){
                $("#designation_err").html("Please enter Designation").show();
                return false;
            }else{
                $("#designation_err").html("").show();
            }
            if($('#dept_select').val() == ''){
                $("#dept_err").html("Please select Department").show();
                return false;
            }else{
                $("#dept_err").html("").show();
            }
            if($('#type_select').val() == ''){
                $("#type_err").html("Please select Type").show();
                return false;
            }else{
                $("#type_err").html("").show();
            }

            if($('#salary').val() == ''){
                $("#salary_err").html("Please enter Salary").show();
                return false;
            }else{
                $("#salary_err").html("").show();
            }

            if($('#email').val() == ''){
                $("#email_err").html("Please enter Email").show();
                return false;
            }else{
                $("#email_err").html("").show();
            }

            if(email_id != ''){
                if(ValidateEmail(email_id) == false){
                  $("#email_err").html("Please enter valid email").show();
                  return false;
                }else{
                  $("#email_err").html("").show();
                }
            }

            if($('#passwords').val() == ''){
                $("#pwd_err").html("Please enter Password").show();
                return false;
            }else{
                $("#pwd_err").html("").show();
            }
            
        });

        $('.customcardinputs').bind('change', function() {
            var email_id = $('#email_e').val();

            if($('#employee_name_e').val() == ''){
                $("#name_err").html("Please enter Employee Name").show();
                return false;
            }else{
                $("#name_e_err").html("").show();
            }
            if($('#designation_e').val() == ''){
                $("#designation_e_err").html("Please enter Designation").show();
                return false;
            }else{
                $("#designation_e_err").html("").show();
            }
            if($('#dept_select_e').val() == ''){
                $("#dept_e_err").html("Please select Department").show();
                return false;
            }else{
                $("#dept_e_err").html("").show();
            }
            if($('#type_select_e').val() == ''){
                $("#type_e_err").html("Please select Type").show();
                return false;
            }else{
                $("#type_e_err").html("").show();
            }

            if($('#salary_e').val() == ''){
                $("#salary_e_err").html("Please enter Salary").show();
                return false;
            }else{
                $("#salary_e_e_err").html("").show();
            }

            if($('#email_e').val() == ''){
                $("#email_e_err").html("Please enter Email").show();
                return false;
            }else{
                $("#email_e_err").html("").show();
            }

            if(email_id != ''){
                if(ValidateEmails(email_id) == false){
                  $("#email_e_err").html("Please enter valid email").show();
                  return false;
                }else{
                  $("#email_e_err").html("").show();
                }
            }
            
        });

        function ValidateEmail() {
            var email_id = $("#email").val();
            var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
            if (!expr.test(email_id)) {
                $('#email_err').html('Please enter valid email').show();
                return false;
            }else{
                $('#email_err').html("").show();
            }
        }

        function ValidateEmails() {
            var email_id = $("#email_e").val();
            var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
            if (!expr.test(email_id)) {
                $('#email_e_err').html('Please enter valid email').show();
                return false;
            }else{
                $('#email_e_err').html("").show();
            }
        }

        
    });    
</script>       
    </body>
</html>