<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Contraloría FEUCR</title>
    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('font-awesome.min.css') ?>
    <?= $this->Html->css('prettyPhoto.css') ?>
    <?= $this->Html->css('main.css') ?>



    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head><!--/head-->

<body data-spy="scroll" data-target="#navbar" data-offset="0">

     <?= $this->fetch('content') ?>

     <?=$this->Html->script('jquery.js') ?>
     <?=$this->Html->script('bootstrap.min.js') ?>
     <?=$this->Html->script('jquery.isotope.min.js') ?>
     <?=$this->Html->script('jquery.prettyPhoto.js') ?>
     <?=$this->Html->script('main.js') ?>

</body>
</html>
