
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
                        <li class="active"><a href="#main-slider"><i class="glyphicon glyphicon-home"></i></a></li>
                        <li><a href="#asociaciones">Asociaciones</a></li>
                        <li><a href="#future-1">Futuro</a></li>
                        <li><a href="#future-2">Futuro</a></li>
                        <li><a href="#acerca-de">Acerca de</a></li>
                        <li><a href="#contacto">Contáctanos</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header><!--/#header-->

    <section id="main-slider" class="carousel">
        <div class="carousel-inner">
            <div class="item active">
                <div class="container">
                    <div class="carousel-content">
                        <h1>Somos UCR</h1>
                        <p class="lead">La UCR es la mejor universidad Centroamericana</p>
                    </div>
                </div>
            </div><!--/.item-->
            <div class="item">
                <div class="container">
                    <div class="carousel-content">
                        <h1>Somos la Contraloría</h1>
                        <p class="lead">Poner texto aquí</p>
                    </div>
                </div>
            </div><!--/.item-->
        </div><!--/.carousel-inner-->
        <a class="prev" href="#main-slider" data-slide="prev"><i class="icon-angle-left"></i></a>
        <a class="next" href="#main-slider" data-slide="next"><i class="icon-angle-right"></i></a>
    </section><!--/#main-slider-->

    <section id="asociaciones">
        <div class="container">

            <div class="box first">
                <div class="row text-center texto">
                    <div class="col-md-12 col-sm-12">
                        <h1>¡Ubicá la <b>Asociación</b> que buscás de acuerdo a la <b>Sede</b>!</h1>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-3 col-sm-6">
                        <div class="center">
                           <?php echo $this->Html->image('sedes/sede_central.jpg', ['alt' => 'Sede Central']);?>

                            <h4>Sede Central</h4>
                        </div>
                    </div><!--/.col-md-4-->


                    <div class="col-md-3 col-sm-6">
                        <div class="center">
                           <?php echo $this->Html->image('sedes/sede_occidente.png', ['alt' => 'sede_occidente']);?>

                            <h4>Sede de Occidente</h4>

                        </div>
                    </div><!--/.col-md-4-->
                    <div class="col-md-3 col-sm-6">
                        <div class="center">
                           <?php echo $this->Html->image('sedes/sede_atlantico.jpg', ['alt' => 'Sede Atlántico']);?>

                            <h4>Sede del Atlántico</h4>

                        </div>

                    </div><!--/.col-md-4-->


                    <div class="col-md-3 col-sm-6">
                        <div class="center">
                           <?php echo $this->Html->image('sedes/sede_guanacaste.jpg', ['alt' => 'Sede de Guanacaste']);?>

                            <h4>Sede de Guanacaste</h4>

                        </div>
                    </div><!--/.col-md-4-->

                </div>

                <div class="row">


                    <div class="col-md-3 col-sm-6">
                        <div class="center">
                           <?php echo $this->Html->image('sedes/sede_pacífico.jpg', ['alt' => 'Sede del pacífico']);?>

                            <h4>Sede del Pacífico</h4>

                        </div>
                    </div><!--/.col-md-4-->
                    <div class="col-md-3 col-sm-6">
                        <div class="center">
                           <?php echo $this->Html->image('sedes/sede_interuniversitaria.jpg', ['alt' => 'Sede interuniversitaria']);?>                        

                            <h4>Sede Interuniversitaria de Alajuela</h4>

                        </div>
                    </div><!--/.col-md-4-->


                   <div class="col-md-3 col-sm-6">
                        <div class="center">
                           <?php echo $this->Html->image('sedes/recinto_golfito.jpg', ['alt' => 'Recinto de Golfito']);?> 

                            <h4>Recinto de Golfito</h4>

                        </div>
                    </div><!--/.col-md-4-->


                </div>
            </div><!--/.box-->
        </div><!--/.container-->
    </section><!--/#services-->

    <section id="future-1">
        <div class="container">
            
        </div><!--/.container-->
    </section>

    <section id="future-2">
        <div class="container">
            
        </div>
    </section>

    <section id="acerca-de">
        <div class="container">
            <div class="box">
                <div class="center">
                    <h2>Conoce al equipo</h2>
                    <p class="lead">Poner acá los integrantes de la contraloría </p>
                </div>
                <div class="gap"></div>
                <div id="team-scroller" class="carousel scale">
                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="member">
                                        <p><img class="img-responsive img-thumbnail img-circle" src="img/team1.jpg" alt="" ></p>
                                        <h3>Agnes Smith<small class="designation">CEO &amp; Founder</small></h3>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="member">
                                        <p><img class="img-responsive img-thumbnail img-circle" src="img/team2.jpg" alt="" ></p>
                                        <h3>Donald Ford<small class="designation">Senior Vice President</small></h3>
                                    </div>
                                </div>        
                                <div class="col-sm-4">
                                    <div class="member">
                                        <p><img class="img-responsive img-thumbnail img-circle" src="img/team3.jpg" alt="" ></p>
                                        <h3>Karen Richardson<small class="designation">Assitant Vice President</small></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="member">
                                        <p><img class="img-responsive img-thumbnail img-circle" src="img/team3.jpg" alt="" ></p>
                                        <h3>David Robbins<small class="designation">Co-Founder</small></h3>
                                    </div>
                                </div>   
                                <div class="col-sm-4">
                                    <div class="member">
                                        <p><img class="img-responsive img-thumbnail img-circle" src="img/team1.jpg" alt="" ></p>
                                        <h3>Philip Mejia<small class="designation">Marketing Manager</small></h3>
                                    </div>
                                </div>     
                                <div class="col-sm-4">
                                    <div class="member">
                                        <p><img class="img-responsive img-thumbnail img-circle" src="img/team2.jpg" alt="" ></p>
                                        <h3>Charles Erickson<small class="designation">Support Manager</small></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="left-arrow" href="#team-scroller" data-slide="prev">
                        <i class="icon-angle-left icon-4x"></i>
                    </a>
                    <a class="right-arrow" href="#team-scroller" data-slide="next">
                        <i class="icon-angle-right icon-4x"></i>
                    </a>
                </div><!--/.carousel-->
            </div><!--/.box-->
        </div><!--/.container-->
    </section><!--/#about-us-->

    <section id="contacto">
        <div class="container">
            <div class="box last">
                <div class="row">
                    <div class="col-sm-6">
                        <h1>Formulario de Contacto</h1>
                        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
                        <div class="status alert alert-success" style="display: none"></div>
                        <form id="main-contact-form" class="contact-form" name="contact-form" method="post" action="sendemail.php" role="form">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" required="required" placeholder="Nombre">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" required="required" placeholder="Dirección de Correo">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Mensaje"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-danger btn-lg">Enviar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div><!--/.col-sm-6-->
                    <div class="col-sm-6">
                        <h1>Nuestra Dirección</h1>
                        <div class="row">
                            <div class="col-md-6">
                                <address>
                                    <strong>Twitter, Inc.</strong><br>
                                    795 Folsom Ave, Suite 600<br>
                                    San Francisco, CA 94107<br>
                                    <abbr title="Phone">P:</abbr> (123) 456-7890
                                </address>
                            </div>
                            <div class="col-md-6">
                                <address>
                                    <strong>Twitter, Inc.</strong><br>
                                    795 Folsom Ave, Suite 600<br>
                                    San Francisco, CA 94107<br>
                                    <abbr title="Phone">P:</abbr> (123) 456-7890
                                </address>
                            </div>
                        </div>
                        <h1>Redes Sociales</h1>
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="social">
                                    <li><a href="#"><i class="icon-facebook icon-social"></i> Facebook</a></li>
                                    <li><a href="#"><i class="icon-google-plus icon-social"></i> Google Plus</a></li>
                                    <li><a href="#"><i class="icon-pinterest icon-social"></i> Pinterest</a></li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="social">
                                    <li><a href="#"><i class="icon-linkedin icon-social"></i> Linkedin</a></li>
                                    <li><a href="#"><i class="icon-twitter icon-social"></i> Twitter</a></li>
                                    <li><a href="#"><i class="icon-youtube icon-social"></i> Youtube</a></li>
                                </ul>
                            </div>
                        </div>
                    </div><!--/.col-sm-6-->
                </div><!--/.row-->
            </div><!--/.box-->
        </div><!--/.container-->
    </section><!--/#contact-->

    <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    &copy; 2013 <a target="_blank" href="http://shapebootstrap.net/" title="Free Twitter Bootstrap WordPress Themes and HTML templates">ShapeBootstrap</a>. All Rights Reserved.
                </div>
                <div class="col-sm-6">
                    <img class="pull-right" src="img/shapebootstrap.png" alt="ShapeBootstrap" title="ShapeBootstrap">
                </div>
            </div>
        </div>
    </footer><!--/#footer-->
