<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="../assets/css/main.css" rel="stylesheet" />
    <link href="../assets/css/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
</head>
<body class="app sidebar-mini rtl pace-done"><div class="pace  pace-inactive"><div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
  <div class="pace-progress-inner"></div>
</div>
<div class="pace-activity"></div></div>
<header class="app-header">
    <a class="app-header__logo" href="#"><img src="../image/admin/logo.jpeg" alt="" width="65%" class=""></a>
    <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    <ul class="app-nav">
        <!-- User Menu-->
        <li class="dropdown">
            <a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i> <?php if(isset($_SESSION['name'])){echo 'Admin';}?><span><i class="treeview-indicator fa fa-angle-down" style="font-size: 15px;"></i></span></a>
            <ul class="dropdown-menu settings-menu dropdown-menu-right account-dropdown">
                <li>
                    <a class="dropdown-item" href="#"><i class="fa fa-user fa-lg"></i> Profile</a>
                </li>
                <li>
                    <a class="dropdown-item" href="../admin/logout.php"><i class="fa fa-sign-out fa-lg"></i> Logout</a>
                </li>
            </ul>
        </li>
    </ul>
</header>
    
