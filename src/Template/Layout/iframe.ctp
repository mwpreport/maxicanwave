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
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $this->Url->image('favicon.ico')?>">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?= $this->Html->css([
                            '/bootstrap/css/bootstrap.min.css', 
                            'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', 
                            'https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css',
                            '/dist/css/AdminLTE.min.css',
                            '/dist/css/skins/skin-red-light.min.css',
                            '/plugins/iCheck/flat/blue.css',
                            '/plugins/jvectormap/jquery-jvectormap-1.2.2.css',
                            '/plugins/datepicker/datepicker3.css',
                            '/plugins/daterangepicker/daterangepicker.css',
                            '/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',
                            '/plugins/datatables/dataTables.bootstrap.css',
                            '/plugins/magnific/magnific-popup.css',
                            'stylesheet.css'
                        ]);?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
	<?php echo $this->Html->script([
			'/plugins/jQuery/jquery-2.2.3.min',
			'https://code.jquery.com/ui/1.11.4/jquery-ui.min.js',
            '/js/jquery.validate.js',
                '/bootstrap/js/bootstrap.min',
                '/plugins/slimScroll/jquery.slimscroll.min',
                '/plugins/fastclick/fastclick',
                '/dist/js/app.min',
                '/dist/js/demo',
                '/plugins/datatables/jquery.dataTables.min',
                '/plugins/datatables/dataTables.bootstrap.min',
                '/plugins/magnific/jquery.magnific-popup.min',
                'custom',
                '/plugins/sparkline/jquery.sparkline.min',
                '/plugins/jvectormap/jquery-jvectormap-1.2.2.min',
                '/plugins/jvectormap/jquery-jvectormap-world-mill-en',
                '/plugins/knob/jquery.knob',
                'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js',
                '/plugins/daterangepicker/daterangepicker',
                '/plugins/datepicker/bootstrap-datepicker',
                'https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js',
                '/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min',
                '/js/jquery.mask.js',
                '/dist/js/pages/dashboard'
			 ]); ?>        
    <?= $this->fetch('script') ?>

</head>
<body class="hold-transition skin-red-light sidebar-mini">
    <div class="wrapper"><?php
		echo $this->Flash->render();
        echo $this->fetch('content');
        ?>
    </div>
</body>    
</html>        

