<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Contraloría FEUCR</title>
    <?= $this->Html->css('bootstrap.min.css') ?>
  
    <?= $this->Html->css('views.css') ?>


    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head><!--/head-->

<body

    <header id="header" role="banner">
        <div class="container">
            <div id="navbar" class="navbar navbar-default">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html"></a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="../pages/home"><i class="glyphicon glyphicon-home"></i></a></li>
                        <li><a href="#services">Admin</a></li>
                        <li><a href="#portfolio">Admin</a></li>
                        <li><a href="#pricing">Admin</a></li>
                        <li><a href="#about-us">Admin</a></li>
                        <li><a href="#contact">Admin</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header><!--/#header-->

    <div class="container body">
        
        <?= $this->fetch('content') ?>  
    </div>


     <?=$this->Html->script('jquery.js') ?>
     <?=$this->Html->script('bootstrap.min.js') ?>

</body>
</html>