<nav class="navbar show navbar-vertical h-lg-screen navbar-expand-lg px-0 py-3 navbar-light bg-white border-bottom border-bottom-lg-0 border-end-lg"
    id="navbarVertical">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler ms-n2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarCollapse"
            aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand py-lg-2 mb-lg-5 px-lg-6 me-0" href="./dashboard.php">
           <div class="d-flex justify-content-space-between align-items-center align-self-center">
            <p>
                <b><span>Doctors Portal</span></b>
            </p>
           </div>
        </a>
        <!-- User menu (mobile) -->
        <div class="navbar-user d-lg-none">
            <!-- Dropdown -->
            <div class="dropdown">
                <!-- Toggle -->
                <a href="#" id="sidebarAvatar" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <div class="avatar-parent-child">
                        
                        <span class="avatar-child avatar-badge bg-success"></span>
                    </div>
                </a>
            </div>
        </div>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidebarCollapse">
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" id="dashboard" href="./dashboard.php">
                        <i class="bi bi-speedometer"></i> Dashboard
                    </a>
                </li>
               

                <li class="nav-item">
                    <a class="nav-link" id="manage_doctor" href="./manage_doctor.php">
                    <i class="bi bi-people"></i> Manage Doctor
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="manage_patient" href="./manage_patient.php">
                    <i class="bi bi-people"></i> Manage Patient
                    </a>
                </li>

                <li class="nav-item ">
                    <a class="nav-link active" id="manage_allotment" href="./manage_allotment.php">
                    <i class="bi bi-bookmark"></i> Manage Doctor Allotment
                    </a>
                </li>
                <!-- <?php 
                
                 if ($_SESSION["admin_role"]==1 || $_SESSION["admin_role"]==2) { 
                    ?>
                     <li class="nav-item">
                    <a class="nav-link" id="manage_user" href="./manage_user.php">
                    <i class="bi bi-people"></i> Manage User
                    </a>
                </li>
                    <?php  
                     
                 } 
                 
                ?> -->
                
                <li class="nav-item">
                    <a class="nav-link" id="account" href="./profile.php">
                        <i class="bi bi-person-square"></i> Account
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="../../backend/login_signup/logout.php">
                        <i class="bi bi-box-arrow-left"></i> Logout
                    </a>
                </li>
                
            </ul>
        </div>
    </div>
</nav>