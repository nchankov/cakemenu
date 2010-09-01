<div class="cakemenus form">
<?php echo $this->Form->create('Menu', array('url'=>array('controller'=>'cakemenu', 'action'=>'edit')));?>
	<fieldset>
 		<legend><?php printf(__('Edit %s', true), __('Cakemenu', true)); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('link');
		echo $this->Form->input('parent_id', array('empty'=>true));
		echo $this->Form->input('icon');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>