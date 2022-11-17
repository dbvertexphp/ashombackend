<style type="text/css">
  .pd_top{
    padding: 7px 0px 7px 0px;
  }
</style>

<?php
$user_type = $this->session->userdata('user_type');
?>
 <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
         <!-- <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">-->
        </div>
        <div class="pull-left info">

        </div>
      </div>

      <ul class="sidebar-menu" data-widget="tree">
        <!--<li class="header">MAIN NAVIGATION</li>-->
        <?php
        if($user_type=="admin"){ ?>
        <li class="<?php echo ($this->uri->segment(2) == 'dashboard')?'active':''; ?>">
          <a href="<?=  base_url('admin/dashboard'); ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">

            </span>
          </a>
        </li>
 		<li class="<?php echo ($this->uri->segment(2) == 'accessusers')?'active':''; ?>">
          <a href="<?=  base_url('admin/accessusers'); ?>">
            <i class="fa fa-key"></i> <span>Access Users</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green"></small>
            </span>
          </a>

        </li>

<li class="<?php echo ($this->uri->segment(2) == 'users')?'active':''; ?>">
          <a href="<?=  base_url('admin/users'); ?>">
            <i class="fa fa-group"></i> <span>Users</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green"></small>
            </span>
          </a>

        </li>
        <?php }

        ?>
      <li class="<?php echo ($this->uri->segment(2) == 'documents')?'active':''; ?>">
          <a href="<?=  base_url('admin/documents'); ?>">
            <i class="fa fa-group"></i> <span>Documents</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green"></small>
            </span>
          </a>

        </li>
       <?php
        if($user_type=="admin"){ ?>
      <li class="<?php echo ($this->uri->segment(2) == 'contactus')?'active':''; ?>">
          <a href="<?=  base_url('admin/contactus'); ?>">
            <i class="fa fa-group"></i> <span>Contact Us</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green"></small>
            </span>
          </a>

        </li>
         <li class="<?php echo ($this->uri->segment(2) == 'industries')?'active':''; ?>">
          <a href="<?=  base_url('admin/industries'); ?>">
            <i class="fa fa-industry"></i> <span>Industries</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green"></small>
            </span>
          </a>

        </li>
        <li class="<?php echo ($this->uri->segment(2) == 'forums')?'active':''; ?>">
          <a href="<?=  base_url('admin/forums'); ?>">
            <i class="fa fa-group"></i> <span>Forums</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green"></small>
            </span>
          </a>

	<li class="<?php echo ($this->uri->segment(2) == 'exchanges')?'active':''; ?>">
          <a href="<?=  base_url('admin/exchanges'); ?>">
            <i class="fa fa-houzz"></i> <span>Exchanges</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green"></small>
            </span>
          </a>

        </li>
	<li class="<?php echo ($this->uri->segment(2) == 'companystatus')?'active':''; ?>">
          <a href="<?=  base_url('admin/companies_status'); ?>">
            <i class="fa fa-minus-circle"></i> <span>Company Status</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green"></small>
            </span>
          </a>

        </li>
        <li class="<?php echo ($this->uri->segment(2) == 'financial_news')?'active':''; ?>">
          <a href="<?=  base_url('admin/financial_news'); ?>">
            <i class="fa fa-newspaper-o"></i> <span>Financial News</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green"></small>
            </span>
          </a>

        </li>

        <li class="<?php echo ($this->uri->segment(2) == 'missing_financial_reports')?'active':''; ?>">
          <a href="<?=  base_url('admin/missing_financial_reports'); ?>">
            <i class="fa fa-bug"></i> <span>Missing Financial Reports</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green"></small>
            </span>
          </a>

        </li>
        
        <li class="<?php echo ($this->uri->segment(2) == 'notification_line')?'active':''; ?>">
          <a href="<?=  base_url('admin/notification_line'); ?>">
            <i class="fa fa-bell"></i> <span>Notification Alerts</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green"></small>
            </span>
          </a>

        </li>
        
        <li class="<?php echo ($this->uri->segment(2) == 'user_events')?'active':''; ?>">
          <a href="<?=  base_url('admin/user_events'); ?>">
            <i class="fa fa-calendar"></i> <span>User Events</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green"></small>
            </span>
          </a>

        </li>

        <?php }

        ?>
      </ul>

    </section>
    <!-- /.sidebar -->
  </aside>
