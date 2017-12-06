<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="content-wrapper">
	<div class="event-button-cont">
		<ul class="side-nav">
			<li><?= $this->Html->link(__('<i class="fa fa-list" aria-hidden="true"></i> List Specialities'), ['action' => 'index'], ['escape' => false]) ?></li>
		</ul>
	</div>
	<div class="specialities form large-9 medium-8 columns content">
		<?= $this->Form->create($speciality, array('id' => 'newform')) ?>
		<fieldset>
			<legend><?= __('Add Speciality') ?></legend>
			<?php
				echo $this->Form->control('name');
				echo $this->Form->control('code');
			?>
		</fieldset>
		<?= $this->Form->button(__('Submit')) ?>
		<?= $this->Form->end() ?>
	</div>
</div>
<script>$("#newform").validate();</script>
