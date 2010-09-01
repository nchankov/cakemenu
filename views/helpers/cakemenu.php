<?php
/**
 * Cakemenu helper responsible for generating and displaying the menu nodes as menu
 * Uses Superfish jQuery menu plugin. more information about it you can find at:
 * http://users.tpg.com.au/j_birch/plugins/superfish/
 * 
 * @author Nik chankov <contact@chankov.net>
 * @date 23.04.2010
 */

class CakemenuHelper extends AppHelper {
	var $helpers = array('Html', 'Javascript');
	var $orientation = 'horizontal'; //could be horizontal, vertical or navbar
	
	/**
	 * add the necessary javascript and css files.
	 * bear in mind that you need to include jQuery by yourself in your layout.
	 * @param string $type possible 3 types: 'horizontal' (default), 'vertical', 'navbar'
	 * @return string
	 */
	function libs($type = null){
		if($type != null){
			$this->orientation = $type;
		}
		$output = $this->Html->css('/cakemenu/css/superfish');
		switch($this->orientation){
			case 'vertical':
				$output .= $this->Html->css('/cakemenu/css/superfish-vertical');
				break;
			case 'navbar':
				$output .= $this->Html->css('/cakemenu/css/superfish-navbar');
				break;
			case 'horizontal':
			default:
		}
		//$output .= $this->Javascript->link('/cakemenu/js/hoverIntent');
		$output .= $this->Javascript->link('/cakemenu/js/superfish');
		$output .= $this->Javascript->link('/cakemenu/js/supersubs');
		$output .= $this->Javascript->codeBlock('
				$(document).ready(function(){ 
					$("ul.sf-menu").supersubs({ 
						minWidth:    12,	// minimum width of sub-menus in em units 
						maxWidth:    27,	// maximum width of sub-menus in em units 
						extraWidth:  1		// extra width can ensure lines don\'t sometimes turn over 
									// due to slight rounding differences and font-family 
					}).superfish().find("ul"); 
				});
			');
		return $output;
	}
	
	/**
	 * Function generate is used to build html nodes of the menu
	 * @param array $data result from the Cakemenu Component
	 * @param integer $level level of the current subling
	 * @param array $path path of the elements to the current node. (if provided)
	 * @return string html output of the menu
	 */
	function generate($data, $level = 0, $path = array()){
		if($data == null){
			return '';
		}
		
		foreach($data as $key=>$value){
			$sub = '';
			if(isset($value['children']) && count($value['children']) > 0){
				$sub = $this->generate($value['children'], $level+1);
			}
			$class = '';
			if(isset($sub)){
				$class = 'sf-with-ul';
			}
			$style = '';
			if($value['Menu']['icon'] != ''){
				$style = 'padding-left: 30px; background-image: url('.$this->Html->url($value['Menu']['icon']).'); background-repeat: no-repeat; background-position: 5px center;';
			}
			if($value['Menu']['link'] != ''){
				//Try to evaluate the link (if starts with array)
				if(eregi('^array', $value['Menu']['link'])){
					eval("\$parse = ".$value['Menu']['link'].";");
					if(is_array($parse)){
						$value['Menu']['link'] = $parse;
					}
				}

				$link = $this->Html->link(__($value['Menu']['name'], true), $value['Menu']['link'], array('class'=>$class, 'style'=>$style)); //has link
			} else {
				$link = $this->Html->link(__($value['Menu']['name'], true), "#", array('class'=>$class, 'style'=>$style, 'onclick'=>'return false')); //has link
			}
			if(isset($sub)){
				$link = $link.$sub;
			}
			$class = "";
			if(in_array($value['Menu']['id'], $path)){
				$class = 'current';
			}
			$li[] = "\n".str_repeat("\t", ($level+1)).
					$this->Html->tag('li', $link, array('class'=>$class)).
				"\n".str_repeat("\t", $level);
		
		if($level == 0){
			switch($this->orientation){
				case 'vertical':
					$class = 'sf-menu sf-vertical sf-shadow';
					break;
				case 'navbar':
					$class = 'sf-menu sf-navbar sf-shadow';
					break;
				case 'horizontal':
				default:
					$class = 'sf-menu sf-shadow';
			}}
		}
		
		$tree = "\n".str_repeat("\t", $level).
				$this->Html->tag('ul', implode("\n", $li), array('class'=>'cakemenu '.$class.' ')).
			"\n".str_repeat("\t", $level);
		return $tree;
	}
}