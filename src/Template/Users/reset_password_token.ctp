<?php ?>
<div class="login-form-container">
    <div class="logo mar-bottom-30"><?php
        echo $this->Html->link(
                $this->Html->image('/img/logo.png'),
                array('controller' => 'users','action' => 'login'), array('escape' => false)); ?>
    </div>
    <div class="login-form">
						<div class="col-md-12">
							<div class="hr-title">
								<h2>Change Your Password</h2>
								<hr>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12">
								<div class="box-body no-padding">
									<?php echo $this->Form->create(null, array('url' => 'reset_password_token', 'id' => 'rsetform')); ?>
										<?php echo $this->Form->hidden('User.reset_password_token'); ?>
										<div class="input text required"><?php echo $this->Form->input('User.new_passwd',  array('class' => 'form-control mar-bottom-10','type' => 'password', 'label' => 'Password', 'between' => '<br />', 'type' => 'password') ); ?></div>
										<div class="input text required"><?php echo $this->Form->input('User.confirm_passwd',  array('class' => 'form-control mar-bottom-10','type' => 'password', 'label' => 'Confirm Password', 'between' => '<br />', 'type' => 'password') ); ?></div>
										<?= $this->Form->button(__('Submit'), ['class' => 'common-btn blue-btn btn-125 pull-right mar-top-20']); ?>
									<?= $this->Form->end() ?>
								</div>
						</div>
						<div class="clearfix"></div>
						 </div>
</div>
<script>
$("#rsetform").validate();
</script>
