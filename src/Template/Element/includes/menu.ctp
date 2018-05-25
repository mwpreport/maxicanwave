<?php ?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->

		<?php if($role!=5){?>
		<?php }?>
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="active"><a href="<?php echo $this->Url->build(["controller" => "Mrs","action" => "dashboard"])?>"><i class="fa fa-home" aria-hidden="true"></i>
                <span>Home</span></a>
            </li>

            <!-- Optionally, you can add icons to the links -->
            <?php if($role==5){?>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-medkit" aria-hidden="true"></i> <span>Core Data</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                	<li><?= $this->Html->link(__('<i class="fa fa-circle-o"></i> Dr List'), ['controller' => 'Mrs', 'action' => 'doctorList'], ['escape' => false]) ?></li>
                	<li><?= $this->Html->link(__('<i class="fa fa-circle-o"></i> Chemist List'), ['controller' => 'Chemists', 'action' => 'index'], ['escape' => false]) ?></li>
                </ul>
            </li>
            <?php }else{?>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-medkit" aria-hidden="true"></i> <span>Manage Users</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                	<li><?= $this->Html->link(__('<i class="fa fa-circle-o"></i> Users'), ['controller' => 'Users', 'action' => 'index'], ['escape' => false]) ?></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-medkit" aria-hidden="true"></i> <span>Core Data</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                	<li><?= $this->Html->link(__('<i class="fa fa-circle-o"></i> Doctors'), ['controller' => 'Doctors', 'action' => 'index'], ['escape' => false]) ?></li>
                	<li><?= $this->Html->link(__('<i class="fa fa-circle-o"></i> Doctors Assignment'), ['controller' => 'DoctorsRelation', 'action' => 'index'], ['escape' => false]) ?></li>
                	<li><?= $this->Html->link(__('<i class="fa fa-circle-o"></i> Chemists'), ['controller' => 'Chemists', 'action' => 'index'], ['escape' => false]) ?></li>
                	<li><?= $this->Html->link(__('<i class="fa fa-circle-o"></i> Stockists'), ['controller' => 'Stockists', 'action' => 'index'], ['escape' => false]) ?></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-medkit" aria-hidden="true"></i> <span>Core Form Data</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
					<li><?= $this->Html->link(__('<i class="fa fa-circle-o"></i> Qualifications'), ['controller' => 'Qualifications', 'action' => 'index'], ['escape' => false]) ?></li>
					<li><?= $this->Html->link(__('<i class="fa fa-circle-o"></i> Specialities'), ['controller' => 'Specialities', 'action' => 'index'], ['escape' => false]) ?></li>
					<li><?= $this->Html->link(__('<i class="fa fa-circle-o"></i> States'), ['controller' => 'States', 'action' => 'index'], ['escape' => false]) ?></li>
					<li><?= $this->Html->link(__('<i class="fa fa-circle-o"></i> Cities'), ['controller' => 'Cities', 'action' => 'index'], ['escape' => false]) ?></li>
					<li><?= $this->Html->link(__('<i class="fa fa-circle-o"></i> Products'), ['controller' => 'Products', 'action' => 'index'], ['escape' => false]) ?></li>
					<li><?= $this->Html->link(__('<i class="fa fa-circle-o"></i> Assign Samples'), ['controller' => 'AssignedSamples', 'action' => 'index'], ['escape' => false]) ?></li>
					<li><?= $this->Html->link(__('<i class="fa fa-circle-o"></i> Gifts'), ['controller' => 'Gifts', 'action' => 'index'], ['escape' => false]) ?></li>
					<li><?= $this->Html->link(__('<i class="fa fa-circle-o"></i> Assign Gifts'), ['controller' => 'AssignedGifts', 'action' => 'index'], ['escape' => false]) ?></li>
					<li><?= $this->Html->link(__('<i class="fa fa-circle-o"></i> Leave Types'), ['controller' => 'LeaveTypes', 'action' => 'index'], ['escape' => false]) ?></li>
					<li><?= $this->Html->link(__('<i class="fa fa-circle-o"></i> Configuration'), ['controller' => 'Config', 'action' => 'index'], ['escape' => false]) ?></li>
                </ul>
            </li>
            <?php }?>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-calendar"></i>
                    <span>Daily Activities</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
					<li><?= $this->Html->link(__('<i class="fa fa-circle-o"></i> Daily Report'), ['controller' => 'Mrs', 'action' => 'dailyReport'], ['escape' => false]) ?></li>
					<li><?= $this->Html->link(__('<i class="fa fa-circle-o"></i> Monthly Planning'), ['controller' => 'Mrs', 'action' => 'monthlyplan'], ['escape' => false]) ?></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Expenses</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                    <span>Approval Status</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
					<?php if($role!=5){?>
						<li><?= $this->Html->link(__('<i class="fa fa-circle-o"></i> Work plan Requests'), ['controller' => 'Mrs', 'action' => 'workPlanRequests'], ['escape' => false]) ?></li>
					<?php }?>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Expenses</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> DV List</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Leave</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                    <span>Marketing</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="#"><i class="fa fa-circle-o"></i> Dr Campaign
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="#"><i class="fa fa-circle-o"></i> Apply</a></li>
                            <li><a href="#"><i class="fa fa-circle-o"></i> Status</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i><span>Sales</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Secondary Sales</a></li>
                    <li>
                        <a href="#"><i class="fa fa-circle-o"></i> Primary Sales
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="#"><i class="fa fa-circle-o"></i> Periodic Sales</a></li>
                            <li><a href="#"><i class="fa fa-circle-o"></i> Goods Return</a></li>
                        </ul>
                    </li>

                </ul>
            </li>
            <li><a href="#">
                    <i class="fa fa-book"></i> 
                    <span>Reports</span></a>
            </li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>

