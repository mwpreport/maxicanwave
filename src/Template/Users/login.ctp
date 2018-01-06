<?php ?>
<div class="login-form-container">
    <div class="logo mar-bottom-30"><?php
        echo $this->Html->link(
                $this->Html->image('/img/logo.png'),
                array('controller' => 'users','action' => 'login'), array('escape' => false)); ?>
    </div>
    <div class="login-form"><?php
        echo $this->Form->create('login',array('id'=>'loginForm','autocomplete'=>'off')); ?>
            <div class="form-group">
                <label for="email1" class="col-sm-3 control-label">Email</label>
                <div class="col-sm-9">
                    <input type="email" class="form-control required" id="email1" placeholder="Email" name="email">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-3 control-label">Password</label>
                <div class="col-sm-9">
                    <input type="password" class="form-control required" id="inputPassword3" placeholder="Password" name="password">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <p>
                        <a href="javascript:void(0);" id="forgot-form">I Forgot My Password</a>
                    </p>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="common-btn blue-btn btn-125">Sign in</button>
                </div>
            </div><?php
        echo $this->Form->end();    
        echo $this->Form->create(null ,array('url' => '/users/forgot_password','id'=>'forgotForm','autocomplete'=>'off')); ?>
            <div class="form-group">
                <label for="email2" class="col-sm-3 control-label">Email</label>
                <div class="col-sm-9">
                    <input type="email" class="form-control required" id="email2" placeholder="Email" name="email">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <p>
                        <a href="javascript:void(0);" id="login-form">Login</a>
                    </p>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="common-btn blue-btn btn-125">Send me</button>
                </div>
            </div><?php
        echo $this->Form->end(); ?>
    </div>
</div>
<script>
$("#loginForm").validate();
$("#forgotForm").validate();
</script>

