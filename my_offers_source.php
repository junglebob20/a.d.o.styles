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

$toolTipArray = array('className'=>'djcf');

JHTML::_('behavior.tooltip', '.Tips1', $toolTipArray);

$par = JComponentHelper::getParams( 'com_djclassifieds' );

$app = JFactory::getApplication();

$main_id= JRequest::getVar('cid', 0, '', 'int');

$it= JRequest::getVar('Itemid', 0, '', 'int');

$points_a = $par->get('points',0);

$user = JFactory::getUser();



$order = JRequest::getCmd('order', $par->get('items_ordering','date_e'));

$ord_t = JRequest::getCmd('ord_t', $par->get('items_ordering_dir','desc'));

$ord_dir = JRequest::getCmd('ord_t', $par->get('items_ordering_dir','desc'));

if($ord_t=="desc"){

	$ord_t='asc';

}else{

	$ord_t='desc';

}



$sw = htmlspecialchars(JRequest::getVar('search',''), ENT_COMPAT, 'UTF-8');

$uid	= JRequest::getVar('uid', 0, '', 'int');



	$menus	= $app->getMenu('site');

	$menu_item = $menus->getItems('link','index.php?option=com_djclassifieds&view=items',1);

		

	$itemid = ''; 

	if($menu_item){

		$itemid='&Itemid='.$menu_item->id;

	}

	

	$menu_item_new = $menus->getItems('link','index.php?option=com_djclassifieds&view=additem',1);

	$itemid_new = '';

	if($menu_item_new){

		$itemid_new='&Itemid='.$menu_item_new->id;

	}else{

		$itemid_new = $itemid;

	}

	

$renew_date = date("Y-m-d G:i:s",mktime(date("G"), date("i"), date("s"), date("m")  , date("d")+$par->get('renew_days','3'), date("Y"))); 

$r=TRUE;

?>

<div id="dj-classifieds" class="clearfix djcftheme-<?php echo $par->get('theme','default');?>">

	<div class="title_top"><h1>

		<?php	echo JText::_('COM_DJCLASSIFIEDS_YOUR_ADS');?>

	</h1></div>

<div class="useritems_search">

	<form method="post" name="djForm"  class="form" enctype="multipart/form-data" >															

		<input type="text" size="25" name="search" class="inputbox" value="<?php echo JRequest::getVar('search',''); ?>" placeholder="<?php echo JText::_('COM_DJCLASSIFIEDS_SEARCH'); ?>" />

		<button class="button" type="submit"  ><?php echo JText::_('COM_DJCLASSIFIEDS_SEARCH_BUTTON'); ?></button>			    	    

	    <input type="hidden" name="option" value="com_djclassifieds" /> 

	    <input type="hidden" name="view" value="useritems" />

	    <input type="hidden" name="Itemid" value="<?php echo $it; ?>" />

	   <div class="clear_both"></div>

	</form>

</div>	

<div class="useritems">

			

	<?php

	if($par->get('showitem_jump',0)){

		$anch = '#dj-classifieds';

	}else{

		$anch='';

	}

	?>	

	

	<div class="dj-useradverts">

			<div class="main_title">

				<?php if($order=="title"){$class="active";}else{$class="normal";}?>

				<div class="main_title_box name first <?php echo $class; ?>"><div class="main_title_box_in">

					<a class="<?php echo $class; ?>" href="index.php?option=com_djclassifieds&view=useritems&Itemid=<?php echo $it; ?>&cid=<?php echo $main_id; ?>&order=title&ord_t=<?php echo $ord_t;?><?php if($sw){ echo '&search='.$sw; };if($uid){ echo '&uid='.$uid; }?>">

						<?php echo JText::_('COM_DJCLASSIFIEDS_TITLE');

						if($order=="title"){

							if($ord_t=='asc'){ echo '<img src="'.JURI::base(true).'/components/com_djclassifieds/assets/images/sort_desc.gif" />';

							}else{ echo '<img src="'.JURI::base(true).'/components/com_djclassifieds/assets/images/sort_asc.gif" />';}					

						}else{	echo '<img src="'.JURI::base(true).'/components/com_djclassifieds/assets/images/sort.gif" />'; }?>

					</a> 

				</div></div>

				<?php /*if($order=="cat"){$class="active";}else{$class="normal";}?>

				<div class="main_title_box <?php echo $class; ?>"><div class="main_title_box_in">

					<a class="<?php echo $class; ?>" href="index.php?option=com_djclassifieds&view=useritems&Itemid=<?php echo $it; ?>&cid=<?php echo $main_id; ?>&order=cat&ord_t=<?php echo $ord_t;?><?php if($sw){ echo '&search='.$sw; };if($uid){ echo '&uid='.$uid; }?>">

						<?php echo JText::_('COM_DJCLASSIFIEDS_CATEGORY');

						if($order=="cat"){

							if($ord_t=='asc'){ echo '<img src="'.JURI::base(true).'/components/com_djclassifieds/assets/images/sort_desc.gif" />';

							}else{ echo '<img src="'.JURI::base(true).'/components/com_djclassifieds/assets/images/sort_asc.gif" />';}					

						}else{	echo '<img src="'.JURI::base(true).'/components/com_djclassifieds/assets/images/sort.gif" />'; }?>

					</a> 

				</div></div>				 				

				<?php */if($order=="date_a"){$class="active";}else{$class="normal";}?>

				<div class="main_title_box <?php echo $class; ?>"><div class="main_title_box_in">

					<a class="<?php echo $class; ?>" href="index.php?option=com_djclassifieds&view=useritems&Itemid=<?php echo $it; ?>&cid=<?php echo $main_id; ?>&order=date_a&ord_t=<?php echo $ord_t;?><?php if($sw){ echo '&search='.$sw; };if($uid){ echo '&uid='.$uid; }?>">

						<?php echo JText::_('COM_DJCLASSIFIEDS_DATE_ADDED');

						if($order=="date_a"){

							if($ord_t=='asc'){ echo '<img src="'.JURI::base(true).'/components/com_djclassifieds/assets/images/sort_desc.gif" />';

							}else{ echo '<img src="'.JURI::base(true).'/components/com_djclassifieds/assets/images/sort_asc.gif" />';}					

						}else{	echo '<img src="'.JURI::base(true).'/components/com_djclassifieds/assets/images/sort.gif" />'; }?>

					</a> 

				</div></div>								

				<?php if($order=="date_e"){$class="active";}else{$class="normal";}?>

				<div class="main_title_box <?php echo $class; ?>"><div class="main_title_box_in">

					<a class="<?php echo $class; ?>" href="index.php?option=com_djclassifieds&view=useritems&Itemid=<?php echo $it; ?>&cid=<?php echo $main_id; ?>&order=date_e&ord_t=<?php echo $ord_t;?><?php if($sw){ echo '&search='.$sw; };if($uid){ echo '&uid='.$uid; }?>">

					<?php echo JText::_('COM_DJCLASSIFIEDS_DATE_EXPIRATION');

					if($order=="date_e"){

						if($ord_t=='asc'){ echo '<img src="'.JURI::base(true).'/components/com_djclassifieds/assets/images/sort_desc.gif" />';

						}else{ echo '<img src="'.JURI::base(true).'/components/com_djclassifieds/assets/images/sort_asc.gif" />';}					

					}else{	echo '<img src="'.JURI::base(true).'/components/com_djclassifieds/assets/images/sort.gif" />'; }?></a> 

				</div></div>				

				<?php if($order=="active"){$class="active";}else{$class="normal";}?>

				<div class="main_title_box <?php echo $class; ?>"><div class="main_title_box_in">

					<a class="<?php echo $class; ?>" href="index.php?option=com_djclassifieds&view=useritems&Itemid=<?php echo $it; ?>&cid=<?php echo $main_id; ?>&order=active&ord_t=<?php echo $ord_t;?><?php if($sw){ echo '&search='.$sw; };if($uid){ echo '&uid='.$uid; }?>">

					<?php echo JText::_('COM_DJCLASSIFIEDS_ACTIVE');

					if($order=="active"){

						if($ord_t=='asc'){ echo '<img src="'.JURI::base(true).'/components/com_djclassifieds/assets/images/sort_desc.gif" />';

						}else{ echo '<img src="'.JURI::base(true).'/components/com_djclassifieds/assets/images/sort_asc.gif" />';}					

					}else{	echo '<img src="'.JURI::base(true).'/components/com_djclassifieds/assets/images/sort.gif" />'; }?></a>			 

				</div></div>

				<div class="clear_both"></div>	

			</div>			

			<?php 

			foreach($this->items as $i){

				$row = $r==TRUE ? '0' : '1';

				$r=!$r;

				if($i->special==1){$row.=' special special_first';}

				$tip_title = '';

				$tip_cont = '';

				if((int)$par->get('tooltip_img','1')){

					$tip_title=str_ireplace('"',"'",$i->name);

					$tip_cont = '<div class=\'row_title\'>'.JText::_('COM_DJCLASSIFIEDS_DESCRIPTION').'</div><div class=\'desc\'>'.str_ireplace('"',"'",strip_tags($i->description)).'</div>';

					$tip_cont = '<div class=\'tp_desc\'>'.str_ireplace('"',"''",strip_tags(substr($i->description,0,500).'...')).'</div>';

					if($par->get('tooltip_location','1')){

						$tip_cont .= '<div class=\'row_location\'><div class=\'row_title\'>'.JText::_('COM_DJCLASSIFIEDS_LOCALIZATION').'</div><div class=\'tp_location\'>';

						$tip_cont .= $i->r_name.'<br />'.$i->address;

						$tip_cont .= '</div></div>';

					}

					if($par->get('tooltip_contact','1') && $i->contact){

						$tip_cont .= '<div class=\'row_contact\'><div class=\'row_title\'>'.JText::_('COM_DJCLASSIFIEDS_CONTACT').'</div><div class=\'tp_contact\'>'.str_ireplace('"',"''",strip_tags($i->contact)).'</div></div>';

					}

					if($par->get('tooltip_price','1')  && $par->get('show_price','1')){

						$tip_cont .= '<div class=\'row_price\'><div class=\'row_title\'>'.JText::_('COM_DJCLASSIFIEDS_PRICE').'</div><div class=\'tp_price\'>';

						$tip_cont .= DJClassifiedsTheme::priceFormat($i->price,$par->get('unit_price','EUR'));

						$tip_cont .= '</div></div>';

					}

					$timg_limit = $par->get('tooltip_images','3');

					if(count($i->images) && $timg_limit>0){

						$tip_cont .= '<div style=\'clear:both\'></div><div class=\'title\'>'.JText::_('COM_DJCLASSIFIEDS_IMAGES').'</div><div class=\'images_box\'>';											

						for($ii=0; $ii<count($i->images);$ii++ ){

							if($timg_limit==$ii){break;}  				

		   	        		$tip_cont .= '<img src=\''.JURI::base(true).$i->images[$ii]->thumb_s.'\' />';   				

						}

						$tip_cont .= '</div>';

					}

					$tip_cont .= '<div style=\'clear:both\'></div>';

				}

												

				echo '<div class="row_ua">';

					echo '<div class="row_ua1"><div class="row_ua1_in">';

						echo '<div class="col_ua icon_name first"><div class="col_ua_in">';					

							echo '<a class="icon" href="'.DJClassifiedsSEO::getItemRoute($i->id.':'.$i->alias,$i->cat_id.':'.$i->c_alias,$i->region_id.':'.$i->r_name).$anch.'">';

							if(count($i->images)){									

								echo '<img src="'.JURI::base(true).$i->images[0]->thumb_s.'"';

								if((int)$par->get('tooltip_img','1')){

									echo ' class="Tips1" title="'.$tip_title.'" rel="'.$tip_cont.'"';

								}

								echo ' alt ="'.str_ireplace('"', "'", $i->images[0]->caption).'" ';						

							 echo  '/>';					

							}else{

								echo '<img style="width:'.$par->get("smallth_width",'56').'px;" src="'.JURI::base().$par->get('blank_img_path','/components/com_djclassifieds/assets/images/').'no-image.png" ';

								if((int)$par->get('tooltip_img','1')){

									echo 'class="Tips1" title="'.$tip_title.'" rel="'.$tip_cont.'"';

								}

								echo '/>';

							}

							echo '</a>';					

						

							if((int)$par->get('tooltip_title','1')){

								echo '<a class="title Tips1" href="'.DJClassifiedsSEO::getItemRoute($i->id.':'.$i->alias,$i->cat_id.':'.$i->c_alias,$i->region_id.':'.$i->r_name).$anch.'" title="'.$tip_title.'" rel="'.$tip_cont.'" >'.$i->name.'</a>';

							}else{

								echo '<a class="title" href="'.DJClassifiedsSEO::getItemRoute($i->id.':'.$i->alias,$i->cat_id.':'.$i->c_alias,$i->region_id.':'.$i->r_name).$anch.'" >'.$i->name.'</a>';

							}

							echo '<span class="c_name">'.$i->c_name.'</span>';

							echo '<div class="clear_both"></div>';

						echo '</div></div>';

						echo '<div class="col_ua public_status"><div class="col_ua_in">';

							echo '<div class="col_ua_row">'.JText::_('COM_DJCLASSIFIEDS_DATE_ADDED').' : <span>'.DJClassifiedsTheme::formatDate(strtotime($i->date_start),'',$par->get('date_format_type',0)).'</span></div>';

							echo '<div class="col_ua_row">'.JText::_('COM_DJCLASSIFIEDS_DATE_EXPIRATION').' : ';

								if($i->s_active){

									echo '<span title="'.$i->date_start.' - '.$i->date_exp.'" style="color:#559D01;font-weight:bold;" >'.DJClassifiedsTheme::formatDate(strtotime($i->date_exp),'',$par->get('date_format_type',0)).'</span>';

								}else{

									echo '<span title="'.$i->date_start.' - '.$i->date_exp.'" style="color:#C23C00;font-weight:bold;" >'.DJClassifiedsTheme::formatDate(strtotime($i->date_exp),'',$par->get('date_format_type',0)).'</span>';

								}

							echo '</div>';

							echo '<div class="col_ua_row">'.JText::_('COM_DJCLASSIFIEDS_PUBLISHED').' : ';

								if($i->published){

									echo '<img src="'.JURI::base().'components/com_djclassifieds/assets/images/tick.png" alt="'.JText::_('JYES').'" />';

								}else{

									echo '<img src="'.JURI::base().'components/com_djclassifieds/assets/images/publish_x.png" alt="'.JText::_('JNO').'" />';

								}

							echo '</div>';														

							if(count($i->promotions_active)){

								foreach($i->promotions_active as $prom_active){ 

									echo '<div class="col_ua_row">'.JText::_($prom_active->label).' : <span>'.DJClassifiedsTheme::formatDate(strtotime($prom_active->date_exp),'',$par->get('date_format_type',0)).'</span></div>';

								}

							}														

						echo '</div></div>';



					

						echo '<div class="col_ua advert_active last" align="center"><div class="col_ua_in">';

							if($i->published==2){

								echo '<img title="'.JText::_('COM_DJCLASSIFIEDS_ARCHIVE').'" src="'.JURI::base().'components/com_djclassifieds/assets/images/archive.png" alt="'.JText::_('JARCHIVE').'" />';

							}else if($i->s_active && $i->published==1 && $i->blocked==0){

								echo '<img title="'.JText::_('COM_DJCLASSIFIEDS_ACTIVE').'" src="'.JURI::base().'components/com_djclassifieds/assets/images/active.png" alt="'.JText::_('JYES').'" />';

							}else{

								echo '<img title="'.JText::_('COM_DJCLASSIFIEDS_INACTIVE').'" src="'.JURI::base().'components/com_djclassifieds/assets/images/unactive.png" alt="'.JText::_('JNO').'" />';

							}

						echo '</div></div>';

						echo '<div class="clear_both"></div>';

					echo '</div></div>';

										

					if($i->published!=2){

						echo '<div class="row_ua2"><div class="row_ua2_in">';						

							echo '<a class="button edit" href="index.php?option=com_djclassifieds&view=additem&id='.$i->id.$itemid_new.'">'.JText::_('COM_DJCLASSIFIEDS_EDIT').'</a>';

							if($par->get('allow_user_copy_ad',0)){

								echo '<a class="button copy" href="index.php?option=com_djclassifieds&view=additem&copy='.$i->id.$itemid_new.'">'.JText::_('COM_DJCLASSIFIEDS_COPY').'</a>';

							}

							if($renew_date>=$i->date_exp){

									

								//echo '<a class="button renew" href="javascript:void(0)" onclick="confirm_renew(\''.str_ireplace(array('"',"'"), array('&#34;','\&#39;'), $i->name).'\','.$i->id.')" >';

							echo '<a class="button renew" href="index.php?option=com_djclassifieds&view=renewitem&id='.$i->id.'&Itemid='.$it.'" >';

								echo JText::_('COM_DJCLASSIFIEDS_RENEW').' (';

								echo $exp_days = $par->get('durations_list',1) ? $i->exp_days : $par->get('exp_days',0);

								if($exp_days==1){

									echo '&nbsp;'.JText::_('COM_DJCLASSIFIEDS_DAY').')';

								}else{

									echo '&nbsp;'.JText::_('COM_DJCLASSIFIEDS_DAYS').')';

								}

								echo '</a>';

							}

																							

							if($par->get('promotion_move_top',0) && $i->s_active && $i->published){

								echo '<a class="button prom_top" href="index.php?option=com_djclassifieds&view=payment&id='.$i->id.'&type=prom_top&Itemid='.$it.'" >';

									echo JText::_('COM_DJCLASSIFIEDS_PROMOTION_MOVE_TO_TOP');

									echo ' <span>(';

									if($points_a!=2){

										echo DJClassifiedsTheme::priceFormat($par->get('promotion_move_top_price',0),$par->get('unit_price','EUR'));

									}

									if($par->get('promotion_move_top_points',0) && $points_a){

										if($points_a!=2){

											echo '&nbsp-&nbsp';

										}

										echo $par->get('promotion_move_top_points',0).' '.JTEXT::_('COM_DJCLASSIFIEDS_POINTS_SHORT');

									}

									if(isset($this->special_prices['promotion_move_top_price'])){

										$move_to_top_price_special	= $this->special_prices['promotion_move_top_price'];

										if($move_to_top_price_special>0){

											echo '&nbsp;-&nbsp;'.DJClassifiedsTheme::priceFormat($move_to_top_price_special,$par->get('unit_price')).' '.JTEXT::_('COM_DJCLASSIFIEDS_SPECIAL_PRICE_SHORT');

										}

									}

								echo ')</span></a>';

							}

							if(!$i->payed && $i->pay_type && !$i->published){

								echo '<a class="button pay" href="index.php?option=com_djclassifieds&view=payment&id='.$i->id.'&Itemid='.$it.'" >'.JText::_('COM_DJCLASSIFIEDS_PAY').'</a>';

							}

							if($i->published && $par->get('allow_user_block_ad',0)){

								if($i->blocked){

									echo '<a class="button activate" href="index.php?option=com_djclassifieds&view=item&task=activate&id='.$i->id.'&Itemid='.$it.'" >'.JText::_('COM_DJCLASSIFIEDS_ACTIVATE_ADVERT').'</a>';										

								}else{

									echo '<a class="button block" href="index.php?option=com_djclassifieds&view=item&task=block&id='.$i->id.'&Itemid='.$it.'" >'.JText::_('COM_DJCLASSIFIEDS_BLOCK_ADVERT').'</a>';

								}

								

							}

							if($par->get('allow_user_archive',0) && $par->get('user_ad_delete',0)==0){

								echo '<a class="button archive" href="javascript:void(0)" onclick="confirm_archive(\''.str_ireplace(array('"',"'"), array('&#34;','\&#39;'), $i->name).'\','.$i->id.')" >'.JText::_('COM_DJCLASSIFIEDS_ARCHIVE').'</a>';

							}

							echo '<a class="button delete" href="javascript:void(0)" onclick="confirm_del(\''.str_ireplace(array('"',"'"), array('&#34;','\&#39;'), $i->name).'\','.$i->id.')" >'.JText::_('COM_DJCLASSIFIEDS_DELETE').'</a>';							

							echo '<div class="clear_both"></div>';

						echo '</div></div>';

					}else  if($par->get('allow_user_delete_archive',0)==1 && $par->get('user_ad_delete',0)==0){

						echo '<div class="row_ua2"><div class="row_ua2_in">';

							if($par->get('allow_user_copy_ad',0)){

								echo '<a class="button copy" href="index.php?option=com_djclassifieds&view=additem&copy='.$i->id.$itemid_new.'">'.JText::_('COM_DJCLASSIFIEDS_COPY').'</a>';

							}

							echo '<a class="button delete" href="javascript:void(0)" onclick="confirm_del(\''.str_ireplace(array('"',"'"), array('&#34;','\&#39;'), $i->name).'\','.$i->id.')" >'.JText::_('COM_DJCLASSIFIEDS_DELETE').'</a>';

							echo '<div class="clear_both"></div>';

						echo '</div></div>';

					}

					

					if($par->get('buynow') && $i->buynow){ ?>

						<div class="row_ua_orders"><div class="row_ua_orders_in">

							<div class="row_ua_orders_title">

								<?php echo JText::_('COM_DJCLASSIFIEDS_ORDERS_HISTORY').' ('.count($i->orders).')'; ?><span></span>

							</div>

							<div class="row_ua_orders_content">							

								<div class="dj-items-table2">							

									<div class="item_row item_header main_title">

										<div class="item_col name normal first" style="text-align:center;"><?php echo JText::_('COM_DJCLASSIFIEDS_BUYER') ?></div>

										<div class="item_col normal" style="text-align:center;"><?php echo JText::_('COM_DJCLASSIFIEDS_PRICE') ?></div>

										<div class="item_col normal" style="text-align:center;"><?php echo JText::_('COM_DJCLASSIFIEDS_DATE') ?></div>				

									</div>	

									<?php foreach($i->orders as $iorder){

										

										$row = $r==TRUE ? '0' : '1';

										$r=!$r;

										echo '<div class="item_row row'.$row.'">';										

											echo '<div class="item_col first">';										

												$uid_slug = $iorder->user_id.':'.DJClassifiedsSEO::getAliasName($iorder->username);

												echo '<a class="profile_name" href="index.php?option=com_djclassifieds&view=profile&uid='.$uid_slug.DJClassifiedsSEO::getUserProfileItemid().'">'.$iorder->username.'</a><br/>';

												echo '<a class="profile_email" href="mailto:'.$iorder->email.'">'.$iorder->email.'</a>';											

											echo '</div>';	?>

											<div class="item_col"> 

												<div class="djcf_prow_desc_row">

													<span class="djcf_prow_desc_label" ><?php echo JText::_("COM_DJCLASSIFIEDS_PRICE");?>:</span>

													<span class="djcf_prow_desc_value" ><?php echo DJClassifiedsTheme::priceFormat($iorder->price,$i->currency);?></span>

													<div class="clear_both"></div>

												</div>

												<div class="djcf_prow_desc_row">

													<span class="djcf_prow_desc_label" ><?php echo JText::_("COM_DJCLASSIFIEDS_QUANTITY");?>:</span>

													<span class="djcf_prow_desc_value" ><?php echo $iorder->quantity;?></span>

													<div class="clear_both"></div>

												</div>

											</div>	

											<div class="item_col"> 

												<?php echo DJClassifiedsTheme::formatDate(strtotime($iorder->date)); ?>						

											</div>

											<?php 

										echo '</div>';

									}?>

								</div> 							

							</div>						

						</div></div>

					<?php 	

					} 

					if($i->offer){ ?>

						<div class="row_ua_orders"><div class="row_ua_orders_in">

							<div class="row_ua_orders_title">

								<?php echo JText::_('COM_DJCLASSIFIEDS_OFFERS_HISTORY').' ('.count($i->offers).')'; ?><span></span>

							</div>

							<div class="row_ua_orders_content">							

								<div class="dj-items-table2">							

									<div class="item_row item_header main_title">

										<div class="item_col name normal first" style="text-align:center;"><?php echo JText::_('COM_DJCLASSIFIEDS_BUYER') ?></div>

										<div class="item_col normal" style="text-align:center;"><?php echo JText::_('COM_DJCLASSIFIEDS_OFFER') ?></div>

										<div class="item_col normal" style="text-align:center;"><?php echo JText::_('COM_DJCLASSIFIEDS_DATE') ?></div>				

									</div>	

									<?php

									$ioffers_c = count($i->offers);

									$io = 0;

									 foreach($i->offers as $ioffer){										

										$row = $r==TRUE ? '0' : '1';

										$r=!$r;

										$io++;

										

										echo '<div class="item_row row'.$row.'">';										

											echo '<div class="item_col first">';										

												$uid_slug = $ioffer->user_id.':'.DJClassifiedsSEO::getAliasName($ioffer->username);

												echo '<a class="profile_name" href="index.php?option=com_djclassifieds&view=profile&uid='.$uid_slug.DJClassifiedsSEO::getUserProfileItemid().'">'.$ioffer->username.'</a><br/>';

												echo '<a class="profile_email" href="mailto:'.$ioffer->email.'">'.$ioffer->email.'</a>';											

											echo '</div>';	?>

											<div class="item_col"> 

												<div class="djcf_prow_desc_row">

													<span class="djcf_prow_desc_label" ><?php echo JText::_("COM_DJCLASSIFIEDS_PRICE");?>:</span>

													<span class="djcf_prow_desc_value" ><?php echo DJClassifiedsTheme::priceFormat($ioffer->price,$ioffer->currency);?></span>

													<div class="clear_both"></div>

												</div>

												<div class="djcf_prow_desc_row">

													<span class="djcf_prow_desc_label" ><?php echo JText::_("COM_DJCLASSIFIEDS_QUANTITY");?>:</span>

													<span class="djcf_prow_desc_value" ><?php echo $ioffer->quantity;?></span>

													<div class="clear_both"></div>

												</div>

											</div>	

											<div class="item_col"> 

												<?php echo DJClassifiedsTheme::formatDate(strtotime($ioffer->date)); ?>						

											</div>

										<?php echo '</div>'; ?>

										</div>

										<div class="dj-items-table2 dj-items-table2-offer-msg">

											<div class="item_row item_row_msg">

												<div class="item_col first">

													<div class="item_message_title" >

														<?php echo JText::_('COM_DJCLASSIFIEDS_MESSAGE_FROM_BUYER'); ?>

													</div>

													<div class="item_message" >													

														<?php echo $ioffer->message; ?>

													</div>

												</div>	

												<div class="item_col">

													<div class="item_response" >

														<?php if($ioffer->status==0){ ?>

															<form action="index.php" method="post" name="djForm<?php echo $ioffer->id;?>" id="djForm<?php echo $ioffer->id;?>" class="form-validate" enctype="multipart/form-data" >															

																<select name="offer_status" class="inputbox required">

																	<option value=""><?php echo JText::_('COM_DJCLASSIFIEDS_SELECT_STATUS'); ?></option>

																	<option value="1"><?php echo JText::_('COM_DJCLASSIFIEDS_ACCEPT_OFFER'); ?></option>

																	<option value="2"><?php echo JText::_('COM_DJCLASSIFIEDS_DECLINE_OFFER'); ?></option>

																</select>

																<div class="item_response_msg_box">

																	<textarea name="offer_msg"  class="inputbox required" id="offer_msg<?php echo $ioffer->id;?>" placeholder="<?php echo JText::_('COM_DJCLASSIFIEDS_OFFER_RESPONSE'); ?>"></textarea>

																</div>

																<button class="button validate" type="submit" id="submit_b<?php echo $ioffer->id;?>" ><?php echo JText::_('COM_DJCLASSIFIEDS_SEND_RESPONSE'); ?></button>			    

															    <input type="hidden" name="item_id" value="<?php echo $i->id; ?>">

															    <input type="hidden" name="offer_id"value="<?php echo $ioffer->id; ?>">

															    <input type="hidden" name="option" value="com_djclassifieds" /> 

															    <input type="hidden" name="view" value="contact" />

															    <input type="hidden" name="task" value="saveOfferResponse" />

															    <input type="hidden" name="Itemid" value="<?php echo $it; ?>" />

															   <div class="clear_both"></div>

															</form>	

														<?php }else{ ?>

															<div class="item_status">

																<span><?php echo JText::_('COM_DJCLASSIFIEDS_STATUS'); ?>: </span>

																<?php 

																	if($ioffer->status==1){

																		echo JText::_('COM_DJCLASSIFIEDS_OFFER_ACCEPTED');	

																	}else{

																		echo JText::_('COM_DJCLASSIFIEDS_OFFER_DECLINED');

																	}

																?>

															</div>

															<?php														

															if($ioffer->status==1  && DJClassifiedsPayment::getUserPaypal($user->id) && $par->get('buynow_direct_payment',0)){ ?>

																<div class="item_status">

																	<span><?php echo JText::_('COM_DJCLASSIFIEDS_PAYMENT_STATUS'); ?>: </span>

																	<?php 

																		if($ioffer->paid==1){

																			echo JText::_('COM_DJCLASSIFIEDS_PAID');	

																		}else{

																			echo JText::_('COM_DJCLASSIFIEDS_PENDING');

																		}

																	?>

																</div>	

															<?php } ?>

															<div class="item_response">

																<?php echo $ioffer->response; ?>

															</div>

														<?php }?>

													</div>

												</div>

											</div>

										</div>

										<div class="dj-items-table2">			

										<?php if($io < $ioffers_c){?>					

											<div class="item_row item_header main_title">

												<div class="item_col name normal first" style="text-align:center;"><?php echo JText::_('COM_DJCLASSIFIEDS_BUYER') ?></div>

												<div class="item_col normal" style="text-align:center;"><?php echo JText::_('COM_DJCLASSIFIEDS_PRICE') ?></div>

												<div class="item_col normal" style="text-align:center;"><?php echo JText::_('COM_DJCLASSIFIEDS_DATE') ?></div>				

											</div>

										<?php }?>

									<?php }?>

								</div> 							

							</div>						

						</div></div>							

					<?php }					

			echo '</div>';			

		}

		?>

	</div>

	<?php if($this->pagination->getPagesLinks()){

		echo '<div class="pagination" >';

			echo $this->pagination->getPagesLinks();

		echo '</div>';

	}?>	

	

</div>	



</div>

<script type="text/javascript">

	function confirm_del(title,id){	

		var answer = confirm ('<?php echo str_replace("'","\'",JText::_('COM_DJCLASSIFIEDS_DELETE_CONFIRM'));?>'+' "'+title+'"');

		if (answer){

			 window.location="index.php?option=com_djclassifieds&view=item&task=delete&id="+id+"&Itemid=<?php echo $it;?>";	

		}

	}

	

	function confirm_renew(title,id){	

		var answer = confirm ('<?php echo str_replace("'","\'",JText::_('COM_DJCLASSIFIEDS_RENEW_CONFIRM'));?>'+' "'+title+'"');

		if (answer){

			 window.location="index.php?option=com_djclassifieds&view=item&task=renew&id="+id+"&Itemid=<?php echo $it.'&order='.$order.'&ord_t='.$ord_dir;?>";	

		}

	}



	function confirm_archive(title,id){	

		var answer = confirm ('<?php echo str_replace("'","\'",JText::_('COM_DJCLASSIFIEDS_MOVE_TO_ARCHIVE_CONFIRM'));?>'+' "'+title+'"');

		if (answer){

			 window.location="index.php?option=com_djclassifieds&view=item&task=archive&id="+id+"&Itemid=<?php echo $it;?>";	

		}

	}

	

	window.addEvent('load', function() {

		var djcfpagebreak_acc = new Fx.Accordion('.row_ua_orders .row_ua_orders_title',

				'.row_ua_orders .row_ua_orders_content', {

					alwaysHide : true,

					display : -1,

					duration : 100,

					onActive : function(toggler, element) {

						toggler.addClass('active');

						element.addClass('in');

					},

					onBackground : function(toggler, element) {

						toggler.removeClass('active');

						element.removeClass('in');

					}

				});

	});

	

</script>