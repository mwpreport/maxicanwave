<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="content-wrapper">
	<div class="event-button-cont">
		<ul class="side-nav">
			<li><?= $this->Html->link(__('<i class="fa fa-list" aria-hidden="true"></i> List Doctors'), ['action' => 'index'], ['escape' => false]) ?></li>
		</ul>
	</div>
	<div class="doctors form large-9 medium-8 columns content">
		<?= $this->Form->create($doctor, array('id' => 'newform')) ?>
		<fieldset>
			<legend><?= __('Add Doctor') ?></legend>
			<?php
				echo $this->Form->control('code');
				echo $this->Form->control('name');
				echo $this->Form->control('speciality_id', ['options' => $specialities]);
				echo $this->Form->control('qualification');
				echo $this->Form->control('mobile');
				echo $this->Form->control('phone');
			?>
				<div class="input required"><label for="address">Address</label><textarea name="address" required="required" id="address" rows="5"></textarea></div>
			<?php
				echo $this->Form->control('state_id', ['options' => $states]);
				echo $this->Form->control('city_id', ['options' => $cities]);
				echo $this->Form->control('pincode');
				echo $this->Form->control('is_approved');
				echo $this->Form->control('is_active');
				echo $this->Form->control('last_updated');
			?>
		</fieldset>
		<?= $this->Form->button(__('Submit')) ?>
		<?= $this->Form->end() ?>
	</div>
</div>
<script>$("#newform").validate();</script>
