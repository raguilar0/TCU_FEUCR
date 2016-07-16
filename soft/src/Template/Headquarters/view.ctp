<div class="row text-center">
    <div class="col-xs-12">
        <h1>Información de la sede</h1>
    </div>

</div>
<br>
<br>

    <table class="table">
        <tr>
            <th><?= __('Nombre') ?></th>
            <td><?= h($headquarters->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Nombre de la imagen') ?></th>
            <td><?= h($headquarters->image_name) ?></td>
        </tr>
    </table>

    <div class="row text-center">
      <div class="col-xs-12">
         <?php
            echo $this->Html->link(
            'Atrás',
            ['controller' => 'Headquarters', 'action' => 'index'], ['class'=>'btn btn-primary']
            );
          ?>
      </div>
    </div>
