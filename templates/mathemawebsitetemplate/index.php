<?php defined('_JEXEC') or die('Restricted access'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"
      xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>">
<head>
    <title><?php echo $this->getTitle(); ?></title>
    <meta name="description"
          content="<?php echo str_replace('  ', ' ', str_replace('>', ' ', str_replace('<', ' ', str_replace('"', ' ', $this->getDescription())))); ?>"/>
    <meta charset="utf-8">
    <script type="text/javascript">
        "use strict";//to use strict mode for all JS scripts by default
    </script>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="HandheldFriendly" content="true"/>
    <meta name="apple-mobile-web-app-capable" content="YES"/>
    <link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/favicon.ico" rel="shortcut icon"
          type="image/vnd.microsoft.icon"/>
    <!-- other styles first, than Bootstrap, then template.css, then invisible_styles.css -->
    <link rel="stylesheet"
          href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/bootstrap.css"
          type="text/css"/>
    <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/template.css"
          type="text/css"/>
    <link rel="stylesheet"
          href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/invisible_styles.css"
          type="text/css"/>
    <style>
        <
        jdoc:include type

        =
        "modules"
        name

        =
        "css_only"
        /
        >
    </style>
</head>

<?php
$app = JFactory::getApplication();
$menu = $app->getMenu()->getActive();
$pageclass = ''; // Notice how the variable is empty first. Then place the code below.

if (is_object($menu)) {
    $pageclass = $menu->params->get('pageclass_sfx');
}
?>

<body class="back-white body-class<?php echo trim($pageclass); ?>">
<header class="mathema">
    <nav id="main_menu_navigation" class="navbar leider-nicht-navbar-expand-md navbar-light fixed-top back-white"
         style="padding-left: var(--standard-block-padding) !important;padding-right: var(--standard-block-padding) !important;">
        <a class="navbar-brand" href="<?php echo JUri::base(); ?>"><img id="main-logo" border="0" height="53"
                                                                        src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/images/logo.svg"
                                                                        alt="Mathema" class="ml-0 mt-0 mb-0 p-0"></a>
        <button id="navbarToggler" class="navbar-toggler border-0" type="button" data-toggle="collapse"
                data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                aria-label="Toggle navigation">
            <img id="main-burger" border="0" height="25"
                 src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/images/burger.svg" alt="="
                 class="ml-0 mt-0 mb-0 p-0">
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
           <!-- <jdoc:include type="modules" name="main_menu"/> -->
        </div>
    </nav>
</header>
<main role="main" class="mathema-content fade-in">
  <jdoc:include type="modules" name="top"/>
     <jdoc:include type="component"/>
   <jdoc:include type="modules" name="bottom"/>
 </main>
 <footer class="mathema">
     <jdoc:include type="modules" name="footer"/>
 </footer>
 <!-- this variables first, than jQuery, than Popper.js, than Bootstrap JS, than our JS code in template.js -->
<script type="text/javascript">
    let rootUrl = "<?php echo rtrim($this->baseurl, '/'); ?>";
    let templateUrl = "<?php echo rtrim($this->baseurl, '/'); ?>/templates/<?php echo $this->template; ?>";
</script>
<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/jquery.slim.min.js"></script>
<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/popper.min.js"></script>
<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/bootstrap.min.js"></script>
<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/template.js"></script>
<script type="text/javascript">
    $(window).scroll(function () {
        let scrollNavigation = $(window).scrollTop();
        let heightLimit = screen.height * (7 / 8);
        if (scrollNavigation > 0) {
            $("#main_menu_navigation").addClass("shadow");
        } else {
            $("#main_menu_navigation").removeClass("shadow");
        }
        if (scrollNavigation > heightLimit) {
            $("#scroll-top").show();
        } else {
            $("#scroll-top").hide();
        }
    });

    function scroll2Top() {
        window.scrollTo(0, 0);
        return false;
    }

</script>


<div id="privacy_alert" style="border: 1px solid var(--user-darkline--color) !important;"
     class="border alert alert-light alert-dismissible fade text-center fixed-bottom m-0" role="alert">
    <strong>Unsere Webseite verwendet Cookies, um Ihnen die beste Benutzererfahrung zu bieten.
        <br><a href="<?php echo JUri::base(); ?>/datenschutz">Datenschutzerklärung anzeigen</a>
    </strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true" style="color: var(--user-blacktext--color);">&times;</span>
    </button>
</div>

<button href="#" focusable="false" tabIndex="-1" style="display: none;user-select: none;outline: none !important;"
        id="scroll-top" type="button" class="text-white btn btn-primary back-red" onclick="return scroll2Top();">
    <strong>&uarr;</strong></button>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true" style="display:none;">
    <div class="modal-dialog modal-lg" role="document" style="width:95%;max-width: 1200px;">
        <div class="modal-content">
            <div class="modal-body m-0 p-0">
                <div id="carouselExample" class="carousel slide" data-ride="carousel">
                    <div id='gallery-carousel' class="carousel-inner bg-dark">
                        <!--content-->
                    </div>
                    <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Matomo part. Other in JS file after loading-->
<script type="text/javascript">
    let _paq = window._paq || [];
    _paq.push(['trackPageView']);
    _paq.push(['enableLinkTracking']);
</script>
<!-- End Matomo Code. Other part in JS file after loading -->
</body>
</html>
