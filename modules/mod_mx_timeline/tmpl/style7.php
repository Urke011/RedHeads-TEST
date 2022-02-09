<?php
/**
* @package Mx timeline
* @version 4.0.0
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
* @copyright (c) 2012 Mixwebtemplates. All Rights Reserved.
* @author Mixwebtemplates http://www.mixwebtemplates.com
*
*/
defined('_JEXEC') or die;
$cacheFolder = JURI::base(true).'/cache/';
$modID = $module->id;
$modPath = JURI::base(true).'/modules/mod_mx_timeline/';
$document = JFactory::getDocument(); 
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

$document->addStyleSheet($modPath.'assets/css/style7.css');

if(!empty($list)){
$uniquied = 'td_timeline_'.time().rand();
ImageHelper::setDefault($params);
?>
<div id="<?php echo $uniquied?>" class="tml">
<ul class="timeline">
<?php  $i = 0;  foreach($list as $item){ $i++;
$last_class = ($i == count($list))?' last':'';
$img = MxTimeLineHelper::getAImage($item, $params);
?>
<li>
<div class="icon"><img src="<?php
echo MxTimeLineHelper::imageSrc($img);
?>" alt="<?php echo MxTimeLineHelper::truncate($item->title, $params->get('item_title_max_characs',25)); ?>"></div>
<div class="animation-chain overflow-hidden" data-animation="fadeInLeft">

<?php if($params->get('title_display') == 1) {?>
<h3><a href="<?php echo $item->link ?>" title="<?php echo $item->title; ?>" <?php echo MxTimeLineHelper::parseTarget($params->get('link_target')); ?>>
<?php echo MxTimeLineHelper::truncate($item->title, $params->get('item_title_max_characs',25)); ?>
</a>
</h3>
<?php }?>

<?php if($params->get('cat_title_display') == 1 ){?>
<h4><?php echo JText::_('Category: ');?> <a href="<?php echo $item->catlink; ?>" title="<?php echo $item->category_title; ?>" <?php echo MxTimeLineHelper::parseTarget($params->get('link_target')); ?> >
<?php echo $item->category_title; ?>
</a></h4>
<?php } ?>

<?php if($params->get('item_date_display') == 1 ){?>
<div class="date animated" style="animation-delay: 0.2s;"><time datetime="<?php echo  $item->created; ?>"><?php echo  $item->created; ?></time> </div>	
<?php }?>
</div>

<?php if($params->get('item_desc_display') == 1) {?><div class="mos-img"><?php echo MxTimeLineHelper::truncate($item->introtext, $params->get('item_desc_max_characs',200)); ?></div><?php }?>

<?php if($params->get('item_readmore_display') == 1){?>
<a href="<?php echo $item->link ?>" title="<?php echo $item->title; ?>" <?php echo MxTimeLineHelper::parseTarget($params->get('link_target')); ?>>
<div class="btn btn-primary">
<?php echo $params->get('item_readmore_text'); ?>
</div>
</a>
<?php }?>

</li>

<?php } ?>

</ul>
</div>
<?php 
}else{
echo JText::_('Has no content to show!');	
}?>