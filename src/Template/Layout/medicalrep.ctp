<?php
/**
 * For MR Interface
 */
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">   
    <title>Mexican Wave Pharma</title>
    <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?= $this->Html->css([
                            '/bootstrap/css/bootstrap.min.css', 
                            'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', 
                            'https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css',
                            '/dist/css/AdminLTE.min.css',
                            '/dist/css/skins/skin-red-light.min.css',
                            'stylesheet.css',
                            '/plugins/iCheck/flat/blue.css',
                            '/plugins/morris/morris.css',
                            '/plugins/jvectormap/jquery-jvectormap-1.2.2.css',
                            '/plugins/datepicker/datepicker3.css',
                            '/plugins/daterangepicker/daterangepicker.css',
                            '/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',
                            '/plugins/datatables/dataTables.bootstrap.css',
                            '/plugins/magnific/magnific-popup.css'
                        ]);?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
	<?php echo $this->Html->script([
			'/plugins/jQuery/jquery-2.2.3.min',
			'https://code.jquery.com/ui/1.11.4/jquery-ui.min.js',
            '/js/jquery.validate.js',
			 ]); ?>        
    <?= $this->fetch('script') ?>
    
</head>
<body class="hold-transition skin-red-light sidebar-mini">
    <div class="wrapper"><?php
        echo $this->element('mr/header'); 
        echo $this->element('mr/menu'); 
        echo $this->Flash->render();
        echo $this->fetch('content');
        echo $this->element('mr/footer'); ?>
    </div>
</body>    
</html>        

