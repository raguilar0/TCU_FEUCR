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



    <?=$this->Html->script('jquery2.js') ?>

    <?= $this->Html->css('jquery-ui/jquery-ui.min.css') ?>

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
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <?php echo $this->request->session()->read('Auth.User.name')." ".$this->request->session()->read('Auth.User.last_name_1'); ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><?php echo $this->Html->link('Perfil',['controller'=>'Users','action'=>'perfil']);?></li><br>
                        <li><?php echo $this->Html->link('Cerrar Sesión',['controller'=>'Users','action'=>'logout']);?></li>
                    </ul>
                </li>
            </ul>

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <?php
              if(($this->request->session()->read('Auth.User.role')) == 'admin'){ ?>
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav side-nav">
                        <li class="active">
                            <a  data-toggle="collapse" data-target="#head_id">Sedes</a>
                            <div id="head_id" class="collapse">
                                <ul>
                                    <li><?php echo $this->Html->link('Nueva Sede',['controller'=>'Headquarters','action'=>'add']);?></li><br>
                                    <li><?php echo $this->Html->link('Administrar Sedes',['controller'=>'Headquarters','action'=>'index']);?></li><br>

                                </ul>
                            </div>
                        </li>
                        <li class="active">
                            <a  data-toggle="collapse" data-target="#association_id">Asociaciones</a>
                            <div id="association_id" class="collapse">
                                <ul>
                                    <li><?php echo $this->Html->link('Nueva Asociación',['controller'=>'Associations','action'=>'add']);?></li><br>
                                    <li><?php echo $this->Html->link('Administrar Asociaciones',['controller'=>'Associations','action'=>'index']);?></li><br>

                                </ul>
                            </div>
                        </li>

                        <li class="active">
                          <?php echo $this->Html->link('Administrar Facturas',['controller'=>'Invoices','action'=>'modify']);?>
                        </li>

                        <li class="active">
                          <?php echo $this->Html->link('Administrar Cajas',['controller'=>'Boxes','action'=>'modify']);?>
                        </li>

                        <li class="active">
                            <a  data-toggle="collapse" data-target="#tract_id">Fechas de Tracto</a>
                            <div id="tract_id" class="collapse">
                                <ul>
                                    <li><?php echo $this->Html->link('Nuevo Tracto',['controller'=>'Tracts','action'=>'add']);?></li><br>
                                    <li><?php echo $this->Html->link('Administrar Tractos',['controller'=>'Tracts','action'=>'index']);?></li><br>
                                </ul>
                            </div>
                        </li>

                        <li class="active">
                            <a  data-toggle="collapse" data-target="#amounts_id">Montos de Tracto</a>
                            <div id="amounts_id" class="collapse">
                                <ul>
                                    <li><?php echo $this->Html->link('Nuevo Monto',['controller'=>'Amounts','action'=>'add']);?></li><br>
                                    <li><?php echo $this->Html->link('Ver Montos Detallados',['controller'=>'Associations','action'=>'show_associations/5']);?></li><br>
                                    <li><?php echo $this->Html->link('Editar Montos',['controller'=>'Amounts','action'=>'show_associations/1']);?></li><br>

                                </ul>
                            </div>
                        </li>

                        <li class="active">
                            <a  data-toggle="collapse" data-target="#initial_id">Montos Iniciales</a>
                            <div id="initial_id" class="collapse">
                                <ul>
                                    <li><?php echo $this->Html->link('Nuevo Monto',['controller'=>'initial-amounts','action'=>'add']);?></li><br>
                                    <li><?php echo $this->Html->link('Administrar montos',['controller'=>'initial-amounts','action'=>'index']);?></li><br>

                                </ul>
                            </div>
                        </li>

                        <li class="active">
                            <a  data-toggle="collapse" data-target="#account_id">Cuentas de Ahorro</a>
                            <div id="account_id" class="collapse">
                                <ul>
                                    <li><?php echo $this->Html->link('Nueva Cuenta',['controller'=>'Saving-accounts','action'=>'add']);?></li><br>
                                    <li><?php echo $this->Html->link('Transferir cuentas',['controller'=>'Saving-accounts','action'=>'transfer']);?></li><br>
                                    <li><?php echo $this->Html->link('Administrar Montos',['controller'=>'Saving-accounts','action'=>'index']);?></li><br>

                                </ul>
                            </div>
                        </li>
                        
                        <li class="active">
                            <a  data-toggle="collapse" data-target="#surplus_id">Montos de Superávit</a>
                            <div id="surplus_id" class="collapse">
                                <ul>
                                    <li><?php echo $this->Html->link('Nuevo Monto',['controller'=>'Surpluses','action'=>'add']);?></li><br>
                                    <li><?php echo $this->Html->link('Administrar Montos',['controller'=>'Surpluses','action'=>'index']);?></li><br>

                                </ul>
                            </div>
                        </li>

                        <li class="active">
                            <a  data-toggle="collapse" data-target="#saving_id">Montos de Ahorro</a>
                            <div id="saving_id" class="collapse">
                                <ul>
                                    <li><?php echo $this->Html->link('Nuevo Monto',['controller'=>'Savings','action'=>'add']);?></li><br>
                                    <li><?php echo $this->Html->link('Administrar Montos',['controller'=>'Savings','action'=>'index']);?></li><br>

                                </ul>
                            </div>
                        </li>

                        <li class="active">
                            <a  data-toggle="collapse" data-target="#user_id">Usuarios</a>
                            <div id="user_id" class="collapse">
                                <ul>
                                    <li><?php echo $this->Html->link('Agregar Usuarios', '/users/add/');?></li><br>
                                    <li><?php echo $this->Html->link('Ver Ususarios','/users/show_associations/1');?></li><br>
                                    <li><?php echo $this->Html->link('Editar Usuarios','/users/show_associations/3');?></li><br>

                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>

            <?php
            }
            if($this->request->session()->read('Auth.User.role') == 'rep'){ ?>

              <div class="collapse navbar-collapse navbar-ex1-collapse">
                  <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a  data-toggle="collapse" data-target="#association_admin">Administrar Asociación</a>
                        <div id="association_admin" class="collapse">
                            <ul>
                              <li class="active"><?php echo $this->Html->link('Agregar Nueva Factura', '/invoices/add', ['id'=>'active-navbar']);?></li><br>
                              <li class="active"><?php echo $this->Html->link('Administrar Facturas', '/invoices/modify', ['id'=>'active-navbar']);?></li><br>
                              <li class="active"><?php echo $this->Html->link('Actualizar Cajas', '/boxes/modify', ['id'=>'active-navbar']);?></li><br>
                            </ul>
                        </div>
                    </li>

                    <li class="active">
                        <?php echo $this->Html->link('Solicitar Monto de Ahorro', '/savings/add');?>
                    </li>
                    

                    <li class="active">
                      <?php echo $this->Html->link('Información General', '/associations/general_information/');?>
                    </li>

                    <li class="active">
                        <a  data-toggle="collapse" data-target="#user_id">Usuarios</a>
                        <div id="user_id" class="collapse">
                            <ul>
                                <li><?php echo $this->Html->link('Agregar Usuarios', '/users/add/');?></li><br>
                                <li><?php echo $this->Html->link('Ver Ususarios','/users/read/');?></li><br>
                                <li><?php //echo $this->Html->link('Editar Usuarios','/users/modify/');?></li><br>

                            </ul>
                        </div>
                    </li>

                  </ul>
              </div>

            <?php
            }
              ?>


            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <?= $this->fetch('content') ?>

                <?= $this->Flash->render() ?>

            </div>
            <!-- /.container-fluid -->


        </div>
        <!-- /#page-wrapper -->


    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <!-- Bootstrap Core JavaScript -->

    <?=$this->Html->script('bootstrap.min.js') ?>
    <?=$this->Html->script('jquery.js') ?>
    <?=$this->Html->script('jquery_association_admin.js') ?>


    <!-- Morris Charts JavaScript -->

    <?=$this->Html->script('plugins/morris/raphael.min.js') ?>
    <?=$this->Html->script('plugins/morris/morris.min.js') ?>
    <?=$this->Html->script('plugins/morris/morris-data.js') ?>





    <?=$this->Html->script('modernizr/modernizr-custom.js') ?>
    <?=$this->Html->script('jquery-ui/jquery-ui.min.js') ?>


    <?=$this->Html->script('jspdf.min.js') ?>
    <?=$this->Html->script('html2canvas.js') ?>


</body>

</html>
