<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="content-wrapper">
	<div class="event-button-cont">
		<ul class="side-nav">
			<li><?= $this->Form->postLink(
					__('<i class="fa fa-trash" aria-hidden="true"></i> Delete City'),
					['action' => 'delete', $city->id],
					['escape' => false, 'confirm' => __('Are you sure you want to delete "{0}"?', $city->city_name)]
				)
			?></li>
			<li><?= $this->Html->link(__('<i class="fa fa-list" aria-hidden="true"></i> List Cities'), ['action' => 'index'], ['escape' => false]) ?></li>
		</ul>
	</div>
		
	<div class="cities form large-9 medium-8 columns content">
		<?= $this->Form->create($city, array('id' => 'editform')) ?>
		<fieldset>
			<legend><?= __('Edit City') ?></legend>
			<?php
				echo $this->Form->control('state_id', ['options' => $states]);
				echo $this->Form->control('city_name');
			?>
		</fieldset>
		<?= $this->Form->button(__('Submit')) ?>
		<?= $this->Form->end() ?>
	</div>
</div>
<script>$("#editform").validate();</script>
