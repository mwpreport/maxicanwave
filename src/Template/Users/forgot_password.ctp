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
								<h2>Retrieve Password</h2>
								<hr>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12">
								<div class="box-body no-padding">
									<?php echo $this->Form->create(null, array('url' => '/users/forgot_password', 'id' => 'forgetform')); ?>
										<div class="input text required"><?php echo $this->Form->input('User.username', array('class' => 'form-control mar-bottom-10', 'label' => 'Username', 'between'=>'<br />', 'type'=>'text')); ?></div>
										<?= $this->Form->button(__('Submit'), ['class' => 'common-btn blue-btn btn-125 pull-right mar-top-20']); ?>
									<?= $this->Form->end() ?>
								</div>
						</div>
						<div class="clearfix"></div>
						 </div>
</div>
<script>
$("#forgetform").validate();
</script>
