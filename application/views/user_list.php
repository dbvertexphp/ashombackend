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
        Users
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


    <div class="tab-content">
        <table id="example3">
                <thead>
                <tr>
                  <th>S no.</th>
                   <th>Username</th>
                  <th>Mobile</th>
                  <th>Email</th>
                  <th>Registered on</th>
                  <th>Subscription Type</th>
                  <th>Subscription Expires On</th>
                  <th>App Version</th>
                  <th>Activity</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
                </thead>
        <tbody>


          <?php $i=0; foreach ($users as $value) {

            $i++;
  				$subscription = get_subscription($value->id);  
  				$subscription_type = $subscription?$subscription->subscription_type:"User Not Verified.";
 				$subscription_expire_on = $subscription?$subscription->expire_on:"NA";
        
            ?>

                <tr id="row<?php echo $value->id; ?>">
                <td><?=$i?></td>
                <td><?php echo  $value->first_name." ".$value->last_name;?></td>
                <td><?php echo  $value->mobile;?></td>
                <td><?php echo  $value->email;?></td>
                <td><?=date("d M, Y", strtotime($value->created))?></td>
				        <td><?php echo $subscription_type ?></td>
                <td><?php echo date("d M, Y", strtotime($subscription_expire_on)) ?></td>
                  <td><?php echo  $value->app_version;?></td>
                  <td><a class="btn btn-sm btn-info" href="<?=base_url('admin/user_events/'.$value->id)?>"><i class="fa fa-eye"></i></a></td>
                <!-- <td id="example"><a class="btn btn-sm btn-info" href="<?=base_url('admin/edit_users/'.$value->id)?>"><i class="fa fa-edit"></i></a> -->
              <!-- </td> -->
              <td><button class="btn btn-sm btn-info" data-toggle="modal" type="button" data-target="#update_modal<?php echo $value->id?>"><i class="fa fa-edit"></i></button></td>
              <td> <button type="button" onclick="deleteuser(<?=$value->id?>)" style="color:red; background:none; border:none;" id="deleteaccess">
                    <span class="glyphicon glyphicon-trash" for="deleteaccess"></span>
</button></td>
                </tr>
                <?php include('edit_users.php'); } ?>
            </tbody>

            </table>
</div>


        </div>
    </div>
  </div>
</section>
<script>
function deleteuser(id){

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
         url: '<?php echo base_url("admin/deleteuser/")?>'+id,
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
function getMailtype(value) {
var days = value;

var newDate = new Date(Date.now() + days * 24*60*60*1000);
var s  = new Date(newDate).toLocaleDateString(undefined, {timeZone: 'Asia/Kolkata'});
var v =  moment(newDate).format(' YYYY-MM-DD');

    document.querySelector("#mail_info input").value = v ;
}
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.2/moment.min.js"></script>
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


        dom: 'Bfrtip',
        buttons: [
            'excel',
        ],"columnDefs": [{
                "orderSequence": ["desc", "asc"],
                "searchable": true,
                "orderable": false,
                "targets": 0
            }],
            "order": [[0, 'asc' ]]
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

