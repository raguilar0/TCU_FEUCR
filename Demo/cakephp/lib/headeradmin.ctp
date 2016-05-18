<!DOCTYPE html>
<html>

<head>
    <title>Catálogo de la tienda</title>
    <style>

	#header
	{
		text-align: center;
		padding: 0 0 0 0;
		background-color: #fff;
	}

	#header h1
	{
	    padding: 0 0 2.75em 0;
		margin: 0;
	}

	#header h1 a
	{
	    font-family: Helvetica, sans-serif;
	    font-size: 1.5em;
		letter-spacing: -0.025em;
		border: 0;
	}

	#nav
	{
	    height:70px;
		cursor: default;
		background-color: #333;
		background-image: url('http://s12.postimg.org/85kx5f8wt/Abstract_Background_Wallpaper_053.jpg');
		padding: 0;
	}

	#nav > ul
	{
	    margin: 10;
	    margin-top:9px;
	    float:left;
	}

	#nav > ul > li
	{
	    position: relative;
		display: inline-block;
		margin-left: 1em;
	}

	#nav > ul > li a
	{
	    color: #c0c0c0;
		text-decoration: none;
		border: 0;
		display: block;
		padding: 1.5em 0.5em 1.35em 0.5em;
	}

    #nav > ul > li:hover a
    {
	    color: #fff;
	}

	#search_bar
    {
        height:40px;
        text-align: center;
        padding: 0 0 0 0;
    	background-image: url('../img/bg02.png'), url('../img/bg02.png'), url('../img/bg01.png');
    	background-position: top left, top left, top left;
        background-size: 100% 6em, 100% 6em, auto;
        background-repeat: no-repeat, no-repeat, repeat;
        background-image: -webkit-linear-gradient(top, rgba(0,0,0,0), rgba(0,0,0,0.3)), url('../img/bg01.png');
    }

    #s_field
    {
        display:inline;
        font-family: Helvetica, sans-serif;
        font-size:12px;
        color:#000000;
        width:50%;
        float:left;
        text-align:left;
        padding:0.8em;
    }

    #right_side
    {
        float:right;
        margin-right:0.4em;
        padding:10px;
        color: #151515;
    }

    </style>
</head>

<body>

    <div id="header">
		    <nav id="nav">
		        <?php echo $this->Html->link(
            					$this->Html->image('tiendaweb.png', array('alt' => "Inicio", 'title' => 'Inicio','style'=> "margin-left:10px;float:left;width:240px;height:55px;padding:7px;")),
            					array('controller' => 'products', 'action' => 'index'),
            					array('target' => '_self', 'escape' => false)
            				);
            	?>
		        <ul>
                    <li align=center><a>Vista del administrador</a></li>
                    <li align=center><?php echo $this->Html->link('Ventas',array('controller'=>'checkproduct','action' => 'sales'));?></li>
                    <li align=center><?php echo $this->Html->link('Agregar producto',array('controller'=>'products','action' => 'add'));?></li>
                    <li align=center><?php echo $this->Html->link('Ayuda',array('controller'=>'users','action' => 'help'));?></li>
                </ul>
			</nav>
	</div>

	<div id="search_bar">

        <?php echo $this->Html->image('search.png', array('style'=> "float:left;width:20px;height:20px;padding:10px;"));?>

        <div id="s_field">
            <?php  echo $this->Form->create("Products",array('action' => 'search')); ?>
            <?php  echo $this->Form->input("q", array('label' => '', 'title' => 'Búsqueda', 'placeholder' => 'Busque su juego')); ?>
            <?php  echo $this->Form->end("Ir"); ?>
        </div>

        <div id="right_side">
            <?php
                    if($this->Session->read('Auth.User.username')==null)
                    {
                        echo $this->Html->link('Ingresar',array('controller' =>'users','action'=>'login'))."&nbsp&nbsp&nbsp".$this->Html->link('Crear cuenta',array('controller' => 'users', 'action' => 'add')).'</p>';
                    }
                    else
                    {
                        echo 'Conectado como <b>'.$this->Session->read('Auth.User.username').': '.$this->Html->link('Ver perfil',array('controller' =>'users','action'=>'view',$this->Session->read('Auth.User.id'))).'</b>'."&nbsp&nbsp".$this->Html->link('Salir',array('controller' =>'users','action'=>'logout')).'</p>';
                    }
            ?>
        </div>
	</div>

</body>
</html>