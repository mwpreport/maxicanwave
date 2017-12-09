<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="content-wrapper">
	<div class="event-button-cont">
		<ul class="side-nav">
			<li><?= $this->Form->postLink(
					__('<i class="fa fa-trash" aria-hidden="true"></i> Delete Speciality'),
					['action' => 'delete', $speciality->id],
					['escape' => false, 'confirm' => __('Are you sure you want to delete "{0}"?', $speciality->name)]
				)
			?></li>
			<li><?= $this->Html->link(__('<i class="fa fa-list" aria-hidden="true"></i> List Specialities'), ['action' => 'index'], ['escape' => false]) ?></li>
		</ul>
	</div>
	<div class="specialities form large-9 medium-8 columns content">
		<?= $this->Form->create($speciality, array('id' => 'editform')) ?>
		<fieldset>
			<legend><?= __('Edit Speciality') ?></legend>
			<?php
				echo $this->Form->control('name');
				echo $this->Form->control('code');
			?>
		</fieldset>
		<?= $this->Form->button(__('Submit')) ?>
		<?= $this->Form->end() ?>
	</div>
</div>
<script>$("#editform").validate();</script>
