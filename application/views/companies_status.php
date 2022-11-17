<?php include('header.php');?>
  <?php include('sidebar.php');?>

<script src="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.js"></script>
<link rel="stylesheet" href="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.css" />

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">

<style type="text/css">

.dt-buttons{
    float: right!important;
}

    .buttons-excel{

      float: right!important;
    margin-left: 10px!important;
    margin-right: 10px!important;
    border-radius: 39px!important;
    background-color: #00c0ef!important;
    color: #fff!important;

    }
input{
    border:none;
}
</style>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
 <section class="content-header">
      <h1>
        Delisted OR Suspended Companies
      </h1>

</section>



<section class="content">
<div class="row">


<?php  if($msg=$this->session->flashdata('msg')):

$msg_class=$this->session->flashdata('msg_class')

 ?>
<div class="row">
<div class="col-lg-6">
<div class="alert <?= $msg_class ?>">
<?= $msg; ?>
</div>
</div>
</div>

<?php endif; ?>
</div>

<div class="box">
<div class="box-body">


    <div class="tab-content col-md-6">
        <table id="example3">
                <thead>
                <tr>
                  <th>S No.</th>
                  <th>Status Type</th>
                  <th>actions</th>
                </tr>
                </thead>
        <tbody>
          <tr>
                <form action="" method="POST">
                <td></td>
                <td><input type="text" value="" placeholder="Enter Companies Status" name="company_status"></td>
                <td><input type="submit" class="btn btn-primary" name="updatecompanystatus" value="Add" required></td>
                </form>
                </tr>
          <?php

          $i=0;
          $companystatus = $this->db->get("companystatus")->result();
          foreach ($companystatus as $value) {
            $i++;
            ?>
                <tr id="row<?php echo $value->id; ?>">
                <form action="" method="POST">
                <td><?=$i?></td>
                <td><input type="hidden" name="companystatus_id" value="<?=$value->id?>"><input type="text" value="<?php echo $value->company_status; ?>" name="company_status"></td>
                <td> <button  type="button" " onclick="deleteexchange(<?=$value->id?>)" style="color:red; background:none; border:none;" id="deleteaccess"><span class="glyphicon glyphicon-trash" for="deleteaccess"></span></button>
                <button type="submit" name="submit" class="btn btn-primary">Save</button>
                </td>
                </form>
                </tr>
                <?php } ?>
            </tbody>

            </table>
</div>


        </div>
    </div>
  </div>
</section>
<script>
function deleteexchange(id){

       swal({
        title: "Are you sure?",
        text: "",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel please!",
        closeOnConfirm: false,
        closeOnCancel: true
      },
      function(isConfirm) {
        if (isConfirm) {
          $.ajax({
         url: '<?php echo base_url("admin/deletecompanystatus/")?>'+id,
             type: 'POST',
             error: function() {
                alert('Something is wrong');
             },
             success: function(data) {

                  $("#row"+id).remove();

            swal("Deleted!","", "success");

             }
          });
        }
      });
  }
  </script>
<script>
    $(document).ready(function(){
$(document).on('change', '.agentcode', function(){
var agentcode=$(this).val();
var user_id = $(this).data("userid");
var fkf=agentcode;
if(agentcode=="")
agentcode="x";
console.log(agentcode)
console.log(user_id)
                 $.ajax({
                  type: "POST",
                  url: '<?php echo base_url("Admin/updateagentcode")?>/'+user_id+"/"+agentcode,
                  cache:false,
                  data: {},
                  error: function() {
                      alert('Something is wrong');
                  },
             success: function(data) {
                 $('.agentcode'+user_id).val(fkf);
                      swal("Agent Code Updated Successfully","", "success");

             }
          });


        });
    });
</script>
  <script>
function test(productid){
  //alert(productid);
  //var productid = $(this).data("dproductid");
            //alert(userid);
            if($(this).is(':checked')){


                 var statusd = 1;

            }else{

                var statusd = 0;

            }
//alert(statusd);


                 $.ajax({
                   type: "POST",
                   url: '<?php echo base_url("Admin/updateproductstatus")?>',
                   cache:false,
                  data: {'productid':productid,'status':statusd},
                   error: function() {
                      alert('Something is wrong');
                   },
             success: function(data) {

                   if(status){
                      swal("Post De-active Successfully!","", "success");
                    }else{
                      swal("Post Active Successfully!","", "success");
                    }



             }
          });
}


    $(document).ready(function(){


           $('#deactivestatusssss').click(function(){

//alert(productid);
/*var productid = $(this).data("dproductid");
            //alert(userid);
            if($(this).is(':checked')){

                var statusd = 0;

            }else{

                var statusd = 1;

            }



                 $.ajax({
                   type: "POST",
                   url: '<?php echo base_url("Admin/updateproductstatus")?>',
                   cache:false,
                  data: {'productid':productid,'status':statusd},
                   error: function() {
                      alert('Something is wrong');
                   },
             success: function(data) {

                   if(status){
                      swal("Post De-active Successfully!","", "success");
                    }else{
                      swal("Post Active Successfully!","", "success");
                    }



             }
          });*/


        });





    });
</script>

<script type="text/javascript">
    $(".deletebuyer").click(function(){
        var id = $(this).parents("tr").attr("id");
       // alert(id);

       swal({
        title: "Are you sure?",
        text: "",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel please!",
        closeOnConfirm: false,
        closeOnCancel: false
      },
      function(isConfirm) {
        if (isConfirm) {
          $.ajax({
         url: '<?php echo base_url("admin/deletebuyer/")?>'+id,
             type: 'DELETE',
             error: function() {
                alert('Something is wrong');
             },
             success: function(data) {

                  $("#"+id).remove();

            swal("Deleted!","", "success");

             }
          });
        } else {
          swal("Cancelled", "", "error");
        }
      });

    });


        $(".deleteseller").click(function(){
        var id = $(this).parents("tr").attr("id");
       // alert(id);

       swal({
        title: "Are you sure?",
        text: "",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel please!",
        closeOnConfirm: false,
        closeOnCancel: false
      },
      function(isConfirm) {
        if (isConfirm) {
          $.ajax({
         url: '<?php echo base_url("admin/deleteseller/")?>'+id,
             type: 'DELETE',
             error: function() {
                alert('Something is wrong');
             },
             success: function(data) {

                  $("#"+id).remove();

            swal("Deleted!","", "success");

             }
          });
        } else {
          swal("Cancelled", "", "error");
        }
      });

    });
</script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>







<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>




<script>

     $('#example3,#example4,#example5').DataTable({

            //"columnDefs": [{
              //  "orderSequence": ["desc", "asc"],
                //"searchable": false,
            //    "orderable": false,
              //  "targets": 0
        //    }],
          //  "order": [[0, 'asc' ]]
        });


</script>



<!-- <script src="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" /> -->

<!-- <script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script> -->
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




