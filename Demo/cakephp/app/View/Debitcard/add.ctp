<!DOCTYPE html>
<html>

<head>
    <style>

        #container
        {
            width:100%;
            font-family: Helvetica, Geneva, sans-serif;
            color: gray;
        }

        .usersform
        {
            width:50%;
            margin:0 auto;
            margin-top:2%;
            background-color: #fff;
            color: black;
            border:solid 1px #dcdcdc;
            padding:10px;
        }

        #registro input
        {
            float:right;
        }
    </style>
</head>

<body>

<div id="container">

    <div class="usersform">
    <?php echo $this->Form->create('Debitcard'); ?>
        <fieldset id="registro">
            <legend><?php echo __('Crear una tarjeta'); ?></legend>
            <?php
                echo $this->Form->input('card_number',array('title' => 'Número de tarjeta', 'label' => 'Número de tarjeta '));
                echo "<br><br>";
                echo $this->Form->input('nip',array('type' => 'password', 'title' => 'NIP', 'label' => 'Número de identificación personal (NIP) '));
                echo "<br><br>";
                echo $this->Form->input('csc',array('type' => 'password', 'title' => 'Código de seguridad', 'label' => 'Código de seguridad (CSC) '));
                echo "<br><br>";
                echo $this->Form->input('expiration_date', array(
                                        'type' => 'date',
                                        'min' => '11-11-2014',
                                        'max' => '12-31-2019',
                                        'title' => 'Fecha de vencimiento',
                                        'label' => 'Fecha de vencimiento '
                                        ));
                echo "<br><br><br><br><br>";
                echo "Marca";
                echo $this->Form->select('brand', array(
                                    'Visa' => 'Visa',
                                    'Master Card' => 'Master Card',
                                    'American Express' => 'American Express'
                                ));
                echo "<br><br>";
                echo $this->Form->input('balance',array('title' => 'Saldo', 'label' => 'Saldo '));
                echo "<br><br>";
            ?>
        </fieldset>
    <?php echo $this->Form->end(__('Guardar')); ?>
    </div>

</div>
</body>
</html>