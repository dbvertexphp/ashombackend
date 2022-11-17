<!--  


<div class="content-wrapper">


    <section class="content-header">
   
      <h1>
        Edit User
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>

        <li class="active">Edit Company</li>
      </ol>
    </section> -->

<!-- <div class="container" style="margin-top:20px;">

<section class="content" style="padding-left: 270px;"> -->
<div class="modal fade" id="update_modal<?php echo $value->id;?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="">
        <div class="modal-header">
          <h3 class="modal-title">Update User</h3>
        </div>
        <div class="modal-body">
          <div class="col-md-2"></div>
          <div class="col-md-8">
            <div class="form-group">
            <label for="Title">Subscription Type:</label>
   <?php $companystatus = $this->db->get("plans_capacity")->result(); ?>
   <select class="form-control" onChange="getMailtype(this.value)" name="subscription_type" id="subscription_type">
   <option value="">Select Plan</option>
   <?php
   foreach($companystatus as $val){ ?>
   <option <?=($subscription_type==$val->plan_type?"selected":"")?> value="<?=$val->day?>"><?=$val->plan_type?></option>
   <?php } ?>
   </select>
            </div>
            <div class="form-group">
            <label for="Title">Start Date</label>
   <input name="created" class="form-control" id="date" value="<?php echo $subscription->created;?>" required>
            </div>
            <div class="form-group" id="mail_info">
            <label for="Title">Expiry Date</label>
   <input name="expire_on" class="form-control expiry" id ="mail_info"  value="<?php echo date("d M, Y", strtotime($subscription_expire_on)) ?>" required>
            </div>
          </div>
        </div>
        <div style="clear:both;"></div>
        <div class="modal-footer">
        <input type="hidden" name="id" id="id" value="<?=$value->id?>">
        <input type="submit" class="btn btn-primary" id="submit" name="submit" onclick="history.go(1)" data-dismiss="modal"  value="Update">
          <button class="btn btn-danger" type="button" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
        </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script>

$(document).ready(function () {
  $("#submit").click(function(){
    var subscription_type = $("#subscription_type").val();
    var id = $("#id").val();
    var expiry = $(".expiry").val();
    var dataString = 'subscription_type1='+ subscription_type + '&id1='+ id+ '&expiry1='+ expiry;
   

    $.ajax({
      type: "POST",
      url: "<?php echo base_url('admin/edit_users');?>",
      data: dataString,
      dataType: "json",
      success:function (data) {
       
       
      }
    });

    event.preventDefault();
  });
});

function refreshPage(){
    window.location.reload();
} 
</script>
<!-- </section>

</div> -->

<!-- </div> -->
<!-- <script>
function getMailtype(value) {
var days = value;

var newDate = new Date(Date.now() + days * 24*60*60*1000);
var s  = new Date(newDate).toLocaleDateString(undefined, {timeZone: 'Asia/Kolkata'});
var v =  moment(newDate).format(' YYYY-MM-DD');

    document.querySelector("#mail_info input").value = v ;
}
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.2/moment.min.js"></script>



 <script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
 Bootstrap 3.3.7 -->
<!-- <script src="<?php echo base_url();?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script> -->
<!-- DataTables -->
<!-- <script src="<?php echo base_url();?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script> -->
<!-- <script src="<?php echo base_url();?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script> -->
<!-- SlimScroll -->
<!-- <script src="<?php echo base_url();?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script> -->
<!-- FastClick -->
<!-- <script src="<?php echo base_url();?>assets/bower_components/fastclick/lib/fastclick.js"></script> -->
<!-- AdminLTE App -->
<!-- <script src="<?php echo base_url();?>assets/dist/js/adminlte.min.js"></script> -->
<!-- AdminLTE for demo purposes -->
<!-- <script src="<?php echo base_url();?>assets/dist/js/demo.js"></script> -->
 
