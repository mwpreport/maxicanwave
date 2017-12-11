<?php
/**
 * @var \App\View\AppView $this
 */
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<div class="event-button-cont">
		<ul class="side-nav">
			<li><?= $this->Html->link(__('<i class="fa fa-list" aria-hidden="true"></i> List States'), ['action' => 'index'], ['escape' => false]) ?></li>
		</ul>
	</div>
	<div class="states content"><section><div class="white-wrapper">
		<?= $this->Form->create($state, array('id' => 'newform')) ?>
		<fieldset>
			<legend><?= __('Add State') ?></legend>
			<?php
				echo $this->Form->control('name', ['class' => 'form-control']);
				echo $this->Form->control('state_code', ['class' => 'form-control']);
			?>
		</fieldset>
		<?= $this->Form->button(__('Submit'), ['class' => 'common-btn blue-btn btn-125']); ?>
		<?= $this->Form->end() ?>
	</div></section></div>
</div>
<script>$("#newform").validate();</script>
