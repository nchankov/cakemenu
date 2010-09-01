<div class="cakemenu index">
	<h2><?php __('Menu tree');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?php echo __('ID', true);?></th>
		<th><?php echo __('Menu', true);?></th>
		<th><?php echo __('Link', true);?></th>
		<th><?php echo __('Actions', true);?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($menu_list as $key=>$node):?>
	<tr>
		<td style="text-align: center;"><?php echo $key; ?>&nbsp;</td>
		<td style="text-align: left"><?php echo $node; ?>&nbsp;</td>
		<td style="text-align: left">
			<?php
			if(in_array($key, array_keys($links))){
				echo $links[$key]; 
			}
			?>&nbsp;
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('up', true), array('action' => 'move', $key, 'up')); ?> |
			<?php echo $this->Html->link(__('down', true), array('action' => 'move', $key, 'down')); ?> | 
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $key)); ?> | 
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $key), null, sprintf(__('Are you sure you want to delete # %s?', true), $key)); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Menu', true)), array('action' => 'edit')); ?></li>
		<li><?php echo $this->Html->link(__('Preview', true), array('action' => 'preview')); ?></li>
		<li><?php echo $this->Html->link(__('Recover hierarchy', true), array('action' => 'recover')); ?></li>
	</ul>
</div>