<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Calendar</title>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo $this->Url->image('favicon.ico')?>">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="<?php echo $this->Url->css('bootstrap.min.css')?>">
        <link rel="stylesheet" href="<?php echo $this->Url->css('font-awesome.min.css')?>">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="<?php echo $this->Url->css('../plugins/fullcalendar/fullcalendar.min.css')?>">
        <link rel="stylesheet" href="<?php echo $this->Url->css('../plugins/fullcalendar/fullcalendar.print.css')?>" media="print">
        <link rel="stylesheet" href="<?php echo $this->Url->css('../dist/css/AdminLTE.min.css')?>">
        <link rel="stylesheet" href="<?php echo $this->Url->css('../dist/css/skins/skin-red-light.min.css')?>">
        <link rel="stylesheet" href="<?php echo $this->Url->css('../plugins/magnific/magnific-popup.css')?>" type="text/css">
        <link rel="stylesheet" href="<?php echo $this->Url->css('../plugins/datepicker/datepicker3.css')?>">
        <link rel="stylesheet" href="<?php echo $this->Url->css('stylesheet.css')?>">
    </head>
    <body class="skin-red-light sidebar-mini">
        <div class="wrapper">

			<?php
			echo $this->element('includes/header'); 
			echo $this->element('includes/menu'); 
			echo $this->Flash->render();
        echo $this->fetch('content');
        //echo $this->element('mr/footer'); ?>
    </div>
</body>    
</html>        

