<?php
/**
* @version		2.0
* @package		DJ Classifieds
* @subpackage	DJ Classifieds Component
* @copyright	Copyright (C) 2010 DJ-Extensions.com LTD, All rights reserved.
* @license		http://www.gnu.org/licenses GNU/GPL
* @autor url    http://design-joomla.eu
* @autor email  contact@design-joomla.eu
* @Developer    Lukasz Ciastek - lukasz.ciastek@design-joomla.eu
* 
* 
* DJ Classifieds is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*
* DJ Classifieds is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with DJ Classifieds. If not, see <http://www.gnu.org/licenses/>.
* 
*/
defined ('_JEXEC') or die('Restricted access');

//jimport('joomla.media.images');
JHTML::_('behavior.framework','More');
JHTML::_('behavior.keepalive');
JHTML::_('behavior.formvalidation');
JHTML::_('behavior.modal');
JHTML::_('behavior.calendar');
$toolTipArray = array('className'=>'djcf_label');
JHTML::_('behavior.tooltip', '.Tips1', $toolTipArray);


$par 	    = $this->par;
$app 	    = JFactory::getApplication();
$imglimit   = $par->get('img_limit','3');
$unit_price = $par->get('unit_price','');	
$id 		= JRequest::getVar('id', 0, '', 'int' );
$user 		= JFactory::getUser();

$mod_attribs=array();
$mod_attribs['style'] = 'xhtml';

$document= JFactory::getDocument();
$config = JFactory::getConfig();
DJClassifiedsTheme::includeMapsScript();			

/*if($par->get('region_add_type','1')==1){
	$document->addScript("http://maps.google.com/maps/api/js?sensor=false&language=".$par->get('region_lang','en'));
	$assets=JURI::base(true).'/components/com_djclassifieds/assets/';	
	$document->addScript($assets.'scripts.js');	
}*/
$points_a = $par->get('points',0);
if($points_a){	
	$menus	= $app->getMenu('site');
	$menu_ppackages_itemid = $menus->getItems('link','index.php?option=com_djclassifieds&view=points',1);
	$user_ppoints_link='index.php?option=com_djclassifieds&view=points';
	if($menu_ppackages_itemid){
		$user_ppoints_link .= '&Itemid='.$menu_ppackages_itemid->id;
	}
}

$map_styles = $par->get('gm_styles','');
if (trim($map_styles) == '') {
	$map_styles = '[]';
}

$token = JRequest::getCMD('token', '' );
?>
	<div id="dj-classifieds" class="clearfix djcftheme-<?php echo $par->get('theme','default');?>">

		<?php 
		$modules_djcf = &JModuleHelper::getModules('djcf-top');			
		if(count($modules_djcf)>0){
			echo '<div class="djcf-ad-top clearfix">';
			foreach (array_keys($modules_djcf) as $m){
				echo JModuleHelper::renderModule($modules_djcf[$m],$mod_attribs);
			}
			echo'</div>';		
		}		
	
		$modules_djcf = &JModuleHelper::getModules('djcf-additem-top');			
		if(count($modules_djcf)>0){
			echo '<div class="djcf-ad-items-top clearfix">';
			foreach (array_keys($modules_djcf) as $m){
				echo JModuleHelper::renderModule($modules_djcf[$m],$mod_attribs);
			}
			echo'</div>';		
		}	

	?>

		<div class="dj-additem_custome">
			<form action="index.php" method="post" class="form-validate" name="djForm" id="djForm" enctype="multipart/form-data">
				<div class="additem_djform">
					<div class="additem-screen">
						<div class="form-group">
							<label for="name">
								<?php echo JText::_('COM_DJCLASSIFIEDS_TITLE');?>
							</label>
							<?php

						$title_char_limit = $par->get('title_char_limit','0'); 

						if($title_char_limit>0){

							$input_title_limit =' onkeyup="titleLimit('.$title_char_limit.');" ';

						}else{

							$input_title_limit ='';

						} 
						?>
								<input class="form-control inputbox required" <?php echo $input_title_limit; ?> type="text" name="name" id="name" size="50" maxlength="250" value="
								<?php echo $this->item->name; ?>" />
						</div>
						<div class="form-group">
							<label for="cat_0"><?php echo JText::_('COM_DJCLASSIFIEDS_CATEGORY'); ?></label>
							<?php

							$cat_sel = '<select autocomplete="off" class="cat_sel required validate-djcat" id="cat_0" style="width:210px" name="cats[]" onchange="new_cat(0,this.value,new Array());getFields(this.value,false);"><option value="">'.JText::_('COM_DJCLASSIFIEDS_PLEASE_SELECT_CATEGORY').'</option>';

							$parent_id=0;	

							foreach($this->cats as $l){

								if($parent_id!=$l->parent_id){

									break;

								}	

								if($l->price>0 || ($l->points>0 && $points_a)){

									$l->price = $l->price/100;												

									$l->name .= ' (';

										if($points_a!=2){

											$l->name .=DJClassifiedsTheme::priceFormat($l->price,$unit_price);

										}							

										if($l->points>0 && $points_a){

											if($points_a!=2){

												$l->name .= ' - ';

											}

											$l->name .= $l->points.JTEXT::_('COM_DJCLASSIFIEDS_POINTS_SHORT');		

										}

										if($l->price_special>0){

											$l->name .= ' - '.DJClassifiedsTheme::priceFormat($l->price_special,$unit_price).' '.JTEXT::_('COM_DJCLASSIFIEDS_SPECIAL_PRICE_SHORT');

										}														

									$l->name .= ')'; 

								}

								$cat_sel .= '<option value="'.$l->id.'">'.str_ireplace("'", "&apos;", $l->name).'</option>';

							}

								$cat_sel .= '</select>';

								echo $cat_sel;				



							?>
						</div>
						<div class="form-group">
							<div class="condition-wrapper">
								<div class="condition">
									+NEW
								</div>
								<div class="condition">
									+USED
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="type_id"><?php echo JTEXT::_('COM_DJCLASSIFIEDS_TYPE_TOOLTIP');?></label>
							<select autocomplete="off" name="type_id" id="type_id" class="inputbox<?php if($par->get('types_required','0')){ echo ' required';} ?>" >
								<option value=""><?php echo JText::_('COM_DJCLASSIFIEDS_SELECT_TYPE');?></option>
								<?php echo JHtml::_('select.options', $types, 'value', 'text', $this->item->type_id, true);?>
							</select>
						</div>
						<div class="form-group">
							<label for="description"><?php echo JText::_('COM_DJCLASSIFIEDS_INTRO_DESCRIPTION');?></label>
							<?php
							$allowed_tags = explode(';', $par->get('allowed_htmltags',''));

							$a_tags = '';

							for($a = 0;$a<count($allowed_tags);$a++){

								$a_tags .= '<'.$allowed_tags[$a].'>';

							}

							$this->item->description = strip_tags($this->item->description,$a_tags); ?>

							<textarea id="description" name="description" rows="5" cols="55" class="inputbox" ><?php echo $this->item->description; ?></textarea>
						</div>
						<div class="form-group">
							<label for="contact"><?php echo JText::_('COM_DJCLASSIFIEDS_CONTACT');?></label>
							<textarea id="contact" name="contact" rows="4" cols="55" class="inputbox required"><?php echo str_ireplace("<br />", '', $this->item->contact); ?></textarea>                  
						</div>
					</div>
				</div>
			</form>
		</div>
		<div>