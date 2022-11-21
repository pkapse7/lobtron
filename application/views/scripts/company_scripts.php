<link href="<?=base_url('assets/')?>libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url('assets/')?>libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<!-- Required datatable js -->
<script src="<?=base_url('assets/')?>libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url('assets/')?>libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- Datatable init js -->
 <script src="<?=base_url('assets/')?>js/pages/datatables.init.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        comTable = $("#com_table").DataTable({
            'ajax': '<?= site_url("show-company")?>',
            'orders': []
        });

        $('#btnSave').click(function(){
            if($('#company_name').val() == ''){
                $("#name_err").html("Please enter Company Name").show();
                return false;
            }
            if($('#phone').val() == ''){
                $("#phone_err").html("Please enter Phone No").show();
                return false;
            }
            if($('#phone').val().length != 10){
                $("#phone_err").html("Please enter correct Phone No").show();
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
            if($('#website').val() == ''){
                $("#website_err").html("Please enter Website").show();
                return false;
            }
            var url_validate = /^(https?:\/\/(?:www\.|(?!www))[^\s\.]+\.[^\s]{2,}|www\.[^\s]+\.[^\s]{2,})/;
            if(!url_validate.test($('#website').val())){
               $("#website_err").html("Please enter valid url").show();
               return false;
            }

            if($('#passwords_e').val()== ''){
               $("#passwords_err").html("Please enter Password").show();
               return false;
            }

            if($('#con_passwords_e').val()== ''){
               $("#cpwd_err").html("Please enter Confirm Password").show();
               return false;
            }

            var banner_ex = $('#photo').val().split('.').pop().toLowerCase();
            if(banner_ex != '' && banner_ex != 'png' && banner_ex != 'jpg' && banner_ex != 'jpeg' && banner_ex != 'webp'){
                $("#photo_err").html("Only support image file type").show();
                return false;
            }

            if($('#type_select').val() == ''){
                $("#type_err").html("Please select Type").show();
                return false;
            }
            var formdata = $('.add-company')[0];
            $.ajax({
                type: 'ajax',
                method: 'post',
                url: '<?=site_url("add-company")?>',
                data: new FormData(formdata),
                processData:false,
                contentType:false,
                cache:false,
                async:false,
                success: function(data) {
                    if(data != '"success"'){
                        var incStr = data.includes("Company");
                        var incStr1 = data.includes("Phone");
                        var incStr2 = data.includes("Email");
                        var incStr3 = data.includes("Password");
                        if(incStr == true){
                            $("#name_err").html("This Company Name is already exists!").show();
                        }
                        if(incStr1 == true){
                          $("#phone_err").html("This Phone No is already exists!").show();
                        }
                        if(incStr2 == true){
                          $("#email_err").html("This Email is already exists!").show();
                        }

                        if(incStr3 == true){
                          $("#cpwd_err").html("Password mismatch..!").show();
                        }

                    }else{
                        $('.add-company')[0].reset();
                        $('#addModal').modal('hide');
                        comTable.ajax.reload(null, false);
                    }
                },

            });

            return false;
        });



    $('#com_table').on('click', '.deleteRecord', function() {
            var comId = $(this).data('id');
            $('#deleteModal').modal('show');
            $('#deleteComId').val(comId);
    });
    // delete company record
    $('#btnDelete').on('click', function() {
        var comId = $('#deleteComId').val();
        $.ajax({
            type: "POST",
            url: "<?=site_url("delete-company")?>",
            dataType: "JSON",
            data: {
                companyID: comId
            },
            success: function(data) {
                if(data == true){
                    $('#deleteModal').modal('hide');
                    comTable.ajax.reload(null, false);
                }

            }
        });
        return false;
    });

    $('#com_table').on('click', '.editRecord', function(event) {
            event.preventDefault();
        var comId = $(this).data('id');
//        alert(storyId);
        $.post('<?php echo base_url("AdminController/getCompanyById"); ?>', {comId: comId},
            function(response) {
                var data = response.trim();
                var array = JSON.parse(data);
                console.log(array);
                $('#companyID_e').val(comId);
                $('#company_name_e').val(array.company_name);
                $('#phone_e').val(array.phone);
                $('#email_e').val(array.email);
                $('#original_name').val(array.company_name);
                $('#original_phone').val(array.phone);
                $('#original_email').val(array.email);
                $('#website_e').val(array.website);
                $('#address_e').val(array.address);
                $('#type_select_e').val(array.status);
                var companyIMG = "<?php echo site_url('') ?>"+array.photo;
                $('#company-img-tag-upd').attr('src', companyIMG);
                $('#company-img-tag-upd').attr('width', '150px');
                $('#company-img-tag-upd').attr('height', '100px');
                $('#editModal').modal('show');
                $("#name_e_err,#phone_e_err,#email_e_err,#website_e_err").html('');
                comTable.ajax.reload(null, false);
        });
    });

    $('#btnUpdate').on('click', function() {
        if($('#company_name_e').val() == ''){
            $("#name_e_err").html("Please enter Company Name").show();
            return false;
        }
        if($('#phone_e').val() == ''){
            $("#phone_e_err").html("Please enter Phone No").show();
            return false;
        }
        if($('#phone_e').val().length != 10){
            $("#phone_e_err").html("Please enter correct Phone No").show();
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
        if($('#website_e').val() == ''){
            $("#website_e_err").html("Please enter Website").show();
            return false;
        }
        var url_validate = /^(https?:\/\/(?:www\.|(?!www))[^\s\.]+\.[^\s]{2,}|www\.[^\s]+\.[^\s]{2,})/;
        if(!url_validate.test($('#website_e').val())){
           $("#website_e_err").html("Please enter valid url").show();
           return false;
        }

        if($('#passwords_e').val() == '' && $('#con_passwords_e').val()!= ''){
           $("#cpwds_e_err").html("Please enter Password").show();
           return false;
        }
        if($('#passwords_e').val() != '' && $('#con_passwords_e').val()== ''){
           $("#cpwd_e_err").html("Please enter Confirm Password").show();
           return false;
        }
        var banner_ex = $('#photo_e').val().split('.').pop().toLowerCase();
        if(banner_ex != '' && banner_ex != 'png' && banner_ex != 'jpg' && banner_ex != 'jpeg' && banner_ex != 'webp'){
            $("#photo_e_err").html("Only support image file type").show();
            return false;
        }

        var formdata = $('.update-company')[0];
            $.ajax({
                url:'<?=site_url("edit-company")?>',
                type:"post",
                data:new FormData(formdata),
                processData:false,
                contentType:false,
                cache:false,
                async:false,
                success: function(data) {
                  if(data != '"success"'){
                      var incStr = data.includes("Company");
                      var incStr1 = data.includes("Phone");
                      var incStr2 = data.includes("Email");
                      var incStr3 = data.includes("Password");
                      if(incStr == true){
                          $("#name_e_err").html("This Company Name is already exists!").show();
                      }
                      if(incStr1 == true){
                        $("#phone_e_err").html("This Phone No is already exists!").show();
                      }
                      if(incStr2 == true){
                        $("#email_e_err").html("This Email is already exists!").show();
                      }
                      if(incStr3 == true){
                        $("#cpwd_e_err").html("Password mismatch..!").show();
                      }
                  }else{
                    $('.update-company')[0].reset();
                    $('#editModal').modal('hide');
//                    listCast();
                    comTable.ajax.reload(null, false);
                  }

                }
            });
        return false;
    });

    $('.customcard').bind('change', function() {
        if($('#company_name').val() == ''){
            $("#name_err").html("Please enter Company Name").show();
            return false;
        }else{
          $("#name_err").html("").show();
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
        if($('#website').val() == ''){
            $("#website_err").html("Please enter Website").show();
            return false;
        }else{
          $("#website_err").html("").show();
        }
        var url_validate = /^(https?:\/\/(?:www\.|(?!www))[^\s\.]+\.[^\s]{2,}|www\.[^\s]+\.[^\s]{2,})/;
        if(!url_validate.test($('#website').val())){
           $("#website_err").html("Please enter valid url").show();
           return false;
        }else{
          $("#website_err").html("").show();
        }

        if($('#passwords_e').val()== ''){
           $("#passwords_err").html("Please enter Password").show();
           return false;
        }else{
          $("#passwords_err").html("").show();
        }

        if($('#con_passwords_e').val()== ''){
           $("#cpwd_err").html("Please enter Confirm Password").show();
           return false;
        }else{
          $("#cpwd_err").html("").show();
        }
        var banner_ex = $('#photo').val().split('.').pop().toLowerCase();
        if(banner_ex != '' && banner_ex != 'png' && banner_ex != 'jpg' && banner_ex != 'jpeg' && banner_ex != 'webp'){
            $("#photo_err").html("Only support image file type").show();
            return false;
        }else{
          $("#photo_err").html("").show();
        }

        if($('#type_select').val() == ''){
            $("#type_err").html("Please select Type").show();
            return false;
        }else{
          $("#type_err").html("").show();
        }

    });

  $('.customcardinput').bind('change', function() {
    if($('#company_name_e').val() == ''){
        $("#name_e_err").html("Please enter Company Name").show();
        return false;
    }else{
      $("#name_e_err").html("").show();
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
    if($('#website_e').val() == ''){
        $("#website_e_err").html("Please enter Website").show();
        return false;
    }else{
      $("#website_e_err").html("").show();
    }
    var url_validate = /^(https?:\/\/(?:www\.|(?!www))[^\s\.]+\.[^\s]{2,}|www\.[^\s]+\.[^\s]{2,})/;
    if(!url_validate.test($('#website_e').val())){
       $("#website_e_err").html("Please enter valid url").show();
       return false;
    }else{
      $("#website_e_err").html("").show();
    }

    if($('#passwords_e').val() == '' && $('#con_passwords_e').val()!= ''){
       $("#cpwds_e_err").html("Please enter Password").show();
       return false;
    }else{
      $("#cpwds_e_err").html("").show();
    }

    if($('#passwords_e').val() != '' && $('#con_passwords_e').val()== ''){
       $("#cpwd_e_err").html("Please enter Confirm Password").show();
       return false;
    }else{
      $("#cpwd_e_err").html("").show();
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
              $('#company_img_tag').attr('src', e.target.result);
              $('#company_img_tag').attr('width', '150px');
              $('#company_img_tag').attr('height', '100px');
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
              $('#company-img-tag-upd').attr('src', e.target.result);
              $('#company-img-tag-upd').attr('width', '150px');
              $('#company-img-tag-upd').attr('height', '100px');
          }
          reader.readAsDataURL(input.files[0]);
      }
  }
  $("#photo_e").change(function(){
      readURLUpdate(this);
  });

  contTable = $("#cont_table").DataTable({
      'ajax': '<?= site_url("AdminController/showContactList")?>',
      'orders': []
  })


  function IsEmail(email) {
      var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      if(!regex.test(email)) {
         return false;
      }else{
         return true;
      }
  }

  $('#company_name_e').on('keypress', function() {
      var regex = new RegExp("^[a-zA-Z ]+$");
      var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
      if (!regex.test(key)) {
          $("#name_e_err").html("Only alphabets allowed").show();
          return false;
      }else{
          $("#name_e_err").html("").show();
      }
  });

</script>
    </body>
</html>
