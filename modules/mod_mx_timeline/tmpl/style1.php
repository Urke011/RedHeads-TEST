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
$document->addStyleSheet($modPath.'assets/css/style1.css');

$modpath = JURI::root(true).'/modules/' . $module->module;
ImageHelper::setDefault($params);
?> 
<div id="tmln<?php echo $sliderid ?>">
<div class="timeline">
<?php  $i = 0;  foreach($list as $item){ $i++;
$last_class = ($i == count($list))?' last':'';
$img = MxTimeLineHelper::getAImage($item, $params);
?>
<div class="property-preview">
<a class="property-preview__img" href="<?php echo $item->link; ?>">
<img class="js-object-fit" src="<?php
echo MxTimeLineHelper::imageSrc($img);
?>" alt="<?php echo MxTimeLineHelper::truncate($item->title, $params->get('item_title_max_characs',25)); ?>">
<div class="property-preview__img-txt">
<?php if($params->get('author_display')== 1): ?>
<p class="property-preview__subtitle" ><i class="fa fa-user"></i> By <?php echo $item->author; ?></p>
<?php endif; ?>
<?php if($params->get('item_date_display') == 1 ){?>
<h4 class="property-preview__title"><i class="fa fa-calendar"></i> <time datetime="<?php echo  $item->created; ?>"><?php echo  $item->created; ?></time> </h4>	
<?php }?>

</div>
</a>
<div class="property-preview__txt">
<div class="property-preview__padding">
<?php if($params->get('cat_title_display') == 1 ){?>
<span class="featured-project-category"><?php echo JText::_('Category: ');?> <a href="<?php echo $item->catlink; ?>" title="<?php echo $item->category_title; ?>" <?php echo MxTimeLineHelper::parseTarget($params->get('link_target')); ?> >
<?php echo $item->category_title; ?>
</a></span>
<?php } ?>
<?php if($params->get('title_display') == 1) {?>
<h2><a href="<?php echo $item->link ?>" title="<?php echo $item->title; ?>" <?php echo MxTimeLineHelper::parseTarget($params->get('link_target')); ?>>
<?php echo MxTimeLineHelper::truncate($item->title, $params->get('item_title_max_characs',25)); ?>
</h2>
<?php }?>
<?php if($params->get('item_desc_display') == 1) {?><div class="mos-img"><?php echo MxTimeLineHelper::truncate($item->introtext, $params->get('item_desc_max_characs',200)); ?></div><?php }?>
<div class="property-preview__txt-lower">
<?php if($params->get('item_readmore_display') == 1){?>
<a class="custom-button" href="<?php echo $item->link ?>" title="<?php echo $item->title; ?>" <?php echo MxTimeLineHelper::parseTarget($params->get('link_target')); ?>>
<?php echo $params->get('item_readmore_text'); ?>
</a>
<?php }?>
</div>
</div>
</div>
</div>
<?php } ?>
</div>
</div>
