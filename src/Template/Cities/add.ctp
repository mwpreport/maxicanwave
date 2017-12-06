<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="content-wrapper">
	<div class="event-button-cont">
		<ul class="side-nav">
			<li><?= $this->Html->link(__('<i class="fa fa-list" aria-hidden="true"></i> List Cities'), ['action' => 'index'], ['escape' => false]) ?></li>
		</ul>
	</div>
	<div class="cities form large-9 medium-8 columns content">
		<?= $this->Form->create($city, array('id' => 'newform')) ?>
		<fieldset>
			<legend><?= __('Add City') ?></legend>
			<?php
				echo $this->Form->control('state_id', ['options' => $states]);
				echo $this->Form->control('city_name');
			?>
		</fieldset>
		<?= $this->Form->button(__('Submit')) ?>
		<?= $this->Form->end() ?>
	</div>
</div>
<script>$("#newform").validate();</script>
