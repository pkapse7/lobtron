<link href="<?=base_url('assets/')?>libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url('assets/')?>libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<!-- Required datatable js -->
<script src="<?=base_url('assets/')?>libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url('assets/')?>libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- Datatable init js -->
 <script src="<?=base_url('assets/')?>js/pages/datatables.init.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    conTable = $("#con_table").DataTable({
        'ajax': '<?= site_url("show-contact")?>',
        'orders': []
    });

    $('#btnSave').click(function(){
        if($('#first_name').val() == ''){
            $("#fname_err").html("Please enter First Name").show();
            return false;
        }
        if($('#last_name').val() == ''){
            $("#lname_err").html("Please enter Last Name").show();
            return false;
        }
        if($('#email').val() == ''){
            $("#email_err").html("Please enter Email").show();
            return false;
        }
        if($('#email').val() != ''){
            if(IsEmail($('#email').val()) == false){
              $("#email_err").html("Please enter valid email").show();
              return false;
            }
        }
        if($('#phone').val() == ''){
            $("#phone_err").html("Please enter Phone No").show();
            return false;
        }

        if($('#phone').val().length != 10){
            $("#phone_err").html("Please enter correct Phone No").show();
            return false;
        }
        var banner_ex = $('#photo').val().split('.').pop().toLowerCase();
        if(banner_ex != '' && banner_ex != 'png' && banner_ex != 'jpg' && banner_ex != 'jpeg' && banner_ex != 'webp'){
            $("#photo_err").html("Only support image file type").show();
            return false;
        }
        var formdata = $('.add-contact')[0];
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: '<?=site_url("add-contact")?>',
            data: new FormData(formdata),
            processData:false,
            contentType:false,
            cache:false,
            async:false,
            success: function(data) {
                if(data != '"success"'){
                    var incStr1 = data.includes("Phone");
                    var incStr2 = data.includes("Email");
                    if(incStr1 == true){
                      $("#phone_err").html("This Phone No is already exists!").show();
                    }
                    if(incStr2 == true){
                      $("#email_err").html("This Email is already exists!").show();
                    }

                }else{
                    $('.add-contact')[0].reset();
                    $('#addModal').modal('hide');
                    conTable.ajax.reload(null, false);
                }
            },

        });
        return false;
    });

    $('#con_table').on('click', '.deleteRecord', function() {
            var conId = $(this).data('id');
            $('#deleteModal').modal('show');
            $('#deleteConId').val(conId);
    });
    // delete company record
    $('#btnDelete').on('click', function() {
        var conId = $('#deleteConId').val();
        $.ajax({
            type: "POST",
            url: "<?=site_url("delete-contact")?>",
            dataType: "JSON",
            data: {
                contactID: conId
            },
            success: function(data) {
                if(data == true){
                    $('#deleteModal').modal('hide');
                    conTable.ajax.reload(null, false);
                }

            }
        });
        return false;
    });

    $('#con_table').on('click', '.editRecord', function(event) {
            event.preventDefault();
        var conId = $(this).data('id');
//        alert(storyId);
        $.post('<?php echo base_url("CompanyController/getContactById"); ?>', {conId: conId},
            function(response) {
                var data = response.trim();
                var array = JSON.parse(data);
                console.log(array);
                $('#contactID_e').val(conId);
                $('#first_name_e').val(array.first_name);
                $('#last_name_e').val(array.last_name);
                $('#phone_e').val(array.phone);
                $('#original_phone').val(array.phone);
                $('#address_e').val(array.address);
                $('#email_e').val(array.email);
                $('#original_email').val(array.email);
                $('#type_select_e').val(array.status);
                var companyIMG = "<?php echo site_url('') ?>"+array.photo;
                $('#contact-img-tag-upd').attr('src', companyIMG);
                $('#contact-img-tag-upd').attr('width', '150px');
                $('#contact-img-tag-upd').attr('height', '100px');

                $('#editModal').modal('show');
                $("#phone_e_err,#email_e_err,#fname_e_err,#lname_e_err,#photo_e_err").html('');
                conTable.ajax.reload(null, false);
        });
    });

    $('#btnUpdate').on('click', function() {
        if($('#first_name_e').val() == ''){
            $("#fname_e_err").html("Please enter First Name").show();
            return false;
        }
        if($('#last_name_e').val() == ''){
            $("#lname_e_err").html("Please enter Last Name").show();
            return false;
        }
        if($('#email_e').val() == ''){
            $("#email_e_err").html("Please enter Email").show();
            return false;
        }
        if($('#email_e').val() != ''){
            if(IsEmail($('#email_e').val()) == false){
              $("#email_e_err").html("Please enter valid email").show();
              return false;
            }
        }
        if($('#phone_e').val() == ''){
            $("#phone_e_err").html("Please enter Phone No").show();
            return false;
        }

        if($('#phone_e').val().length != 10){
            $("#phone_e_err").html("Please enter correct Phone No").show();
            return false;
        }
        var banner_ex = $('#photo_e').val().split('.').pop().toLowerCase();
        if(banner_ex != '' && banner_ex != 'png' && banner_ex != 'jpg' && banner_ex != 'jpeg' && banner_ex != 'webp'){
            $("#photo_e_err").html("Only support image file type").show();
            return false;
        }

        var formdata = $('.update-contact')[0];
            $.ajax({
                url:'<?=site_url("edit-contact")?>',
                type:"post",
                data:new FormData(formdata),
                processData:false,
                contentType:false,
                cache:false,
                async:false,
                success: function(data) {
                    if(data != '"success"'){
                        var incStr1 = data.includes("Phone");
                        var incStr2 = data.includes("Email");

                        if(incStr1 == true){
                          $("#phone_e_err").html("This Phone No is already exists!").show();
                        }
                        if(incStr2 == true){
                          $("#email_e_err").html("This Email is already exists!").show();
                        }
                    }else{
                        $("#phone_e_err,#email_e_err").html('');
                        $('.update-contact')[0].reset();
                        $('#editModal').modal('hide');
                        conTable.ajax.reload(null, false);
                    }
                }
            });
        return false;
    });

    $('.customcardinput').bind('change', function() {
        if($('#first_name').val() == ''){
            $("#fname_err").html("Please enter First Name").show();
            return false;
        }else{
            $("#fname_err").html("").show();
        }
        if($('#last_name').val() == ''){
            $("#lname_err").html("Please enter Last Name").show();
            return false;
        }else{
            $("#lname_err").html("").show();
        }
        if($('#email').val() == ''){
            $("#email_err").html("Please enter Email").show();
            return false;
        }else{
            $("#email_err").html("").show();
        }
        if($('#email').val() != ''){
            if(IsEmail($('#email').val()) == false){
              $("#email_err").html("Please enter valid email").show();
              return false;
            }else{
                $("#email_err").html("").show();
            }
        }
        if($('#phone').val() == ''){
            $("#phone_err").html("Please enter Phone No").show();
            return false;
        }else{
            $("#phone_err").html("").show();
        }
        if($('#phone').val().length != 10){
            $("#phone_err").html("Please enter correct Phone No").show();
            return false;
        }else{
            $("#phone_err").html("").show();
        }
        var banner_ex = $('#photo').val().split('.').pop().toLowerCase();
        if(banner_ex != '' && banner_ex != 'png' && banner_ex != 'jpg' && banner_ex != 'jpeg' && banner_ex != 'webp'){
            $("#photo_err").html("Only support image file type").show();
            return false;
        }else{
            $("#photo_err").html("").show();
        }
    });

        $('.customcardinputs').bind('change', function() {
            if($('#first_name_e').val() == ''){
                $("#fname_e_err").html("Please enter First Name").show();
                return false;
            }else{
                $("#fname_e_err").html("").show();
            }
            if($('#last_name_e').val() == ''){
                $("#lname_e_err").html("Please enter Last Name").show();
                return false;
            }else{
                $("#lname_e_err").html("").show();
            }
            if($('#email_e').val() == ''){
                $("#email_e_err").html("Please enter Email").show();
                return false;
            }else{
                $("#email_e_err").html("").show();
            }
            if($('#email_e').val() != ''){
                if(IsEmail($('#email_e').val()) == false){
                  $("#email_e_err").html("Please enter valid email").show();
                  return false;
                }else{
                    $("#email_e_err").html("").show();
                }
            }
            if($('#phone_e').val() == ''){
                $("#phone_e_err").html("Please enter Phone No").show();
                return false;
            }else{
                $("#phone_e_err").html("").show();
            }

            if($('#phone_e').val().length != 10){
                $("#phone_e_err").html("Please enter correct Phone No").show();
                return false;
            }else{
                $("#phone_e_err").html("").show();
            }
            var banner_ex = $('#photo_e').val().split('.').pop().toLowerCase();
            if(banner_ex != '' && banner_ex != 'png' && banner_ex != 'jpg' && banner_ex != 'jpeg' && banner_ex != 'webp'){
                $("#photo_e_err").html("Only support image file type").show();
                return false;
            }else{
                $("#photo_e_err").html("").show();
            }
        });
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#contact_img_tag').attr('src', e.target.result);
                $('#contact_img_tag').attr('width', '150px');
                $('#contact_img_tag').attr('height', '100px');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#photo").change(function(){
        readURL(this);
    });

    function readURLUpdate(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#contact-img-tag-upd').attr('src', e.target.result);
                $('#contact-img-tag-upd').attr('width', '150px');
                $('#contact-img-tag-upd').attr('height', '100px');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#photo_e").change(function(){
        readURLUpdate(this);
    });

    $('#updateProfile').on('click', function() {
        if($('#company_name_p').val() == ''){
            $("#name_err").html("Please enter Company Name").show();
            return false;
        }
        if($('#phone_p').val() == ''){
            $("#phone_err").html("Please enter Phone No").show();
            return false;
        }
        if($('#phone_p').val().length != 10){
            $("#phone_err").html("Please enter correct Phone No").show();
            return false;
        }
        if($('#email_p').val() == ''){
            $("#email_err").html("Please enter Email").show();
            return false;
        }

        if($('#email_p').val() != ''){
            if(IsEmail($('#email_p').val()) == false){
              $("#email_err").html("Please enter valid email").show();
              return false;
            }
        }
        if($('#website_p').val() == ''){
            $("#website_err").html("Please enter Website").show();
            return false;
        }
        var url_validate = /^(https?:\/\/(?:www\.|(?!www))[^\s\.]+\.[^\s]{2,}|www\.[^\s]+\.[^\s]{2,})/;
        if(!url_validate.test($('#website_p').val())){
           $("#website_err").html("Please enter valid url").show();
           return false;
        }
        var banner_ex = $('#photo_p').val().split('.').pop().toLowerCase();
        if(banner_ex != '' && banner_ex != 'png' && banner_ex != 'jpg' && banner_ex != 'jpeg' && banner_ex != 'webp'){
            $("#photo_err").html("Only support image file type").show();
            return false;
        }

        var formdata = $('.update-profile')[0];
            $.ajax({
                url:'<?=site_url("edit-company-profile")?>',
                type:"post",
                data:new FormData(formdata),
                processData:false,
                contentType:false,
                cache:false,
                async:false,
                success: function(data) {
                  // console.log(data.replace('"',''));
                  if(data != '"success"'){
                      var incStr = data.includes("Company");
                      var incStr1 = data.includes("Phone");
                      var incStr2 = data.includes("Email");
                      if(incStr == true){
                          $("#name_err").html("This Company Name is already exists!").show();
                      }
                      if(incStr1 == true){
                        $("#phone_err").html("This Phone No is already exists!").show();
                      }
                      if(incStr2 == true){
                        $("#email_err").html("This Email is already exists!").show();
                      }
                  }else{
                    location.reload();
                  }
                }
            });
        return false;
    });

    $('.projectname').bind('change', function() {
        if($('#company_name_p').val() == ''){
            $("#name_err").html("Please enter Company Name").show();
            return false;
        }else{
            $("#name_err").html("").show();
        }
        if($('#phone_p').val() == ''){
            $("#phone_err").html("Please enter Phone No").show();
            return false;
        }else{
            $("#phone_err").html("").show();
        }
        if($('#phone_p').val().length != 10){
            $("#phone_err").html("Please enter correct Phone No").show();
            return false;
        }else{
            $("#phone_err").html("").show();
        }
        if($('#email_p').val() == ''){
            $("#email_err").html("Please enter Email").show();
            return false;
        }else{
            $("#email_err").html("").show();
        }

        if($('#email_p').val() != ''){
            if(IsEmail($('#email_p').val()) == false){
              $("#email_err").html("Please enter valid email").show();
              return false;
            }else{
                $("#email_err").html("").show();
            }
        }

        if($('#website_p').val() == ''){
            $("#website_err").html("Please enter Website").show();
            return false;
        }else{
            $("#website_err").html("").show();
        }

        var url_validate = /^(https?:\/\/(?:www\.|(?!www))[^\s\.]+\.[^\s]{2,}|www\.[^\s]+\.[^\s]{2,})/;
        if(!url_validate.test($('#website_p').val())){
           $("#website_err").html("Please enter valid url").show();
           return false;
        }else{
            $("#website_err").html("").show();
        }
        var banner_ex = $('#photo_p').val().split('.').pop().toLowerCase();
        if(banner_ex != '' && banner_ex != 'png' && banner_ex != 'jpg' && banner_ex != 'jpeg' && banner_ex != 'webp'){
            $("#photo_err").html("Only support image file type").show();
            return false;
        }else{
            $("#photo_err").html("").show();
        }
    });

    $('#company_name_p').on('keypress', function() {
        var regex = new RegExp("^[a-zA-Z ]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            $("#name_err").html("Only alphabets allowed").show();
            return false;
        }else{
            $("#name_err").html("").show();
        }
    });

    $('#first_name').on('keypress', function() {
        var regex = new RegExp("^[a-zA-Z ]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            $("#fname_err").html("Only alphabets allowed").show();
            return false;
        }else{
            $("#fname_err").html("").show();
        }
    });

    $('#first_name_e').on('keypress', function() {
        var regex = new RegExp("^[a-zA-Z ]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            $("#fname_e_err").html("Only alphabets allowed").show();
            return false;
        }else{
            $("#fname_e_err").html("").show();
        }
    });

    $('#last_name_e').on('keypress', function() {
        var regex = new RegExp("^[a-zA-Z ]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            $("#lname_e_err").html("Only alphabets allowed").show();
            return false;
        }else{
            $("#lname_e_err").html("").show();
        }
    });

    $('#last_name').on('keypress', function() {
        var regex = new RegExp("^[a-zA-Z ]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            $("#lname_err").html("Only alphabets allowed").show();
            return false;
        }else{
            $("#lname_err").html("").show();
        }
    });

    function IsEmail(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test(email)) {
           return false;
        }else{
           return true;
        }
    }



</script>
    </body>
</html>
