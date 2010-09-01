<?php
class Menu extends CakemenuAppModel {
	var $name = 'Menu';
	var $useTable = 'cakemenu';
	var $displayField = 'name';
	var $actsAs = array('Tree');
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	
	/**
	 * Function which return single array containing the path to the node.
	 * it uses getpath, but extracts only the id and another field as value
	 * @param integer id of the node
	 * @param string $field could be any column from the menu table
	 */
	function where($id, $field='id'){
	    $nodes = $this->getpath(intval($id));
	    return Set::extract($nodes, '/Menu/'.$field);
	}
}
?>