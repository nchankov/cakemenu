<?php
class CakemenuController extends CakemenuAppController {
	var $name = 'Cakemenu';
	var $uses = array('Cakemenu.Menu');
	var $helpers = array('Cakemenu.Cakemenu');

	function index() {
		$menu_list = $this->Menu->generatetreelist(null, null, null, '&nbsp;&nbsp;&nbsp;');
		//Get links
		$links = $this->Menu->find('list', array('fields'=>array('id', 'link')));
		
		$this->set('menu_list', $menu_list);
		$this->set('links', $links);
	}
	
	function preview($type = null){
		$this->set('type', $type);
		$menu = $this->Menu->find('threaded');
		$this->set('menu', $menu);
	}
	
	function move($id = null, $direction = 'down'){
		if($direction == 'down'){
			$this->Menu->movedown(intval($id));
		} else {
			$this->Menu->moveup(intval($id));
		}
		$this->redirect(array('action'=>'index'));
	}
	
	function recover(){
		$this->Menu->recover();
		$this->redirect(array('action'=>'index'));
	}

	function edit($id = null) {
		if (!empty($this->data)) {
			if ($this->Menu->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'cakemenu'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'cakemenu'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Menu->read(null, $id);
		}
		$parents = $this->Menu->generatetreelist(null, null, null, '___');
		$this->set(compact('parentCakemenus', 'parents'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid id for %s', true), 'Menu'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Menu->removefromtree($id)) {
			$this->Menu->delete($id);
			$this->Session->setFlash(sprintf(__('%s deleted', true), 'Menu'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(sprintf(__('%s was not deleted', true), 'Menu'));
		$this->redirect(array('action' => 'index'));
	}
}
?>