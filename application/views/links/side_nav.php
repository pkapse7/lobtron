<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>
                
                <li>
                    <?php if($this->session->userdata('type')== 0){ ?>
                    <a href="<?=site_url('employees')?>" class=" waves-effect">
                        <i class="bx bxs-user"></i>
                        <span>Employees</span>
                    </a>
                    <?php }else if($this->session->userdata('type')== 1){ ?>
                    <a href="<?=site_url('employees-profile')?>" class=" waves-effect">
                        <i class="bx bxs-user"></i>
                        <span>Profile</span>
                    </a>
                    <?php } ?>
                </li>
                
                
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
