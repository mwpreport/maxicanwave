<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="content-wrapper">
	<div class="event-button-cont">
		<ul class="side-nav">
			<li><?= $this->Form->postLink(
					__('<i class="fa fa-trash" aria-hidden="true"></i> Delete Chemist'),
					['action' => 'delete', $chemist->id],
					['escape' => false, 'confirm' => __('Are you sure you want to delete "{0}"?', $chemist->name)]
				)
			?></li>
			<li><?= $this->Html->link(__('<i class="fa fa-list" aria-hidden="true"></i> List Chemists'), ['action' => 'index'], ['escape' => false]) ?></li>
		</ul>
	</div>
	<div class="chemists form large-9 medium-8 columns content">
		<?= $this->Form->create($chemist, array('id' => 'editform')) ?>
		<fieldset>
			<legend><?= __('Edit Chemist') ?></legend>
			<?php
				echo $this->Form->control('code');
				echo $this->Form->control('name');
				echo $this->Form->control('contact_person');
				echo $this->Form->control('mobile');
				echo $this->Form->control('phone');
			?>
				<div class="input required"><label for="address">Address</label><textarea name="address" required="required" id="address" rows="5"><?= $chemist->address ?></textarea></div>
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
<script>$("#editform").validate();</script>
