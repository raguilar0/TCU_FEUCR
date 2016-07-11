


<section id="main-slider" class="carousel">
    <div class="carousel-inner">
        <div class="item active">
            <div class="container">
                <div class="carousel-content">
                    <h1>Somos Contraloría Estudiantil</h1>
                    <p class="lead">Transparencia de la gestión</p>
                </div>
            </div>
        </div><!--/.item-->
        <div class="item">
            <div class="container">
                <div class="carousel-content">
                    <h1>Somos Contraloría Estudiantil</h1>
                    <p class="lead">Fiscalizando el movimiento estudiantil</p>
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
                        <h1>¡Ubicá la <b class="yellow_id">Asociación</b> que buscás de acuerdo a la <b class="yellow_id">Sede</b>!</h1>
                    </div>

                </div>


                <?php


                    $data = $data->toArray();


                    $count = count($data);
                    $index = 0; // Contador

                    $rows = ($count / 4);

                    $rows = intval($rows);

                    if(!$rows) //Si la parte entera es 0
                    {
                        $rows = 1;
                    }
                    elseif(($count > 4) and ($count % 4))
                    {
                        ++$rows;
                    }

                ?>

                    <?php  for($i = 0; $i < $rows; ++$i): ?>

                        <?= "<div class='row'>"; ?>



                            <?php for ($j = 0; ($j < 4) && ($index < $count); ++$j): ?>

                                <?= "<div class='col-md-3 col-sm-6'>"; ?>
                                    <?= "<div class='center'>"; ?>

                                        <?php echo $this->Html->image("headquarter/".$data[$index]['image_name'], ['alt' => $data[$index]['name'],
                                                                                'url' => ['controller' => 'Associations', 'action' => 'public-view', $data[$index]['id']]]); ?>

                                        <?php echo "<h4>".$data[$index]['name']."</h4>"; ++$index;?>

                                    <?= "</div>";?>

                              <?= "</div>"; ?>

                            <?php endfor; ?>

                        <?= "</div>" ?>
                    <?php endfor; ?>



                
            </div><!--/.box-->
        </div><!--/.container-->
    </section><!--/#services-->

   
