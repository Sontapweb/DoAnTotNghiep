<!-- Banner -->
<a class="btn w-full btn-primary text-truncate rounded-0 py-2 border-0 position-relative" style="z-index: 1000;">
    <strong>Hỗ Trợ Sinh Viên
</a>

<!-- Dashboard -->
<div class="d-flex flex-column flex-lg-row h-lg-full bg-surface-secondary">
    <!-- Vertical Navbar -->
    <nav class="navbar show navbar-vertical h-lg-screen navbar-expand-lg px-0 py-3 navbar-light bg-white border-bottom border-bottom-lg-0 border-end-lg" id="navbarVertical">
        <div class="container-fluid">
            <!-- Toggler -->
            <button class="navbar-toggler ms-n2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Brand -->
            <a class="navbar-brand py-lg-2 mb-lg-5 px-lg-6 me-0">
                <img src="../images/logo.jpg" alt="Logo" width="30%">
            </a>
            <!-- User menu (mobile) -->
            <div class="navbar-user d-lg-none">
                <!-- Dropdown -->
                <div class="dropdown">
                    <!-- Toggle -->
                    <a href="#" id="sidebarAvatar" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="avatar-parent-child">
                            <img alt="Image Placeholder" src="https://images.unsplash.com/photo-1548142813-c348350df52b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80" class="avatar avatar- rounded-circle">
                            <span class="avatar-child avatar-badge bg-success"></span>
                        </div>
                    </a>
                    <!-- Menu -->
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="sidebarAvatar">
                        <a href="#" class="dropdown-item">Profile</a>
                        <a href="#" class="dropdown-item">Settings</a>
                        <a href="#" class="dropdown-item">Billing</a>
                        <hr class="dropdown-divider">
                        <a href="#" class="dropdown-item">Logout</a>
                    </div>
                </div>
            </div>
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidebarCollapse">
                <!-- Navigation -->
                <ul class="navbar-nav nav1">
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/doanhotrosv/admin">
                            <i class="bi bi-house"></i> Trang chủ
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="catlist.php">
                            <i class="bi bi-folder"></i> Danh mục
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="brandlist.php">
                            <i class="bi bi-folder"></i> Thương hiệu
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="postlist.php">
                            <i class="bi bi-folder"></i> Danh mục tin tức
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="productlist.php">
                            <i class="bi bi-box"></i> Sản phẩm
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="bloglist.php">
                            <i class="bi bi-newspaper"></i> Tin tức
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="colorlist.php">
                            <i class="bi bi-newspaper"></i> Màu sắc
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="sizelist.php">
                            <i class="bi bi-newspaper"></i> Kích cỡ
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="sliderlist.php">
                            <i class="bi bi-images"></i> Banner
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="inbox.php">
                            <i class="bi bi-chat"></i> Đơn hàng
                            <span class="badge bg-soft-primary text-primary rounded-pill d-inline-flex align-items-center ms-auto"><?php 
                            $getinboxcount = $blog->getinboxcount();
                            if($getinboxcount){
                                 $product_count = mysqli_num_rows($getinboxcount);
                                 echo $product_count; 
                            }
                            else{
                                echo '0';
                            }                       
                            
                         ?></span>
                        </a>
                    </li> 
                    <li class="nav-item">
                        <a class="nav-link" href="contactlist.php">
                            <i class="bi bi-chat"></i> Liên hệ
                            <span class="badge bg-soft-primary text-primary rounded-pill d-inline-flex align-items-center ms-auto"><?php 
                            $contact_all = $blog->getcontactcount();
                            if($contact_all){
                                 $contact_count = mysqli_num_rows($contact_all);
                                 echo $contact_count; 
                            }
                            else{
                                echo '0';
                            }                       
                            
                         ?></span>
                        </a>
                    </li>                    
                    <li class="nav-item">
                        <a class="nav-link" href="cauhinh.php">
                            <i class="bi bi-tools"></i> Cấu hình
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="clublist.php">
                        <i class="bi bi-microsoft-teams"></i> CLB
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="addclublist.php">
                            <i class="bi bi-chat"></i> Duyệt thành viên CLB
                            <span class="badge bg-soft-primary text-primary rounded-pill d-inline-flex align-items-center ms-auto"><?php 
                            $contact_all = $blog->getduyetclub();
                            if($contact_all){
                                 $contact_count = mysqli_num_rows($contact_all);
                                 echo $contact_count; 
                            }
                            else{
                                echo '0';
                            }                       
                            
                         ?></span>
                        </a>
                    </li>   
                </ul>
                <!-- Divider -->
                <hr class="navbar-divider my-5 opacity-20">
                <!-- Push content down -->
                <div class="mt-auto"></div>
                <!-- User (md) -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-person-square"></i> <?php echo Session::get('tennd') ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?action=logout" onClick = "return confirm('Bạn có chắc muốn đăng xuất không?')">
                            <i class="bi bi-box-arrow-left"></i> Đăng xuất
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php
    if(isset($_GET['action'])&&$_GET['action']=='logout'){
        Session::destroy_admin();
    }
?>
    <!-- Main content -->
    <div class="h-screen flex-grow-1 overflow-y-lg-auto">
        <!-- Main -->
        <main class="py-6 bg-surface-secondary">
            <div class="container-fluid">
                <!-- Card stats -->
                <!-- <div class="row g-6 mb-6">
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card shadow border-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <span class="h6 font-semibold text-muted text-sm d-block mb-2">Budget</span>
                                        <span class="h3 font-bold mb-0">$750.90</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-tertiary text-white text-lg rounded-circle">
                                            <i class="bi bi-credit-card"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2 mb-0 text-sm">
                                    <span class="badge badge-pill bg-soft-success text-success me-2">
                                        <i class="bi bi-arrow-up me-1"></i>13%
                                    </span>
                                    <span class="text-nowrap text-xs text-muted">Since last month</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card shadow border-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <span class="h6 font-semibold text-muted text-sm d-block mb-2">New projects</span>
                                        <span class="h3 font-bold mb-0">215</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-primary text-white text-lg rounded-circle">
                                            <i class="bi bi-people"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2 mb-0 text-sm">
                                    <span class="badge badge-pill bg-soft-success text-success me-2">
                                        <i class="bi bi-arrow-up me-1"></i>30%
                                    </span>
                                    <span class="text-nowrap text-xs text-muted">Since last month</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card shadow border-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <span class="h6 font-semibold text-muted text-sm d-block mb-2">Total hours</span>
                                        <span class="h3 font-bold mb-0">1.400</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-info text-white text-lg rounded-circle">
                                            <i class="bi bi-clock-history"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2 mb-0 text-sm">
                                    <span class="badge badge-pill bg-soft-danger text-danger me-2">
                                        <i class="bi bi-arrow-down me-1"></i>-5%
                                    </span>
                                    <span class="text-nowrap text-xs text-muted">Since last month</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card shadow border-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <span class="h6 font-semibold text-muted text-sm d-block mb-2">Work load</span>
                                        <span class="h3 font-bold mb-0">95%</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-warning text-white text-lg rounded-circle">
                                            <i class="bi bi-minecart-loaded"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2 mb-0 text-sm">
                                    <span class="badge badge-pill bg-soft-success text-success me-2">
                                        <i class="bi bi-arrow-up me-1"></i>10%
                                    </span>
                                    <span class="text-nowrap text-xs text-muted">Since last month</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                
            