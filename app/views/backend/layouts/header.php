<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $data['title']; ?></title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= Routes::base('img/logo/logoAdmin.png') ?>">

    <!-- Library / Plugin Css Build -->
    <link rel="stylesheet" href="<?= Routes::public('assets/css/core/libs.min.css') ?>">

    <!-- Hope Ui Design System Css -->
    <link rel="stylesheet" href="<?= Routes::public('assets/css/hope-ui.min.css?v=4.0.0') ?>">

    <!-- Custom Css -->
    <link rel="stylesheet" href="<?= Routes::public('assets/css/custom.min.css?v=4.0.0') ?>">

    <!-- Dark Css -->
    <link rel="stylesheet" href="<?= Routes::public('assets/css/dark.min.css') ?>">

    <!-- Customizer Css -->
    <link rel="stylesheet" href="<?= Routes::public('assets/css/customizer.min.css') ?>">

    <!-- RTL Css -->
    <link rel="stylesheet" href="<?= Routes::public('assets/css/rtl.min.css') ?>">

    <!-- Flatpickr css -->
    <link rel="stylesheet" href="<?= Routes::public('assets/vendor/flatpickr/dist/flatpickr.min.css') ?>">

    <!-- App CSS -->
    <link rel="stylesheet" href="<?= Routes::public('css/app.css') ?>">


    <!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || []; w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            }); var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src =
                    'https://www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-WNGH9RL'); window.tag_manager_event = 'dashboard-free-preview'; window.tag_manager_product = 'HopeUI';</script>
    <!-- End Google Tag Manager -->
</head>

<body class="uikit " data-bs-spy="scroll" data-bs-target="#elements-section" data-bs-offset="0" tabindex="0">