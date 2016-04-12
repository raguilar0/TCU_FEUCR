<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>-->


   
    <title>Contraloría FEUCR</title>
    <?= $this->Html->css('bootstrap.min.css') ?> 

  
    <?= $this->Html->css('admin_views.css') ?>


    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <?php echo $this->Html->meta('favicon.ico','webroot/favicon.ico',array('type' => 'icon'));?>

</head><!--/head-->

<body>


       <nav class="navbar navbar-inverse">
        <div class="container-fluid">
        <div class="navbar-header">

          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>


          <a class="navbar-brand" href="#">FEUCR</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="active"><?php echo $this->Html->link('Administrar Asociaciones', '/associations/', ['id'=>'active-navbar']);?></li>
            <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">Administrar Montos
                  <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                      <li><?php echo $this->Html->link('Agregar Montos', '/amounts/show_associations');?></li>
              </ul>
            </li>

            <li>
              <?php echo $this->Html->link('Asociaciones Deshabilitadas', '/associations/show_disables');?>
            </li>

            <li>
              <?php echo $this->Html->link('Bitácora', '/associations/');?>
            </li>
        </ul>
      </div>
  </div>
</nav>


    <div class="container body">
        
        <?= $this->fetch('content') ?>  
        
        
    </div>


     <?=$this->Html->script('jquery2.js') ?>
     <?=$this->Html->script('bootstrap.min.js') ?>
     <?=$this->Html->script('jquery_association_admin.js') ?>
     <?=$this->Html->script('jquery_associations.js') ?>

</body>
</html>