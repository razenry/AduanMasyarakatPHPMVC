<?php

$user = $data['user'];
$title = $data['title'];
$email = $user['email'];
$level = $user['level'];
?>

<aside class="sidebar sidebar-default sidebar-white sidebar-base navs-rounded-all ">
    <div class="sidebar-header d-flex align-items-center justify-content-start">
        <a href="<?= Routes::base("admin/index") ?>" class="navbar-brand">

            <!--Logo start-->
            <div class="logo-main">
                <div class="logo-normal">
                    <i class="fa-solid fa-envelope icon-30 fs-1"></i>

                </div>
                <div class="logo-mini">
                    <!-- <svg class=" icon-30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2"
                            transform="rotate(-45 -0.757324 19.2427)" fill="currentColor" />
                        <rect x="7.72803" y="27.728" width="28" height="4" rx="2" transform="rotate(-45 7.72803 27.728)"
                            fill="currentColor" />
                        <rect x="10.5366" y="16.3945" width="16" height="4" rx="2"
                            transform="rotate(45 10.5366 16.3945)" fill="currentColor" />
                        <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2"
                            transform="rotate(45 10.5562 -0.556152)" fill="currentColor" />
                    </svg> -->
                </div>
            </div>
            <!--logo End-->
            <h4 class="logo-title fw-bold">
                Warga<span class="text-danger fw-bold">Lapor!</span>
            </h4>
        </a>
        <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
            <i class="icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.25 12.2744L19.25 12.2744" stroke="currentColor" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M10.2998 18.2988L4.2498 12.2748L10.2998 6.24976" stroke="currentColor" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </i>
        </div>

    </div>
    <div class="sidebar-body pt-0 data-scrollbar">
        <div class="sidebar-list">
            <!-- Sidebar Menu Start -->
            <ul class="navbar-nav iq-main-menu" id="sidebar-menu">
                <li class="nav-item static-item">
                    <a class="nav-link static-item disabled" href="<?= Routes::base("admin") ?>" tabindex="-1">
                        <span class="default-icon">Home</span>
                        <span class="mini-icon">-</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if (isset($data['title']) && $data['title'] === "Dashboard") echo "active"; ?>" aria-current="page" href="<?= Routes::base("admin") ?>">
                        <i class="icon">
                            <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                class="icon-20">
                                <path opacity="0.4"
                                    d="M16.0756 2H19.4616C20.8639 2 22.0001 3.14585 22.0001 4.55996V7.97452C22.0001 9.38864 20.8639 10.5345 19.4616 10.5345H16.0756C14.6734 10.5345 13.5371 9.38864 13.5371 7.97452V4.55996C13.5371 3.14585 14.6734 2 16.0756 2Z"
                                    fill="currentColor"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M4.53852 2H7.92449C9.32676 2 10.463 3.14585 10.463 4.55996V7.97452C10.463 9.38864 9.32676 10.5345 7.92449 10.5345H4.53852C3.13626 10.5345 2 9.38864 2 7.97452V4.55996C2 3.14585 3.13626 2 4.53852 2ZM4.53852 13.4655H7.92449C9.32676 13.4655 10.463 14.6114 10.463 16.0255V19.44C10.463 20.8532 9.32676 22 7.92449 22H4.53852C3.13626 22 2 20.8532 2 19.44V16.0255C2 14.6114 3.13626 13.4655 4.53852 13.4655ZM19.4615 13.4655H16.0755C14.6732 13.4655 13.537 14.6114 13.537 16.0255V19.44C13.537 20.8532 14.6732 22 16.0755 22H19.4615C20.8637 22 22 20.8532 22 19.44V16.0255C22 14.6114 20.8637 13.4655 19.4615 13.4655Z"
                                    fill="currentColor"></path>
                            </svg>
                        </i>
                        <span class="item-name">Dashboard</span>
                    </a>
                </li>
                <!-- <li class="nav-item static-item mt-3">
                    <a class="nav-link static-item disabled" href="#" tabindex="-1">
                        <span class="default-icon"></span>
                        <span class="mini-icon">-</span>
                    </a>
                </li> -->
                <?php if ($level == "Admin") : ?>
                    <li class="nav-item mt-3">
                        <a class="nav-link " data-bs-toggle="collapse" href="#user" role="button" aria-expanded="false" aria-controls="horizontal-menu">
                            <i class="icon fa-sharp fa-solid fa-database"></i>
                            <span class="item-name">Master Data </span>
                            <i class="right-icon">
                                <svg class="icon-18" xmlns="http://www.w3.org/2000/svg" width="18" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </i>
                        </a>
                        <ul class="sub-nav collapse mt-1" id="user" data-bs-parent="#sidebar-menu">
                            <li class="nav-item mt-2">
                                <a class="nav-link <?php if (isset($data['title']) && $data['title'] === "Pengguna") echo "active"; ?>" href="<?= Routes::base("user") ?>">
                                    <i class="icon fa-duotone fa-solid fa-users"></i>
                                    <i class="sidenav-mini-icon fa-duotone fa-solid fa-users"></i>
                                    <span class="item-name"> Pengguna </span>
                                </a>
                            </li>
                            <li class="nav-item mt-2">
                                <a class="nav-link <?php if (isset($data['title']) && $data['title'] === "Petugas") echo "active"; ?>" href="<?= Routes::base("petugas") ?>">
                                    <i class="icon fa-solid fa-user-tie"></i>
                                    <i class="sidenav-mini-icon fa-solid fa-user-tie"></i>
                                    <span class="item-name"> Petugas </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

                <li class="nav-item mt-3">
                    <a class="nav-link <?php if (isset($data['title']) && $data['title'] === "Laporan") echo "active"; ?>" aria-current="page" href="<?= Routes::base("dataLaporan") ?>">
                        <i class="icon fa-solid fa-message"></i>
                        <span class="item-name">Laporan</span>
                    </a>
                </li>
            </ul>
            <!-- Sidebar Menu End -->
        </div>
    </div>
    <div class="sidebar-footer"></div>
</aside>
<main class="main-content ">
    <div class="position-relative iq-banner">
        <!--Nav Start-->
        <nav class="nav navbar navbar-expand-lg navbar-light iq-navbar">
            <div class="container-fluid navbar-inner">
                <a href="<?= Routes::base("admin/index") ?>" class="navbar-brand">

                    <!--Logo start-->
                    <div class="logo-main">
                        <div class="logo-normal">
                            <i class="fa-solid fa-envelope icon-30 fs-1 text-primary"></i>
                        </div>
                        <div class="logo-mini">
                            <i class="fa-solid fa-envelope icon-30 fs-1"></i>
                        </div>
                    </div>
                    <!--logo End-->




                    <h4 class="logo-title">
                        Warga<span class="text-danger fw-bold">Lapor!</span>
                    </h4>
                </a>
                <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
                    <i class="icon">
                        <svg width="20px" class="icon-20" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z" />
                        </svg>
                    </i>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <span class="mt-2 navbar-toggler-bar bar1"></span>
                        <span class="navbar-toggler-bar bar2"></span>
                        <span class="navbar-toggler-bar bar3"></span>
                    </span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="mb-2 navbar-nav ms-auto align-items-center navbar-list mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="py-0 nav-link d-flex align-items-center" href="" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="<?= Routes::public('assets/images/avatars/01.png') ?>" alt="User-Profile"
                                    class="theme-color-default-img img-fluid avatar avatar-50 avatar-rounded">
                                <img src="<?= Routes::public('assets/images/avatars/avtar_1.png') ?>" alt="User-Profile"
                                    class="theme-color-purple-img img-fluid avatar avatar-50 avatar-rounded">
                                <img src="<?= Routes::public('assets/images/avatars/avtar_2.png') ?>" alt="User-Profile"
                                    class="theme-color-blue-img img-fluid avatar avatar-50 avatar-rounded">
                                <img src="<?= Routes::public('assets/images/avatars/avtar_4.png') ?>" alt="User-Profile"
                                    class="theme-color-green-img img-fluid avatar avatar-50 avatar-rounded">
                                <img src="<?= Routes::public('assets/images/avatars/avtar_5.png') ?>" alt="User-Profile"
                                    class="theme-color-yellow-img img-fluid avatar avatar-50 avatar-rounded">
                                <img src="<?= Routes::public('assets/images/avatars/avtar_3.png') ?>" alt="User-Profile"
                                    class="theme-color-pink-img img-fluid avatar avatar-50 avatar-rounded">
                                <div class="caption ms-3 d-none d-md-block ">
                                    <h6 class="mb-0 caption-title"><?= $email ?></h6>
                                    <p class="mb-0 caption-sub-title"><?= $level ?></p>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="<?= Routes::base('admin/profile') ?>">Profile</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a id="logoutButton" class="dropdown-item">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav> <!-- Nav Header Component Start -->
        <!-- <div class="iq-navbar-header">
            <div class="container iq-container">
                
            </div>
        </div> Nav Header Component End 
        Nav End-->
        <div class="iq-navbar-header mb-3">
            <div class="iq-navbar-header">
                <div class="container iq-container">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <?php foreach ($data['breadcrumb'] as $name => $link) : ?>
                                        <?php if (is_array($link)) : ?>
                                            <li class="breadcrumb-item <?= $link['status'] == 'active' ? 'active' : '' ?>" aria-current="page">
                                                <?php if ($link['status'] !== 'active') : ?>
                                                    <a href="<?= Routes::base($link['link']) ?>"><?= $name ?></a>
                                                <?php else : ?>
                                                    <?= $name ?>
                                                <?php endif; ?>
                                            </li>
                                        <?php else : ?>
                                            <li class="breadcrumb-item <?= empty($link) ? 'active' : 'text-dark' ?>" <?= empty($link) ? 'aria-current="page"' : '' ?>>
                                                <?php if (!empty($link)) : ?>
                                                    <a href="<?= Routes::base($link) ?>"><?= $name ?></a>
                                                <?php else : ?>
                                                    <?= $name ?>
                                                <?php endif; ?>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>