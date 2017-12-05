<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="content-wrapper">
	<div class="event-button-cont">
		<ul class="side-nav">
			<li><?= $this->Form->postLink(
					__('<i class="fa fa-trash" aria-hidden="true"></i> Delete Doctor'),
					['action' => 'delete', $doctor->id],
					['escape' => false, 'confirm' => __('Are you sure you want to delete "{0}"?', $doctor->name)]
				)
			?></li>
			<li><?= $this->Html->link(__('<i class="fa fa-list" aria-hidden="true"></i> List Doctors'), ['action' => 'index'], ['escape' => false]) ?></li>
		</ul>
	</div>
	<div class="doctors form large-9 medium-8 columns content">
		<?= $this->Form->create($doctor) ?>
		<fieldset>
			<legend><?= __('Edit Doctor') ?></legend>
			<?php
				echo $this->Form->control('name');
				echo $this->Form->control('speciality_id', ['options' => $specialities]);
				echo $this->Form->control('qualification');
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
