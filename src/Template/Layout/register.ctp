<?php
/**
 * For login page
 */
$cakeDescription = 'MaxicanWave Pharma';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">    
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $this->Url->image('favicon.ico')?>">
    <title><?= $cakeDescription ?> : <?= $title ?></title>
    <?= $this->Html->css([
                            'bootstrap.min.css', 
                            'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css', 
                            'https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css',
                            'AdminLTE.min.css',
                            '/plugins/iCheck/square/blue.css',
                            'stylesheet.css']);?>
    <?= $this->Html->script(['/plugins/jQuery/jquery-2.2.3.min','https://code.jquery.com/ui/1.11.4/jquery-ui.min.js',
                            'bootstrap.min','custom',
							'/plugins/jQuery/jquery-2.2.3.min',
							'https://code.jquery.com/ui/1.11.4/jquery-ui.min.js',
							'/js/jquery.validate.js'
							]); ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body  class="hold-transition loginpage">
    <div class="login-container">
        <div class="login-left">
            <div class="login-lft-container"></div>
        </div>
        <div class="login-right">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
            <footer>
                <div class="footer-copyright">Copyright © Mexican Wave Pharma. All Rights Reserved.</div>
            </footer>
        </div>
    </div>    
</body>
</html>
