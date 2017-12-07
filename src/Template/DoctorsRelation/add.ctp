<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="content-wrapper">
	<div class="event-button-cont">
		<ul class="side-nav">
			<li><?= $this->Html->link(__('<i class="fa fa-list" aria-hidden="true"></i> List Relations'), ['action' => 'index'], ['escape' => false]) ?></li>
		</ul>
	</div>
	<div class="doctorsRelation form large-9 medium-8 columns content">
		<?= $this->Form->create($doctorsRelation, array('id' => 'newform')) ?>
		<fieldset>
			<legend><?= __('Add Doctors Relation') ?></legend>
			<?php
				echo $this->Form->control('user_id', ['options' => $users]);
				echo $this->Form->control('doctor_id', ['options' => $doctors]);
				echo $this->Form->control('class');
				echo $this->Form->control('is_active');
				echo $this->Form->control('dt');
			?>
		</fieldset>
		<?= $this->Form->button(__('Submit')) ?>
		<?= $this->Form->end() ?>
	</div>
</div>
<script>$("#newform").validate();</script>
