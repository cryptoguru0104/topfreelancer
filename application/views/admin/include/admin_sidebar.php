<?php 
$cur_tab = $this->uri->segment(2)==''?'dashboard': $this->uri->segment(2);  
?>  

  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
     
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li id="dashboard"><a href="<?= base_url('admin/dashboard'); ?>"><i class="fa fa-circle-o"></i> Dashboard</a></li>
      </ul>

      <ul class="sidebar-menu">
        <li id="admin" class="treeview">
            <a href="#">
              <i class="fa fa-user"></i> <span>Admin</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li id=""><a href="<?= base_url('admin/profile'); ?>"><i class="fa fa-circle-o"></i>Admin Profile</a></li>
              <li id=""><a href="<?= base_url('admin/profile/change_pwd'); ?>"><i class="fa fa-circle-o"></i>Change Password</a></li>
              <li id=""><a href="<?= base_url('admin/add'); ?>"><i class="fa fa-circle-o"></i>Add Admin</a></li>
            </ul>
          </li>
      </ul>

      <ul class="sidebar-menu">
        <li id="users" class="treeview">
            <a href="#">
              <i class="fa fa-users"></i> <span>Users</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li id=""><a href="<?= base_url('admin/users'); ?>"><i class="fa fa-circle-o"></i>Users List</a></li>
              <li id="user_add"><a href="<?= base_url('admin/users/add'); ?>"><i class="fa fa-circle-o"></i>Add New Users</a></li>
            </ul>
          </li>
      </ul>


      <ul class="sidebar-menu">
        <li id="job" class="treeview">
            <a href="#">
              <i class="fa fa-file-text"></i> <span>Jobs Posting</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li id=""><a href="<?= base_url('admin/job'); ?>"><i class="fa fa-circle-o"></i>View Jobs</a></li>
              <li id=""><a href="<?= base_url('admin/job/post'); ?>"><i class="fa fa-circle-o"></i>Add New Job</a></li>
            </ul>
          </li>
      </ul>
      
      <ul class="sidebar-menu">
        <li class="header">JOB ATTRIBUTES</li>
        <li id=""><a href="<?= base_url('admin/languages'); ?>"><i class="fa fa-circle-o"></i>Language</a></li>
        <li id=""><a href="<?= base_url('admin/education'); ?>"><i class="fa fa-circle-o"></i>Degree</a></li>
        <li id=""><a href="<?= base_url('admin/employment'); ?>"><i class="fa fa-circle-o"></i>Workstation Type</a></li>
				<li id="location" class="treeview">
            <a href="#">
              <i class="fa fa-map-marker "></i> <span>Manage Locations</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class=""><a href="<?= base_url('admin/location'); ?>"><i class="fa fa-circle-o"></i>country</a></li>
             <!-- <li class=""><a href="<?= base_url('admin/location/state'); ?>"><i class="fa fa-circle-o"></i>state</a></li>-->
              <li class=""><a href="<?= base_url('admin/location/city'); ?>"><i class="fa fa-circle-o"></i>city</a></li>
            </ul>
          </li>
      </ul>

      <ul class="sidebar-menu">
					<li class="header">LAYOUT</li>
        	<li id="slider" class="treeview">
            <a href="<?= base_url('admin/sliders/home_slider'); ?>">
              <i class="fa fa-file"></i> <span>Home Slider</span>
            </a>
          </li>
					<ul class="sidebar-menu">
							<li id="pages" class="treeview">
									<a href="#">
										<i class="fa fa-file-o"></i> <span>Pages</span>
										<span class="pull-right-container">
											<i class="fa fa-angle-left pull-right"></i>
										</span>
									</a>
									<ul class="treeview-menu">
										<li id=""><a href="<?= base_url('admin/pages'); ?>"><i class="fa fa-circle-o"></i>Pages</a></li>
										<li id=""><a href="<?= base_url('admin/pages/add'); ?>"><i class="fa fa-circle-o"></i>Add new page</a></li>
									</ul>
								</li>
					</ul>

					<ul class="sidebar-menu">
							<li id="blog" class="treeview">
									<a href="#">
										<i class="fa fa-file-text"></i> <span>Blog</span>
										<span class="pull-right-container">
											<i class="fa fa-angle-left pull-right"></i>
										</span>
									</a>
									<ul class="treeview-menu">
										<li id=""><a href="<?= base_url('admin/blog'); ?>"><i class="fa fa-circle-o"></i>Posts</a></li>
										<li id=""><a href="<?= base_url('admin/blog/category'); ?>"><i class="fa fa-circle-o"></i>Category</a></li>
									</ul>
								</li>
					 </ul>
			</ul>
      <ul class="sidebar-menu">
					<li class="header">SETTING</li>		
        	<li id="setting" class="treeview">
            <a href="<?= base_url('admin/general_settings'); ?>">
              <i class="fa fa-cogs"></i> <span>General Settings</span>
            </a>
          </li>
          <li id="template" class="treeview">
            <a href="<?= base_url('admin/general_settings/email_templates'); ?>">
                  <i class="fa fa-cogs"></i> <span>Email Templates Settings</span>
            </a>
        	</li>
      </ul> 

    </section>
    <!-- /.sidebar -->
  </aside>

  
<script>
  $("#<?= $cur_tab ?>").addClass('active');
</script>
