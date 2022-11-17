
  <!-- Left side column. contains the logo and sidebar -->
 <?php include('header.php');?>
  <?php include('sidebar.php');?>
<style>
 #toast{
  position: fixed;
    z-index: 10;
    background: white;
    bottom: 33px;
    left: 50%;
    font-size: 19px;
    border: 1px solid;
    padding: 12px 39px;
    border-radius: 19px;
    color: green;
   display:none;
}
</style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     <section class="content-header">
      <h1>
        Forums
      </h1>
   <ol style="float:left" class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Access Users</li>
      </ol>
</section>
<div id="toast"></div>
    <button id="deleteallbtn" class="btn btn-danger" style="position: absolute; right: 199px; margin-top: -28px;">Delete All</button>
<section class="content">
    <div class="box">
<div class="box-body">
  <table id="example3" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th></th>
                  <th>Sr.</th>
                  <th>Posted By</th>
                  <th>Forum Type</th>
                  <th style="width:50px">Content</th>>
                  <th>Image or Options</th>
                  <th>Validity</th>
                  <th>Posted On</th>
                  <th>Action</th>
                </tr>
                </thead>
        <tbody>
          <?php
          foreach($forums as $key => $forum){ ?>
          <tr id="trxt<?=$forum->id?>">
            <td><input type="checkbox" class="deleteallcheck" value="<?=$forum->id?>"></td>
            <td><?=$key+1?></td>
            <td><?=$forum->posted_by_name?></td>
            <td><?=$forum->forum_type?></td>
            <td><?=substr($forum->content, 0, 100);?>...</td>
            <td><?php
            if($forum->forum_type=="forum"){
              echo ($forum->content_image!="")?'<img style="height: 100px; max-width: 186px;" src="'.$forum->content_image.'">':"";
            }
            else{
              echo '<ul><li>'.($forum->options->option1).'</li><li>'.($forum->options->option2).'</li><li>'.($forum->options->option3).'</li></ul>';
            }
            ?></td>

            <td><?=($forum->validity==0)?"No Validity":$forum->validity." days"?></td>
            <td><?=$forum->created?></td>
            <td><a href="<?=base_url()."admin/editforum/".$forum->id?>"><button class="iconbtn"><i class="fa fa-edit"></i></button></a><button data-formid="<?=$forum->id?>" class="iconbtn deleteforumbtn"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
          </tr>
          <?php } ?>

        </tbody>

            </table>
        </div>
    </div>
     </div>

<script>

    $('#example3').DataTable();
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })

</script>
  <!-- /.content-wrapper -->
  <script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
 <script>
   $(document).ready(function(){
   $(document).on("click", "#deleteallbtn", function(){

     var forumIDs = $('.deleteallcheck:checkbox:checked').map(function() {
    return this.value;
		}).get();
     if(forumIDs.length==0){
       alert("Please! select atleast one forum");
       return false;
     }

     if (!confirm('Are you really want to delete Forums ?'))
         return false;
     var ForumIds = forumIDs.join(",");

     	$.ajax({
  				type: "POST",
  				url: "https://ashom.app/api/webservice/deleteallforums",
 				data: {"ForumIds":ForumIds},
          		beforeSend: function() {
        			 $("#toast").text("Deleting");
                  $("#toast").css("color", "blue");
                  	$("#toast").show();
    			},
          		error: function(err){
                  console.log(err);
                	 $("#toast").text("Error : "+JSON.stringify(err.responseJSON));
                  $("#toast").css("color", "red");
                  	setTimeout(function(){ $("#toast").hide(); }, 3000);
                },
  				success: function(data){
                  $('.deleteallcheck:checkbox:checked').map(function() {
    					return $("#trxt"+(this.value)).remove();
                  }).get();
                  $("#toast").text("Deleted");
                  $("#toast").css("color", "green");
                  	setTimeout(function(){ $("#toast").hide(); }, 3000);
                }
			});
   		});


   $(document).on("click", ".deleteforumbtn", function(){
     if (!confirm('Are you really want to delete this Forum ?'))
         return false;
     var forumId = $(this).data("formid");
     $("#trxt"+forumId).remove();
     	$.ajax({
  				type: "GET",
  				url: "https://ashom.app/api/webservice/deleteforum/"+forumId,
 				data: {},
          		beforeSend: function() {
        			 $("#toast").text("Deleting");
                  $("#toast").css("color", "blue");
                  	$("#toast").show();
    			},
          		error: function(err){
                  console.log(err);
                	 $("#toast").text("Error : "+JSON.stringify(err.responseJSON));
                  $("#toast").css("color", "red");
                  	setTimeout(function(){ $("#toast").hide(); }, 3000);
                },
  				success: function(data){
                  $("#toast").text("Deleted");
                  $("#toast").css("color", "green");
                  	setTimeout(function(){ $("#toast").hide(); }, 3000);
                }
			});
   		});
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
<?php include('footer.php');?>
