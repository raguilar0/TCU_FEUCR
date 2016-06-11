<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php echo $this->Html->meta('favicon.ico','webroot/favicon.ico',array('type' => 'icon'));?>
    <title>Administración</title>

    <!-- Bootstrap Core CSS -->

    <?= $this->Html->css('bootstrap.min.css') ?>

    <!-- Custom CSS -->
    <?= $this->Html->css('sb-admin.css') ?>
    <?= $this->Html->css('layout.css') ?>

    <!-- Morris Charts CSS -->
    <?= $this->Html->css('plugins/morris.css') ?>
    <!-- Custom Fonts -->
    <?= $this->Html->css('css/font-awesome.min.css') ?>

    <?= $this->Html->css('admin_views.css') ?>

    <?=$this->Html->script('jquery2.js') ?>

    <?= $this->Html->css('jquery-ui/jquery-ui.min.css') ?>
    <?=$this->Html->script('jquery_association_admin.js') ?>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>


</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <?php echo $this->Html->link('Inicio',['controller'=>'pages','action'=>'home'], ['class'=>'navbar-brand']);?>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">


                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> John Smith <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a  data-toggle="collapse" data-target="#association_id">Asociaciones</a>
                        <div id="association_id" class="collapse">
                            <ul>
                                <li><?php echo $this->Html->link('Nueva Asociación',['controller'=>'Associations','action'=>'add']);?></li><br>
                                <li><?php echo $this->Html->link('Ver Asociación',['controller'=>'Associations','action'=>'show_associations/1']);?></li><br>
                                <li><?php echo $this->Html->link('Editar Asociación',['controller'=>'Associations','action'=>'show_associations/3']);?></li><br>
                                <li><?php echo $this->Html->link('Borrar Asociación',['controller'=>'Associations','action'=>'show_associations/4']);?></li><br>

                            </ul>
                        </div>
                    </li>

                    <li>
                        <a  data-toggle="collapse" data-target="#tracts_id">Montos</a>
                        <div id="tracts_id" class="collapse">
                            <ul>
                                <li><?php echo $this->Html->link('Nuevo Tracto',['controller'=>'Tracts','action'=>'add']);?></li><br>
                                <li><?php echo $this->Html->link('',['controller'=>'Associations','action'=>'show_associations/5']);?></li><br>
                                <li><?php echo $this->Html->link('Editar Montos',['controller'=>'Amounts','action'=>'show_associations/1']);?></li><br>

                            </ul>
                        </div>
                    </li>


                    <li>
                        <a  data-toggle="collapse" data-target="#amounts_id">Montos</a>
                        <div id="amounts_id" class="collapse">
                            <ul>
                                <li><?php echo $this->Html->link('Nuevo Monto',['controller'=>'Amounts','action'=>'add']);?></li><br>
                                <li><?php echo $this->Html->link('Ver Montos Detallados',['controller'=>'Associations','action'=>'show_associations/5']);?></li><br>
                                <li><?php echo $this->Html->link('Editar Montos',['controller'=>'Amounts','action'=>'show_associations/1']);?></li><br>

                            </ul>
                        </div>
                    </li>
                    <li>
                        <a  data-toggle="collapse" data-target="#categories_id">Tipos de Platillos</a>
                        <div id="categories_id" class="collapse">
                            <ul>
                                <li><?php echo $this->Html->link('Nuevo Tipo',['controller'=>'Categories','action'=>'add']);?></li><br>
                                <li><?php echo $this->Html->link('Administrar Tipos',['controller'=>'Categories','action'=>'index']);?></li><br>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <a  data-toggle="collapse" data-target="#headquarters_id">Menús</a>
                        <div id="headquarters_id" class="collapse">
                            <ul>
                                <li><?php echo $this->Html->link('Nuevo Menú',['controller'=>'MenusDishesCategories','action'=>'add']);?></li><br>
                                <li><?php echo $this->Html->link('Administrar Menús',['controller'=>'MenusDishesCategories','action'=>'index']);?></li><br>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <a  data-toggle="collapse" data-target="#restaurants_id">Sodas</a>
                        <div id="restaurants_id" class="collapse">

                            <ul>
                                <li><?php echo $this->Html->link('Nueva Soda',['controller'=>'Restaurants','action'=>'add']);?></li><br>
                                <li><?php echo $this->Html->link('Administrar Sodas',['controller'=>'Restaurants','action'=>'index']);?></li><br>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <a  data-toggle="collapse" data-target="#headquarters_id">Sedes</a>
                        <div id="headquarters_id" class="collapse">
                            <ul>
                                <li><?php echo $this->Html->link('Nueva Sede',['controller'=>'Headquarters','action'=>'add']);?></li><br>
                                <li><?php echo $this->Html->link('Administrar Sedes',['controller'=>'Headquarters','action'=>'index']);?></li><br>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <?= $this->fetch('content') ?>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <?=$this->Html->script('jquery.js') ?>
    <?=$this->Html->script('jquery_association_admin.js') ?>
    <!-- Bootstrap Core JavaScript -->

    <?=$this->Html->script('bootstrap.min.js') ?>

    <!-- Morris Charts JavaScript -->

    <?=$this->Html->script('plugins/morris/raphael.min.js') ?>
    <?=$this->Html->script('plugins/morris/morris.min.js') ?>
    <?=$this->Html->script('plugins/morris/morris-data.js') ?>





    <?=$this->Html->script('modernizr/modernizr-custom.js') ?>
    <?=$this->Html->script('jquery-ui/jquery-ui.min.js') ?>


</body>

</html>
