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
$document->addStyleSheet($modPath.'assets/css/style5.css');

$modpath = JURI::root(true).'/modules/' . $module->module;
ImageHelper::setDefault($params);
?> 
<div id="tmln<?php echo $sliderid ?>">
<div class="main-timeline">
<?php  $i = 0;  foreach($list as $item){ $i++;
$last_class = ($i == count($list))?' last':'';
$img = MxTimeLineHelper::getAImage($item, $params);
?>

<div class="timeline">
<span class="timeline-icon"></span>
<?php if($params->get('item_date_display') == 1 ){?>
<span class="year"> <time datetime="<?php echo  $item->created; ?>"><?php echo  $item->created; ?></time> </span>
<?php }?>
<div class="timeline-content">
<div class="inner">
<?php if($params->get('title_display') == 1) {?>
<a href="<?php echo $item->link ?>" title="<?php echo $item->title; ?>" <?php echo MxTimeLineHelper::parseTarget($params->get('link_target')); ?>>
<h4 class="title"><?php echo MxTimeLineHelper::truncate($item->title, $params->get('item_title_max_characs',25)); ?>
</h4></a>
<?php }?><i><img src="<?php
echo MxTimeLineHelper::imageSrc($img);
?>" alt="<?php echo MxTimeLineHelper::truncate($item->title, $params->get('item_title_max_characs',25)); ?>"></i>
<?php if($params->get('item_desc_display') == 1) {?><div class="description mos-img"><?php echo MxTimeLineHelper::truncate($item->introtext, $params->get('item_desc_max_characs',200)); ?></div><?php }?>
<?php if($params->get('author_display')) { ?> <i class="fa fa-user"></i> <span> By <?php echo $item->author; ?> </span> <?php } ?>
<?php if($params->get('cat_title_display') == 1 ){?>
<span> <i class="fa fa-file"></i> <?php echo JText::_('Category: ');?> <a href="<?php echo $item->catlink; ?>" title="<?php echo $item->category_title; ?>" <?php echo MxTimeLineHelper::parseTarget($params->get('link_target')); ?> >
<?php echo $item->category_title; ?>
</a></span>
<?php } ?>
<?php if($params->get('item_readmore_display') == 1){?>
<a class="btn-link" href="<?php echo $item->link ?>" title="<?php echo $item->title; ?>" <?php echo MxTimeLineHelper::parseTarget($params->get('link_target')); ?>>
<i class="fa fa-arrow-right"></i>
</a>
<?php }?>
</div>
</div>
</div>

<?php } ?> 
</div>

</div>


