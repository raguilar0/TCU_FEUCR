<br>
<br>
<br>
<br>
<br>
<br>

<div class="container">



    <div class="row center">
        <div class="col-xs-12">

            <?php
                $data = $data->toArray();
                if(count($data))
                {
                    echo "<h1>¡Elegí una asociación!</h1>";
                }
                else
                {
                    echo "<h1>No hay asociaciones registradas para esta sede </h1>";
                }
            ?>



        </div>
    </div>





    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <?php

    $rows = 0;

    if(count($data))
    {
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
    }


    ?>

    <?php  for($i = 0; $i < $rows; ++$i): ?>

        <?= "<div class='row'>"; ?>



        <?php for ($j = 0; ($j < 4) && ($index < $count); ++$j): ?>

            <?= "<div class='col-md-3 col-sm-6'>"; ?>
            <?= "<div class='center'>"; ?>

            <?php
            echo $this->Html->image('ico/association.png',['alt'=>'logo', 'id'=>'association_icon', 'url'=>['controller' => 'Associations', 'action' => 'public-detailed-information', $data[$index]['id']]]);
            echo "<br />";
            echo "<strong>".$this->Html->link($data[$index]['acronym'],['controller' => 'Associations', 'action' => 'public-detailed-information', $data[$index]['id']])."</strong>";
            ++$index
            ?>


            <?= "</div>";?>

            <?= "</div>"; ?>

        <?php endfor; ?>

        <?= "</div>" ?>
    <?php endfor; ?>

</div>
