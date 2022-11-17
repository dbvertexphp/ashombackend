<?php include('header.php');?>
  <?php include('sidebar.php');?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<style>
    .select2-container {
        min-width: 400px;
    }

    .select2-results__option {
        padding-right: 20px;
        vertical-align: middle;
    }
.select2-container--default .select2-selection--multiple .select2-selection__choice__display {

    color: black;
}
    .select2-results__option:before {
        content: "";
        display: inline-block;
        position: relative;
        height: 20px;
        width: 20px;
        border: 2px solid #e9e9e9;
        border-radius: 4px;
        background-color: #fff;
        margin-right: 20px;
        vertical-align: middle;
    }

    .select2-results__option[aria-selected=true]:before {
        font-family: fontAwesome;
        content: "\f00c";
        color: #fff;
        background-color: #f77750;
        border: 0;
        display: inline-block;
        padding-left: 3px;
    }

    .select2-container--default .select2-results__option[aria-selected=true] {
        background-color: #fff;
    }

    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #eaeaeb;
        color: #272727;
    }

    .select2-container--default .select2-selection--multiple {
        margin-bottom: 10px;
    }

    .select2-container--default.select2-container--open.select2-container--below .select2-selection--multiple {
        border-radius: 4px;
    }

    .select2-container--default.select2-container--focus .select2-selection--multiple {
        border-color: #f77750;
        border-width: 2px;
    }

    .select2-container--default .select2-selection--multiple {
        border-width: 2px;
    }

    .select2-container--open .select2-dropdown--below {

        border-radius: 6px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);

    }

    .select2-selection .select2-selection--multiple:after {
        content: 'hhghgh';
    }

    .select2-selection__clear {
        display: none;
    }
</style>

<div class="content-wrapper">


    <section class="content-header">
      <h1>
        Edit User
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>

        <li class="active">Edit User</li>
      </ol>
    </section>

<div class="container" style="margin-top:20px;">

<section class="content" style="padding-left: 270px;">

 <?php echo form_open("admin/updateuser/".$user['id']); ?>
 <div class="row align-items-center justify-content-center">
 <div class="col-lg-6 col-xs-6">
 <input type="hidden" name="user_id" value="<?=$user['id']?>">
  <div class="form-group">
    <label for="Title">First Name:</label>
   <?php echo form_input(['class'=>'form-control','placeholder'=>'Enter Firstname Name','name'=>'first_name','value'=>set_value('first_name',$user['first_name'])]);  ?>
   <span style="color:red"><?php  echo form_error('name');  ?></span>
  </div>
  </div>
  </div>
  <div class="row">
 <div class="col-lg-6 col-xs-6">
  <div class="form-group">
    <label for="Title">Last Name:</label>
   <?php echo form_input(['class'=>'form-control','placeholder'=>'Enter Lastname Name','name'=>'last_name','value'=>set_value('last_name',$user['last_name'])]);  ?>
   <span style="color:red"><?php  echo form_error('name');  ?></span>
  </div>
  </div>
  </div>

 <div class="row">
 <div class="col-lg-6 col-xs-6">
  <div class="form-group">
    <label for="body">Email :</label>

   <?php  echo form_input(['class'=>'form-control','placeholder'=>'Enter Email','name'=>'email','value'=>set_value('email',$user['email'])]); ?>
   <span style="color:red"><?php  echo form_error('email');  ?></span>
   </div>
   </div>
   </div>




<div class="row">
 <div class="col-lg-6 col-xs-6">
  <div class="form-group">
    <label for="body">Password:</label>

   <?php  echo form_input(['class'=>'form-control','placeholder'=>'Enter Password','name'=>'password','value'=>set_value('password',$user['password'])]); ?>
   <span style="color:red"><?php  echo form_error('password');  ?></span>
   </div>
   </div>
</div>


 <div class="form-group">
                                    <label>Auth Countries</label>
                                <br>    <select style="    width: 240px;" class="form-control js-select1" id="mySelectBox1" name="countries_id[]" multiple>
                    <?php
                    $mycountry = explode(",",$user['auth_countries']);
                    $countries = $this->db->get("countries")->result();
                foreach($countries as $value){
                ?>
                 <option <?=(in_array($value->id, $mycountry)?"selected":"")?> value="<?=$value->id?>"><?=$value->country?></option>
                <?php } ?>

                                    </select>
                                    <span id="user_err1" style="color: red"></span>

                                </div>

  <?php  echo form_submit(['type'=>'submit','class'=>'btn btn-primary','value'=>'Update']);  ?>

</section>

</div>

</div>
  <script>

  $('.send-noti1').click(function(){
     //alert($('#mySelectBox option:selected').text());

   var  user = $('#mySelectBox1 option:selected').text();


  var message = $('#message1').val();

     if(user == "" && message=="" ){

        $("#user_err1").text("Please Select User.");
        $("#msg_err1").text("Please Enter Message.");

     }else if(user == ""){

        $("#user_err1").text("Please Select User.");
        $("#msg_err1").text("");

     }else if(message == ""){

        $("#user_err1").text("");
        $("#msg_err1").text("Please Enter Message.");

     }else{
$("#msg_err1").text("");
 $("#user_err1").text("");
        $("#pushNotification1").submit();




     }

    // alert($user);
   // $("#report_frm").submit();

});
  $('.send-noti2').click(function(){
     //alert($('#mySelectBox option:selected').text());

   var  user = $('#mySelectBox2 option:selected').text();



  var message = $('textarea#message2').val();

     if(user == "" && message=="" ){

        $("#user_err2").text("Please Select User.");
        $("#msg_err2").text("Please Enter Message.");

     }else if(user == ""){

        $("#user_err2").text("Please Select User.");
        $("#msg_err2").text("");

     }else if(message == ""){

        $("#user_err2").text("");
        $("#msg_err2").text("Please Enter Message.");

     }else{


        $("#pushNotification2").submit();




     }

    // alert($user);
   // $("#report_frm").submit();

});
  $('.send-noti3').click(function(){
     //alert($('#mySelectBox option:selected').text());


   var  user = $('#mySelectBox3 option:selected').text();

  var message = $('textarea#message3').val();

     if(user == "" && message=="" ){

        $("#user_err3").text("Please Select User.");
        $("#msg_err3").text("Please Enter Message.");

     }else if(user == ""){

        $("#user_err3").text("Please Select User.");
        $("#msg_err3").text("");

     }else if(message == ""){

        $("#user_err3").text("");
        $("#msg_err3").text("Please Enter Message.");

     }else{


        $("#pushNotification3").submit();




     }

    // alert($user);
   // $("#report_frm").submit();

});
  $('.send-noti4').click(function(){
     //alert($('#mySelectBox option:selected').text());

  var  user = $('#mySelectBox4 option:selected').text();


  var message = $('textarea#message4').val();

     if(user == "" && message=="" ){

        $("#user_err4").text("Please Select User.");
        $("#msg_err4").text("Please Enter Message.");

     }else if(user == ""){

        $("#user_err4").text("Please Select User.");
        $("#msg_err4").text("");

     }else if(message == ""){

        $("#user_err4").text("");
        $("#msg_err4").text("Please Enter Message.");

     }else{


        $("#pushNotification4").submit();




     }

    // alert($user);
   // $("#report_frm").submit();

});
      $("#single").select2({
          placeholder: "Select a programming language",
          allowClear: true
      });
      $("#multiple").select2({
          placeholder: "Select a programming language",
          allowClear: true
      });

          $(".js-select1").select2({
        closeOnSelect: false,
        placeholder: "Placeholder",
        allowHtml: true,
        allowClear: true,
        tags: true // создает новые опции на лету
    });


          $("#checkbox1").click(function () {
        if ($("#checkbox1").is(':checked')) {
            $(".js-select1 > option").prop("selected", "selected");
            $(".js-select1").trigger("change");
        } else {
            $(".js-select1 > option").prop("selected", false);
            $(".js-select1").trigger("change");
        }
    });
       $(".js-select2").select2({
        closeOnSelect: false,
        placeholder: "Placeholder",
        allowHtml: true,
        allowClear: true,
        tags: true // создает новые опции на лету
    });


          $("#checkbox2").click(function () {
        if ($("#checkbox2").is(':checked')) {
            $(".js-select2 > option").prop("selected", "selected");
            $(".js-select2").trigger("change");
        } else {
            $(".js-select2 > option").prop("selected", false);
            $(".js-select2").trigger("change");
        }
    });
       $(".js-select3").select2({
        closeOnSelect: false,
        placeholder: "Placeholder",
        allowHtml: true,
        allowClear: true,
        tags: true // создает новые опции на лету
    });


          $("#checkbox3").click(function () {
        if ($("#checkbox3").is(':checked')) {
            $(".js-select3 > option").prop("selected", "selected");
            $(".js-select3").trigger("change");
        } else {
            $(".js-select3 > option").prop("selected", false);
            $(".js-select3").trigger("change");
        }
    });
       $(".js-select4").select2({
        closeOnSelect: false,
        placeholder: "Placeholder",
        allowHtml: true,
        allowClear: true,
        tags: true // создает новые опции на лету
    });


          $("#checkbox4").click(function () {
        if ($("#checkbox4").is(':checked')) {
            $(".js-select4 > option").prop("selected", "selected");
            $(".js-select4").trigger("change");
        } else {
            $(".js-select4 > option").prop("selected", false);
            $(".js-select4").trigger("change");
        }
    });
    </script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url();?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url();?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url();?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url();?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url();?>assets/dist/js/demo.js"></script>
  <?php include('footer.php'); ?>
