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
       <nav class="navbar navbar-inverse">
        <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">FEUCR</a>
        </div>
        <ul class="nav navbar-nav">
          <li class="active"><a href="#">Inicio</a></li>
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Administrar Asociaciones
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
          <li><a href="/association/add">Agregar Asociación</a></li>
        </ul>
      </li>
      <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Administrar Montos
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="http://plataforma-feucr-daemonandrey.c9users.io/soft/amounts">Consultar Montos</a></li>
                <li><a href="http://plataforma-feucr-daemonandrey.c9users.io/soft/amounts/add">Agregar Monto</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>
    </header><!--/#header-->

    <div class="container body">
        
        <?= $this->fetch('content') ?>  
    </div>


     <?=$this->Html->script('jquery.js') ?>
     <?=$this->Html->script('bootstrap.min.js') ?>

</body>
</html>