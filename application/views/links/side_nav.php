<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="<?=site_url()?>" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span>Dashboard</span>
                    </a>
                    <?php if($this->session->userdata('type')== 0){ ?>
                    <a href="<?=site_url('company')?>" class=" waves-effect">
                        <i class="bx bxs-building"></i>
                        <span>Company</span>
                    </a>
                    <a href="<?=site_url('contactList')?>" class=" waves-effect">
                        <i class="bx bxs-building"></i>
                        <span>Contact list</span>
                    </a>
                    <?php }else if($this->session->userdata('type')== 1){ ?>
                    <a href="<?=site_url('own-profile')?>" class=" waves-effect">
                        <i class="bx bxs-user"></i>
                        <span>Details</span>
                    </a>
                    <a href="<?=site_url('contact')?>" class=" waves-effect">
                        <i class="bx bxs-phone"></i>
                        <span>Contacts</span>
                    </a>
                    <?php } ?>
                    <a href="<?=site_url('admin-logout')?>" class=" waves-effect">
                        <i class="bx bx-log-out-circle"></i>
                        <span>Logout</span>
                    </a>
                </li>


            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
