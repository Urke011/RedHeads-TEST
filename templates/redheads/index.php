<?php defined('_JEXEC') or die('Restricted access'); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/carousel/">
    <!-- Bootstrap core CSS -->
    <link href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/bootstrap.css"
          rel="stylesheet">
    <link href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/bootstrap-grid.min.css"
          rel="stylesheet">
    <link href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/bootstrap-reboot.css"
          rel="stylesheet">
    <!-- Favicons  REMOVED -->

    <meta name="theme-color" content="#7952b3">
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/custom.css" rel="stylesheet">
</head>
<body>
<!-- navbar position-->
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top border-bottom">
        <div class="container-fluid" style="align-items: end;">
            <a class="navbar-brand" href="<?php echo $this->baseurl; ?>">
                <img src="images/icons/headers/logo.png" height="57px" class="logoPic">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-flex justify-content-end menu_items" id="navbarNavDropdown">
                <?php if ($this->countModules('menu')) : ?>
                    <jdoc:include type="modules" name="menu"/>
                <?php endif; ?>
                <ul class="navbar-nav ">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            Unternehmensbereiche
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="#">Embedded </a></li>
                            <li><a class="dropdown-item" href="#">Web & Desktop </a></li>
                            <li><a class="dropdown-item" href="#">Data Science </a></li>
                            <li><a class="dropdown-item" href="#">Mobile</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<!-- end navbar position-->

<main>
    <article class="article_container">
    <!-- path to images
    <img src="<?php //echo $this->baseurl ?>/images/icons/headers/Gebude_2_1920x1280.jpg" alt="no pic">
    -->

    <!-- main position-->

    <jdoc:include type="component"/>
    <!--ZASTO KOMPONENTA-->
    <!-- end main position-->
    </article>
</main>

<!-- FOOTER -->
<jdoc:include type="modules" name="footer"/>
<!-- end of FOOTER -->

<script src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/jquery.js"></script>
<script src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/bootstrap.js"></script>

</body>
</html>
