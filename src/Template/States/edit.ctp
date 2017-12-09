<?php
/**
 * @var \App\View\AppView $this
 */
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<div class="event-button-cont">
		<ul class="side-nav">
			<li><?= $this->Form->postLink(
					__('<i class="fa fa-trash" aria-hidden="true"></i> Delete State'),
					['action' => 'delete', $state->id],
					['escape' => false, 'confirm' => __('Are you sure you want to delete "{0}"?', $state->name)]
				)
			?></li>
			<li><?= $this->Html->link(__('<i class="fa fa-list" aria-hidden="true"></i> List States'), ['action' => 'index'], ['escape' => false]) ?></li>
		</ul>
	</div>

	<div class="states form large-9 medium-8 columns content">
		<?= $this->Form->create($state, array('id' => 'editform')) ?>
		<fieldset>
			<legend><?= __('Edit State') ?></legend>
			<?php
				echo $this->Form->control('name');
				echo $this->Form->control('state_code');
			?>
		</fieldset>
		<?= $this->Form->button(__('Submit')) ?>
		<?= $this->Form->end() ?>
	</div>
</div>
<script>$("#editform").validate();</script>
