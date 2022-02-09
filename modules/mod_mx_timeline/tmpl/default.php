<?php
/**
* @title			Timeline
* @version   		4.0.2
* @copyright   		Copyright (C) 2019 mixwebtemplates.com, All rights reserved.
* @license   		GNU General Public License version 3 or later.
* @author url   	http://www.mixwebtemplates.com/
* @developers   	mixwebtemplates.com
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

$cacheFolder = JURI::base(true).'/cache/';
$modID = $module->id;
$modPath = JURI::base(true).'/modules/mod_mx_timeline/';
$document = JFactory::getDocument(); 
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
$jqueryload = $params->get('jqueryload');
$customone = $params->get('customone');
$hgstyle = $params->get('hgstyle');
$customstyle = $params->get('customstyle');
$bgm_color = $params->get('bgm_color');
$btx_color = $params->get('btx_color');
$sliderid = $params->get('sliderid');
$borderradius = $params->get('borderradius');
$item_shares = $params->get('item_shares');
$get_fonto = $params->get('get_fonto');
// Define parameters
$module_id = $module->id;
if ($params->get('auto_module_id')) {
$sliderid = 'mxtml'.$module->id;
} else {
$sliderid = $params->get('custom_module_id'); 
}

if($get_fonto) $document->addStyleSheet($modPath.'assets/font-awesome.css');
$document->addStyleSheet($modPath.'assets/css/style.css');

if($bgm_color) $document->addStyleDeclaration('#tmln' . $sliderid . ' .timeline .note:hover .note-inner{color: ' . $btx_color . '; border-color: ' . $bgm_color . '; background-color: ' . $bgm_color . ';}#tmln' . $sliderid . ' .timeline .note:hover .note-date, #tmln' . $sliderid . ' a {color: ' . $btx_color . ';} #tmln' . $sliderid . ' .timeline .note:hover .note-inner:before,.timeline .note:hover .note-inner:after{ background: ' . $bgm_color . ';}'); 

ImageHelper::setDefault($params);
?> 
<div id="tmln<?php echo $sliderid ?>">
<section id="history" class="history">
<div class="section-inner">
<div class="timeline clearfix visible" style="height: auto;">
<div class="note-keeper">
<span class="date"></span>
<?php  $i = 0;  foreach($list as $item){ $i++;
$last_class = ($i == count($list))?' last':'';
$img = MxTimeLineHelper::getAImage($item, $params);
?>

<div class="note">
<!-- Note Details -->
<div class="note-inner">
<div class="note-image">
<img src="<?php
echo MxTimeLineHelper::imageSrc($img);
?>" alt="<?php echo MxTimeLineHelper::truncate($item->title, $params->get('item_title_max_characs',25)); ?>">
</div>
<!-- Note Texts -->
<div class="note-texts">
<!-- Note Date -->
<p class="note-date"><?php if($params->get('author_display')) { ?><i class="fa fa-user"></i> By <?php echo $item->author; ?><?php } ?><?php if($params->get('item_date_display') == 1 ){?><time datetime="<?php echo  $item->created; ?>"><?php echo  $item->created; ?></time><?php }?> </p>		

<!-- Note Title -->
<?php if($params->get('title_display') == 1) {?>
<h4><a href="<?php echo $item->link ?>" title="<?php echo $item->title; ?>" <?php echo MxTimeLineHelper::parseTarget($params->get('link_target')); ?>>
<?php echo MxTimeLineHelper::truncate($item->title, $params->get('item_title_max_characs',25)); ?>
</a>
</h4>
<?php }?>
<!-- Note Desc -->
<?php if($params->get('item_desc_display') == 1) {?><div class="note-desc mos-img"><?php echo MxTimeLineHelper::truncate($item->introtext, $params->get('item_desc_max_characs',200)); ?></div><?php }?>

<?php if($params->get('cat_title_display') == 1 ){?>
<p><i class="fa fa-file"></i> <?php echo JText::_('Category: ');?><a href="<?php echo $item->catlink; ?>" title="<?php echo $item->category_title; ?>" <?php echo MxTimeLineHelper::parseTarget($params->get('link_target')); ?> >
<?php echo $item->category_title; ?>
</a>
</p>
<?php } ?>
<!-- Note Button-->
<?php if($params->get('item_readmore_display') == 1){?>
<div class="note-butt">
<a href="<?php echo $item->link ?>" title="<?php echo $item->title; ?>" <?php echo MxTimeLineHelper::parseTarget($params->get('link_target')); ?>>
<div class="note-button"> <i class="fa fa-arrow-right"></i></div>
</a>
</div>
<?php }?>
</div>
<!-- End Note Texts -->
</div>
<!-- End Note Details -->
</div>

<?php } ?> 
</div>
</div>
</div>
</section>
</div>





