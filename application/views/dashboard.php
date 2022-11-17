
  <!-- Left side column. contains the logo and sidebar -->
 <?php include('header.php');?>
  <?php include('sidebar.php');?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
  /* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}
.small-box .icon {
    -webkit-transition: all .3s linear;
    -o-transition: all .3s linear;
    transition: all .3s linear;
    position: absolute;
    top: 8px;
    right: 10px;
    z-index: 0;
    font-size: 73px;
    color: rgba(0,0,0,0.15);
}

.slider.round:before {
  border-radius: 50%;
}</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
       <!-- <small>Control panel</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
      	<div class="col-lg-2 col-md-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">

              <h3><?=$this->db->select("count(*) as total")->get("users")->row()->total?></h3>

              <p>Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <!--<a href="<?php echo base_url(); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->

          </div>
        </div>
        	<div class="col-lg-2 col-md-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">

              <h3><?=$this->db->select("count(*) as total")->get("companies")->row()->total?></h3>

              <p>Companies</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <!--<a href="<?php echo base_url(); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->

          </div>
        </div>
    <div class="col-lg-2 col-md-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">

              <h3><?=$this->db->select("count(*) as total")->get("countries")->row()->total?></h3>

              <p>Countries</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <!--<a href="<?php echo base_url(); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->

          </div>
        </div>
		<div class="col-lg-2 col-md-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner" style="height: 104px;">

              <label class="switch">
			  <input type="checkbox" id="notificationswitch" <?=isNotificationActive()?"checked":""?>>
			  <span class="slider round"></span>
			</label>

              <p>Notification</p>
            </div>
            <div class="icon">
              <i class="fa fa-bell"></i>
            </div>
            <!--<a href="<?php echo base_url(); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->

          </div>
        </div>
      </div>



    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
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
<script>
  $("#notificationswitch").change(()=>{
  		$.ajax({
          type: "GET",
          url: "<?=base_url()?>admin/toogleNotification",
          data: {},
          success: function(data){
            Swal.fire(
              'Updated',
              'Notification status changed',
              'success'
            )
          }
        });
  });
</script>

<?php include('footer.php');?>
