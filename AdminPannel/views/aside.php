<?php

require_once "../controllers/app_settings.php";
$appsettings = new AppSettings();
$data = $appsettings->getData();

$active = "";
$active_sub = "";
if (isset($_GET['page'])) {
  $action = $_GET['page'];
  $url = explode("_", $action);
  if (count($url) == 1) {
    $active = $url[0];
    $active_sub = $url[0] . "_list";
  } else {
    $active = $url[0];
    $active_sub = $url[0] . "_" . $url[1];
  }
} else {
  $active = "dashboard";
}

?>

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../views/index.php">
    <div class="sidebar-brand-icon">
      <img src="../images/settings/logo_header_1.png" width="40" />
    </div>
    <div class="sidebar-brand-text mx-3"><?php echo $data['title'] ?></div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item <?= $active == 'dashboard' ? 'active' : '' ?>">
    <a class="nav-link" href="../views/index.php">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>
  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Settings Application
  </div>


  <!-- Nav Item - Settings -->
  <li class="nav-item <?= $active == 'application' ? 'active' : '' ?>">
    <a class="nav-link" href="../views/index.php?page=application_translation&lang=<?= $data["default_language_code"] ?>">
      <i class="fas fa-cogs"></i>
      <span>Application</span>
    </a>
  </li>

  <!-- Nav Item - Settings -->
  <li class="nav-item <?= $active == 'settings' ? 'active' : '' ?>">
    <a class="nav-link" href="../views/index.php?page=settings">
      <i class="fas fa-cogs"></i>
      <span>Settings</span>
    </a>
  </li>

  <!-- Nav Item - Config app -->
  <li class="nav-item <?= $active == 'config' ? 'active' : '' ?>">
    <a class="nav-link" href="../views/index.php?page=config">
      <i class="fas fa-plug"></i>
      <span>Config Application</span>
    </a>
  </li>
  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Interface
  </div>

  <!-- Nav Item - Settings -->
  <li class="nav-item <?= $active == 'splash' ? 'active' : '' ?>">
    <a class="nav-link" href="../views/index.php?page=splash">
      <i class="fas fa-clone"></i>
      <span>Splash screen</span>
    </a>
  </li>

  <!-- Nav Item - Boarding Collapse  -->
  <li class="nav-item  <?= $active == 'boarding' ? 'active' : '' ?> ">
    <a class=" nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBoarding" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-images"></i>
      <span>List boarding</span>
    </a>
    <div id="collapseBoarding" class="collapse <?= $active == 'boarding' ? 'show' : '' ?> " aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Boarding:</h6>
        <a class="collapse-item  <?= $active_sub == 'boarding_list' ? 'active' : '' ?>" href="../views/index.php?page=boarding">Boarding Screen</a>
        <a class="collapse-item  <?= $active_sub == 'boarding_add' ? 'active' : '' ?>" href="../views/index.php?page=boarding_add">Add boarding</a>
      </div>
    </div>
  </li>

  <!-- Nav Item - Pages Collapse Social -->
  <li class="nav-item  <?= $active == 'icon' ? 'active' : '' ?> ">
    <a class=" nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseHeader" aria-expanded="true" aria-controls="collapseHeader">
      <i class="fas fa-heading"></i>
      <span>Header</span>
    </a>
    <div id="collapseHeader" class="collapse <?= $active == 'icon' ? 'show' : '' ?> " aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Header navigation:</h6>
        <a class="collapse-item  <?= $active_sub == 'icon_header' ? 'active' : '' ?>" href="../views/index.php?page=icon_header">
          Header Config
        </a>
        <a class="collapse-item  <?= $active_sub == 'icon_left' ? 'active' : '' ?>" href="../views/index.php?page=icon_left">
          Left Icon
        </a>
        <a class="collapse-item  <?= $active_sub == 'icon_right' ? 'active' : '' ?>" href="../views/index.php?page=icon_right">
          Right Icon
        </a>
      </div>
    </div>
  </li>

  <!-- Nav Item - Pages Collapse Menu -->
  <!-- 
  <li class="nav-item  <?= $active == 'menu' ? 'active' : '' ?> ">
    <a class=" nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-list"></i>
      <span>Menu Items</span>
    </a>
    <div id="collapseTwo" class="collapse <?= $active == 'menu' ? 'show' : '' ?> " aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Menu Items:</h6>
        <a class="collapse-item  <?= $active_sub == 'menu_list' ? 'active' : '' ?>" href="../views/index.php?page=menu">List Menu</a>
        <a class="collapse-item  <?= $active_sub == 'menu_add' ? 'active' : '' ?>" href="../views/index.php?page=menu_add">Add Menu</a>
      </div>
    </div>
  </li>
  -->

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item  <?= $active == 'menudynamics' ? 'active' : '' ?> ">
    <a class=" nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-list"></i>
      <span>Menu Dynamic </span>
    </a>
    <div id="collapseTwo" class="collapse <?= $active == 'menudynamics' ? 'show' : '' ?> " aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Menu Dynamic :</h6>
        <a class="collapse-item  <?= $active_sub == 'menudynamics' ? 'active' : '' ?>" href="../views/index.php?page=menudynamics">List Menu</a>
      </div>
    </div>
  </li>

  <!-- Nav Item - Pages Collapse Pages -->
  <!--
  <li class="nav-item  <?= $active == 'pages' ? 'active' : '' ?> ">
    <a class=" nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePage" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-copy"></i>
      <span>List pages</span>
    </a>
    <div id="collapsePage" class="collapse <?= $active == 'pages' ? 'show' : '' ?> " aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">List pages:</h6>
        <a class="collapse-item  <?= $active_sub == 'pages_list' ? 'active' : '' ?>" href="../views/index.php?page=pages">List Pages</a>
        <a class="collapse-item  <?= $active_sub == 'pages_add' ? 'active' : '' ?>" href="../views/index.php?page=pages_add">Add Page</a>
      </div>
    </div>
  </li>
  -->

  <!-- Nav Item - App color -->
  <li class="nav-item <?= $active == 'tab' ? 'active' : '' ?>">
    <a class="nav-link" href="../views/index.php?page=tab">
      <i class="fas fa-fw fa-ellipsis-h"></i>
      <span>Tab navigation</span>
    </a>
  </li>


  <!-- Nav Item - Pages Collapse Pages -->
  <li class="nav-item  <?= $active == 'floating' ? 'active' : '' ?> ">
    <a class=" nav-link collapsed" href="#" data-toggle="collapse" data-target="#floatingPage" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fas fa-plus"></i>
      <span>Floating Button</span>
    </a>
    <div id="floatingPage" class="collapse <?= $active == 'floating' ? 'show' : '' ?> " aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Floating Button:</h6>
        <a class="collapse-item  <?= $active_sub == 'floating' ? 'active' : '' ?>" href="../views/index.php?page=floating">List Floating</a>
        <a class="collapse-item  <?= $active_sub == 'floating_add' ? 'active' : '' ?>" href="../views/index.php?page=floating_add">Add Floating</a>
      </div>
    </div>
  </li>

  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Config Application
  </div>

  <!-- Nav Item - App color -->
  <li class="nav-item <?= ($active == 'languages' ||  $active == 'translation') ? 'active' : '' ?>">
    <a class="nav-link" href="../views/index.php?page=languages">
      <i class="fas fa-fw fa-language"></i>
      <span>Languages</span></a>
  </li>

  <!-- Nav Item - App color -->
 <!--  <li class="nav-item <?= $active == 'colors' ? 'active' : '' ?>">
    <a class="nav-link" href="../views/index.php?page=colors">
      <i class="fas fa-fw fa-wrench"></i>
      <span>App color</span></a>
  </li> -->

  <!-- Nav Item - Settings -->
  <li class="nav-item <?= $active == 'useragent' ? 'active' : '' ?>">
    <a class="nav-link" href="../views/index.php?page=useragent">
      <i class="fas fa-cogs"></i>
      <span>User-Agent</span>
    </a>
  </li>

  <li class="nav-item <?= $active == 'application' ? 'active' : '' ?>">
    <a class="nav-link" href="../views/index.php?page=application">
      <i class="fas fa-mobile-alt"></i>
      <span>Application version</span></a>
  </li>
 
  <li class="nav-item <?= $active == 'admob' ? 'active' : '' ?>">
    <a class="nav-link" href="../views/index.php?page=admob">
      <i class="fas fa-ad"></i>
      <span>adMob</span></a>
  </li> 

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    App Information
  </div>

 
  <!-- Nav Item - Custom Javascript / CSS -->
  <li class="nav-item <?= $active == 'custom' ? 'active' : '' ?>">
    <a class="nav-link" href="../views/index.php?page=custom">
      <i class="fas fa-fw fa-code"></i>
      <span>CSS / Javascript</span></a>
  </li>


  <li class="nav-item <?= $active == 'about' ? 'active' : '' ?>">
    <a class="nav-link" href="../views/index.php?page=about&id=1&lang=<?= $data["default_language_code"] ?>">
      <i class="fas fa-info-circle"></i>
      <span>About Application</span></a>
  </li>

  <!-- Nav Item - Pages Collapse Social -->
  <li class="nav-item  <?= $active == 'social' ? 'active' : '' ?> ">
    <a class=" nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSocial" aria-expanded="true" aria-controls="collapseSocial">
      <i class="fas fa-share-square"></i>
      <span>Social Items</span>
    </a>
    <div id="collapseSocial" class="collapse <?= $active == 'social' ? 'show' : '' ?> " aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Social Media:</h6>
        <a class="collapse-item  <?= $active_sub == 'social_list' ? 'active' : '' ?>" href="../views/index.php?page=social">List Social</a>
      </div>
    </div>
  </li>
  <!-- Divider -->

  <!-- Nav Item - Pages Collapse Social -->
  <li class="nav-item  <?= $active == 'nativesocial' ? 'active' : '' ?> ">
    <a class=" nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseNativeSocial" aria-expanded="true" aria-controls="collapseSocial">
      <i class="fas fa-share-square"></i>
      <span>Native Social Items</span>
    </a>
    <div id="collapseNativeSocial" class="collapse <?= $active == 'nativesocial' ? 'show' : '' ?> " aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Native Social Media:</h6>
        <a class="collapse-item  <?= $active_sub == 'nativesocial_list' ? 'active' : '' ?>" href="../views/index.php?page=nativesocial">List Native Social</a>
      </div>
    </div>
  </li>
  <!-- Divider -->

  <li class="nav-item <?= $active == 'share' ? 'active' : '' ?>">
    <a class="nav-link" href="../views/index.php?page=share">
      <i class="fas fa-share-alt"></i>
      <span>Share Contnet</span></a>
  </li>

  <li class="nav-item  <?= $active == 'notification' ? 'active' : '' ?> ">
    <a class=" nav-link collapsed" href="#" data-toggle="collapse" data-target="#notification" aria-expanded="true" aria-controls="notification">
      <i class="fas fa-bell"></i>
      <span>Send notification</span>
    </a>
    <div id="notification" class="collapse <?= $active == 'notification' ? 'show' : '' ?> " aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Menu Items:</h6>
        <a class="collapse-item  <?= $active_sub == 'notification_list' ? 'active' : '' ?>" href="../views/index.php?page=notification">OneSignal Config</a>
        <a class="collapse-item  <?= $active_sub == 'notification_send' ? 'active' : '' ?>" href="../views/index.php?page=notification_send">Send notification</a>
        <a class="collapse-item  <?= $active_sub == 'notification_all' ? 'active' : '' ?>" href="../views/index.php?page=notification_all">List notification</a>
      </div>
    </div>
  </li>

  <!--
  <li class="nav-item <?= $active == 'update' ? 'active' : '' ?>">
    <a class="nav-link" href="../views/index.php?page=update">
      <i class="fas fa-fw fa-sync"></i>
      <span>Update version</span></a>
  </li>
  -->

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Profile
  </div>

  <!-- Nav Item - Logout -->
  <li class="nav-item <?= $active == 'profile' ? 'active' : '' ?>">
    <a class="nav-link" href="../views/index.php?page=profile">
      <i class="fas fa-user"></i>
      <span>Profile</span></a>
  </li>

  <!-- Nav Item - Logout -->
  <li class="nav-item">
    <a class="nav-link" href="../logout.php">
      <i class="fas fa-sign-out-alt"></i>
      <span>Logout</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>