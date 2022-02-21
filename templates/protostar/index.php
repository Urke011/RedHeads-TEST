<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 *
 * @copyright   (C) 2012 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/** @var JDocumentHtml $this */

$app = JFactory::getApplication();
$user = JFactory::getUser();

// Output as HTML5
$this->setHtml5(true);

// Getting params from template
$params = $app->getTemplate(true)->params;

// Detecting Active Variables
$option = $app->input->getCmd('option', '');
$view = $app->input->getCmd('view', '');
$layout = $app->input->getCmd('layout', '');
$task = $app->input->getCmd('task', '');
$itemid = $app->input->getCmd('Itemid', '');
$sitename = htmlspecialchars($app->get('sitename'), ENT_QUOTES, 'UTF-8');

// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');

// Add template js
JHtml::_('script', 'template.js', array('version' => 'auto', 'relative' => true));

// Add html5 shiv
JHtml::_('script', 'jui/html5.js', array('version' => 'auto', 'relative' => true, 'conditional' => 'lt IE 9'));

// Add Stylesheets
JHtml::_('stylesheet', 'template.css', array('version' => 'auto', 'relative' => true));

// Use of Google Font
if ($this->params->get('googleFont')) {
    $font = $this->params->get('googleFontName');

    // Handle fonts with selected weights and styles, e.g. Source+Sans+Condensed:400,400i
    $fontStyle = str_replace('+', ' ', strstr($font, ':', true) ?: $font);

    JHtml::_('stylesheet', 'https://fonts.googleapis.com/css?family=' . $font);
    $this->addStyleDeclaration("
	h1, h2, h3, h4, h5, h6, .site-title {
		font-family: '" . $fontStyle . "', sans-serif;
	}");
}

// Template color
if ($this->params->get('templateColor')) {
    $this->addStyleDeclaration('
	body.site {
		border-top: 3px solid ' . $this->params->get('templateColor') . ';
		background-color: ' . $this->params->get('templateBackgroundColor') . ';
	}
	a {
		color: ' . $this->params->get('templateColor') . ';
	}
	.nav-list > .active > a,
	.nav-list > .active > a:hover,
	.dropdown-menu li > a:hover,
	.dropdown-menu .active > a,
	.dropdown-menu .active > a:hover,
	.nav-pills > .active > a,
	.nav-pills > .active > a:hover,
	.btn-primary {
		background: ' . $this->params->get('templateColor') . ';
	}');
}

// Check for a custom CSS file
JHtml::_('stylesheet', 'user.css', array('version' => 'auto', 'relative' => true));

// Check for a custom js file
JHtml::_('script', 'user.js', array('version' => 'auto', 'relative' => true));

// Load optional RTL Bootstrap CSS
JHtml::_('bootstrap.loadCss', false, $this->direction);

// Adjusting content width
$position7ModuleCount = $this->countModules('position-7');
$position8ModuleCount = $this->countModules('position-8');

if ($position7ModuleCount && $position8ModuleCount) {
    $span = 'span6';
} elseif ($position7ModuleCount && !$position8ModuleCount) {
    $span = 'span9';
} elseif (!$position7ModuleCount && $position8ModuleCount) {
    $span = 'span9';
} else {
    $span = 'span12';
}

// Logo file or site title param
if ($this->params->get('logoFile')) {
    $logo = '<img src="' . htmlspecialchars(JUri::root() . $this->params->get('logoFile'), ENT_QUOTES) . '" alt="' . $sitename . '" />';
} elseif ($this->params->get('sitetitle')) {
    $logo = '<span class="site-title" title="' . $sitename . '">' . htmlspecialchars($this->params->get('sitetitle'), ENT_COMPAT, 'UTF-8') . '</span>';
} else {
    $logo = '<span class="site-title" title="' . $sitename . '">' . $sitename . '</span>';
}
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet"
          href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/bootstrap.css"
          type="text/css"/>
    <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/template.css"
          type="text/css"/>
    <link rel="stylesheet"
          href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/invisible_styles.css"
          type="text/css"/>
    <jdoc:include type="head"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
</head>
<body class="site <?php echo $option
    . ' view-' . $view
    . ($layout ? ' layout-' . $layout : ' no-layout')
    . ($task ? ' task-' . $task : ' no-task')
    . ($itemid ? ' itemid-' . $itemid : '')
    . ($params->get('fluidContainer') ? ' fluid' : '')
    . ($this->direction === 'rtl' ? ' rtl' : '');
?>">

<!-- Body -->
<div class="body" id="top">
    <div class="container<?php echo($params->get('fluidContainer') ? '-fluid' : ''); ?>">
        <!-- Header -->
        <header class="header" role="banner">
            <div class="header-inner clearfix">
                <a class="brand pull-left" href="<?php echo $this->baseurl; ?>/">
                    <?php //echo $logo; ?>
                    <?php if ($this->params->get('sitedescription')) : ?>
                        <?php echo '<div class="site-description">' . htmlspecialchars($this->params->get('sitedescription'), ENT_COMPAT, 'UTF-8') . '</div>'; ?>
                    <?php endif; ?>
                </a>
                <div class="header-search pull-right">
                    <jdoc:include type="modules" name="position-0" style="none"/>
                </div>
            </div>
        </header>
        <!-- bootstrap NAVBAR -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top border-bottom">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="images/icons/headers/logo.png" height="57px" class="logoPic">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                        aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse d-flex justify-content-end rightNavLinks" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Aktuelles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Über Uns</a>
                        </li>
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
                        <li class="nav-item">
                            <a class="nav-link" href="#">Mitarbeiter</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Karriere </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Kontakt</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- END bootstrap NAVBAR -->
        <?php if ($this->countModules('position-1')) : ?>
            <nav class="navigation" role="navigation">
                <div class="navbar pull-left">
                    <a class="btn btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="element-invisible"><?php echo JTEXT::_('TPL_PROTOSTAR_TOGGLE_MENU'); ?></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                </div>
                <div class="nav-collapse">
                    <jdoc:include type="modules" name="position-1" style="none"/>
                </div>
            </nav>
        <?php endif; ?>
        <jdoc:include type="modules" name="banner" style="xhtml"/>
        <div class="row-fluid">
            <?php if ($position8ModuleCount) : ?>
                <!-- Begin Sidebar -->
                <div id="sidebar" class="span3">
                    <div class="sidebar-nav">
                        <jdoc:include type="modules" name="position-8" style="xhtml"/>
                    </div>
                </div>
                <!-- End Sidebar -->
            <?php endif; ?>
            <main id="content" role="main" class="<?php echo $span; ?>">
                <!-- Begin Content -->
                <jdoc:include type="modules" name="position-3" style="xhtml"/>
                <jdoc:include type="message"/>
                <jdoc:include type="component"/>
                <div class="clearfix"></div>
                <jdoc:include type="modules" name="position-2" style="none"/>

                <div class="first_main_content">
                    <div class="left_img">
                        <img src="images/icons/headers/beruns_2_1200x801.jpg" alt="">
                    </div>
                    <div class="left_img_text align-self-center">
                        <h3><span class="first_span_content">Fair</span> und <br>
                            anspruchsvoll. <br>
                             </h3>
                        <a href="">Wer wir sind</a>
                    </div>
                </div>
                <br>
                <br>
                <br>
                <div class="second_main_content">
                    <div class="right_img_text align-self-center">
                        <h3>Jeder <span class="first_span_content">findet</span> <br>seinen Platz. <br>
                             </h3>
                        <a href="">Wen wir suchen </a>
                    </div>
                    <div class="right_img">
                        <img src="images/icons/headers/Karriere_1_1200x801.jpg" alt="">
                    </div>
                </div>
                <br>
                <br>
                <br>
                <h2 class="unsere_kunden">Was unsere <span class="first_span_content">Kunden</span> sagen</h2>
                <br>
                <br>
                <br>
                <!-- unsere kunden-->
                <div class="first_column">
                <div class="unsere_kunden_content ">
                <div class="card">
                    <img src="images/kunden/logo_bikedress.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">
                            "So wie mit der Firma Redheads stelle ich mir die Zusammenarbeit mit einem Softwaredienstleister vor: professionell, termintreu und absolut kundengerecht."
                            Heiko Wild, Inhaber Bikedress
                        </p>
                    </div>
                </div>
                    <div class="card">
                        <img src="images/kunden/Siemens-Healthineers.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">
                                "Durch die stets lösungsorientierte Beratung sowie dem Verständnis für unsere Prozesse, konnte Redheads gemeinsam mit unseren Kollegen bei der Anforderungsanalyse, Konzeptionierung und auch der Realisierung unseres Software-​Tools optimale Lösungen erarbeiten. Vielen Dank für die angenehme Zusammenarbeit!"
                                Waltraud Zimmermann, Head of Exhibition-, Event-, Travel-Management Siemens AG, Healthcare Sector
                            </p>
                        </div>
                    </div>
                </div>
                    <div class="card">
                        <img src="images/kunden/feedbit-batch.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">
                                "Hohe Kompetenz gepaart mit Zuverlässigkeit, das zeichnet die Firma Redheads aus. Wir bedanken uns für die exzellente und vertrauensvolle Zusammenarbeit."

                                Dr. Colin Roth, Geschäftsführer Feedbit Software GmbH
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <img src="images/kunden/Witron_sw_klein.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">
                            "Redheads hat die App hervorragend auf unsere Bedürfnisse zugeschnitten und hatte während des gesamten Projekts die Interessen unseres Unternehmens immer im Blick. Vielen Dank für die unkomplizierte Zusammenarbeit."

                            Dominik Simbeck, Leiter Competence-Center Basis Projekt Support WITRON Logistik + Informatik GmbH
                        </p>
                    </div>
                </div>
        </div>
        <div class="card">
            <img src="images/kunden/Wittenstein-Logo.png" class="card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text">
                    "Die Zusammenarbeit mit Redheads war auf allen Ebenen gelungen. Sowohl das Redheads-​Team als auch wir profitierten vom gegenseitigen Erfahrungsaustausch, sodass die Einführung einer neuen Technologie innerhalb der Termin-​ und Budgetvorgaben gelang. Die Kooperation war von einem hohen Maß an Fachwissen sowie gegenseitigem Vertrauen geprägt. Wir freuen uns auf weitere gemeinsame Projekte."
                    Patrick Hantschel Wittenstein SE
                </p>
            </div>
        </div>
        <div class="card">
            <img src="images/kunden/TUEV-Rheinland.png" class="card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text">
                    "Von der Anforderungsaufnahme über Implementierung bis Deployment und Support, vielen Dank für die optimale Realisierung unserer Software."
                    Thomas Struller, IT-Beauftragter - Institut für Umweltgeologie und Altlasten GmbH TÜV Rheinland, LGA
                </p>
            </div>
        </div>
    </div>
                </div>
                <!-- End Content -->
            </main>
            <?php if ($position7ModuleCount) : ?>
                <div id="aside" class="span3">
                    <!-- Begin Right Sidebar -->
                    <jdoc:include type="modules" name="position-7" style="well"/>
                    <!-- End Right Sidebar -->
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- Footer -->
<footer class="footer" role="contentinfo">
    <div class="container<?php echo($params->get('fluidContainer') ? '-fluid' : ''); ?>">
        <!--	<hr /> -->
        <jdoc:include type="modules" name="footer" style="none"/>
        <p class="pull-right">
            <a href="#top" id="back-top">
                <?php //echo JText::_('TPL_PROTOSTAR_BACKTOTOP'); ?>
            </a>
        </p>
        <p>
            <!-- &copy; --><?php //echo date('Y'); ?> <?php //echo $sitename; ?>
        </p>
    </div>
</footer>
<jdoc:include type="modules" name="debug" style="none"/>
<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/jquery.slim.min.js"></script>
<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/popper.min.js"></script>
<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/bootstrap.min.js"></script>
<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/template.js"></script>
</body>
</html>
