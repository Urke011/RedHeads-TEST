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
$sliderid = $params->get('sliderid');
$borderradius = $params->get('borderradius');
$get_fonto = $params->get('get_fonto');
// Define parameters
$module_id = $module->id;
if ($params->get('auto_module_id')) {
$sliderid = 'olk2sl'.$module->id;
} else {
$sliderid = $params->get('custom_module_id'); 
}

if($get_fonto) $document->addStyleSheet($modPath.'assets/font-awesome.css');
$document->addStyleSheet($modPath.'assets/css/style6.css');

if($bgm_color) $document->addStyleDeclaration('#tmln' . $sliderid . ' .timeline .item:after, #tmln' . $sliderid . ' .timeline .item-social-icons, #tmln' . $sliderid . ' .timeline .btn-box a{ background-color: ' . $bgm_color . ' !important;}#tmln' . $sliderid . ' .timeline .job-meta .title { color: ' . $bgm_color . ' !important;}#tmln' . $sliderid . ' .timeline .item::before, #tmln' . $sliderid . ' .timeline {border-color: ' . $bgm_color . ';} '); 

$modpath = JURI::root(true).'/modules/' . $module->module;
ImageHelper::setDefault($params);
?> 
<div id="tmln<?php echo $sliderid ?>">
<div class="timeline">

<?php  $i = 0;  foreach($list as $item){ $i++;
$last_class = ($i == count($list))?' last':'';
$img = MxTimeLineHelper::getAImage($item, $params);
?>
<div class="item">
<div class="work-place">

<?php if($params->get('title_display') == 1) {?>
<div class="place"><a href="<?php echo $item->link ?>" title="<?php echo $item->title; ?>" <?php echo MxTimeLineHelper::parseTarget($params->get('link_target')); ?>>
<?php echo MxTimeLineHelper::truncate($item->title, $params->get('item_title_max_characs',25)); ?>
</a>
</div>
<?php if($params->get('author_display')) { ?><div class="location"> by <?php echo $item->author; ?></div><?php } ?> 
<?php }?>
</div>
<div class="job-meta">
<?php if($params->get('cat_title_display') == 1 ){?>
<div class="title"><?php echo JText::_('Category: ');?> <a href="<?php echo $item->catlink; ?>" title="<?php echo $item->category_title; ?>" <?php echo MxTimeLineHelper::parseTarget($params->get('link_target')); ?> >
<?php echo $item->category_title; ?>
</a></div>
<?php } ?> 	
<?php if($params->get('item_date_display') == 1 ){?>
<div class="time"><time datetime="<?php echo  $item->created; ?>"><?php echo  $item->created; ?></time> </div>	
<?php }?>
</div><!--//job-meta-->
<div class="job-desc">
<div class="note-image">
<img src="<?php
echo MxTimeLineHelper::imageSrc($img);
?>" alt="<?php echo MxTimeLineHelper::truncate($item->title, $params->get('item_title_max_characs',25)); ?>">
</div>
<?php if($params->get('item_desc_display') == 1) {?><div class="note-desc mos-img"><?php echo MxTimeLineHelper::truncate($item->introtext, $params->get('item_desc_max_characs',200)); ?></div><?php }?>                   
<?php if($params->get('item_readmore_display') == 1){?>
<div class="btn-box">
<a class="theme-btn" href="<?php echo $item->link ?>" title="<?php echo $item->title; ?>" <?php echo MxTimeLineHelper::parseTarget($params->get('link_target')); ?>>
<?php echo $params->get('item_readmore_text'); ?>
</a>
</div>
<?php }?>
</div><!--//job-desc-->
</div>

<div class="clearfix"></div>

<?php } ?>
</div>

</div>

<?php if($params->get('item_shares')== 1): ?> 
<script src="<?php echo $modPath ?>assets/js/social.js" type="text/javascript"></script>
<?php endif; ?>
