<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="content-wrapper">
	<div class="event-button-cont">
		<ul class="side-nav">
			<li><?= $this->Html->link(__('<i class="fa fa-list" aria-hidden="true"></i> List Chemists'), ['action' => 'index'], ['escape' => false]) ?></li>
		</ul>
	</div>
	<div class="chemists form large-9 medium-8 columns content">
		<?= $this->Form->create($chemist) ?>
		<fieldset>
			<legend><?= __('Add Chemist') ?></legend>
			<?php
				echo $this->Form->control('code');
				echo $this->Form->control('name');
				echo $this->Form->control('contact_person');
				echo $this->Form->control('mobile');
				echo $this->Form->control('phone');
				echo $this->Form->control('address');
				echo $this->Form->control('state_id', ['options' => $states]);
				echo $this->Form->control('city_id', ['options' => $cities]);
				echo $this->Form->control('pincode');
				echo $this->Form->control('is_approved');
				echo $this->Form->control('is_active');
				echo $this->Form->control('is_deleted');
				echo $this->Form->control('last_updated');
				echo $this->Form->control('dt');
			?>
		</fieldset>
		<?= $this->Form->button(__('Submit')) ?>
		<?= $this->Form->end() ?>
	</div>
</div>
