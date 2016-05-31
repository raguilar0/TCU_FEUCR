<!-- File: src/Template/Users/login.ctp -->

<div class="container body">
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

    <?php

    echo $this->Form->create();

    echo "<div class='form-group' id=form_login>";
      echo "<div class = 'row text-center'>";
        echo "<div class = 'col-xs-12 col-md-6 col-md-offset-3'>";
          echo "<h4> Por favor digite su usuario y contraseña </h4>";
          echo "<hr />";

              echo "<h4>".$this->Form->input('username', ['class' => 'form-control','label'=>'Nombre de usuario'])."</h4>";
              echo "<h4>".$this->Form->input('password', ['class' => 'form-control','label'=>'Contraseña'])."</h4>";

        echo "</div>";
      echo "</div>";
    echo "</div>";

      echo "<div class = 'row'>";
          echo "<div class = 'col-xs-12'>";
             echo "<h4>".$this->Form->submit('Ingresar', ['class' => 'form-control', 'id' => 'submit_btn'])."</h4>";
          echo "</div>";
      echo "</div>";


    echo $this->Form->end();

    ?>
</div>