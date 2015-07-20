<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



/**
 * valueCol: msg value
 * this->items: msgcmts objects
 * optionCom: 'com_ecmsg'
 * nameKey: 'msgcmt'
 * this->form: msgcmtform object
 * nameCol: 'msg'
 * countCol: msg->msgcmt value
 * item: msgcmt object */
$availableEdit = (1) ? true : false;
$availableDelete = (1) ? true : false;
$modified = EcDatetime::interval($item->modified);
$juName = JHtml::_('string.abridge', $item->ju_name, 10, 3);
//msg_1_msgcmt_1_item
echo '<div id="'.$nameKey.'_'.$item->msgcmt.'_'.$nameCol.'_'.$valueCol.'_item">';



	echo '<div class="pull-left" style="width:80%" align="left">';
		echo '<div class="pull-left media" style="margin-right:10px;">';
			echo '<a href="">';
				echo '<img class="media-object thumbnail" src="'.$icUser.'" alt="">';
			echo '</a>';
		echo '</div>';
		echo '<div class="media-body">';
			echo '<div>'.$juName.'&#160;&#183;&#160;'.$modified.'</div>';
			echo '<div>'.$item->body.'</div>';
		echo '</div>';
	echo '</div>';	
	
	echo '<div class="pull-right" style="width:20%" align="right">';
		echo '<div class="btn-group">';
			echo EcWidget::caretBtn(false);
			echo '<ul class="dropdown-menu" style="right:0px;left:auto;" role="menu">';
				if($availableDelete) echo EcmsgWidget::btnLiSubmit($optionCom, $nameKey, 
					$item->$nameKey, array('msg', 'msgcmt', 'user'), '_'.$valueCol.'_item', 'delete', false);
			echo '</ul>';
		echo '</div>';
	echo '</div>';
	
	echo '<input type="hidden" id="jform_'.$nameCol.'" value="'.$valueCol.'" />';
	echo '<input type="hidden" id="jform_user" value="0" />';
	echo '<input type="hidden" id="jform_'.$nameKey.'" value="'.$item->$nameKey.'" />';
	echo '<input type="hidden" name="task" value="" />';
	echo JHtml::_('form.token');

	
	
echo '</div><div class="clearfix"></div>';