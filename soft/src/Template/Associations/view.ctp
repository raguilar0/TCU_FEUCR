<div class="row text-center">
    <div class="col-xs-12">
        <h1>Información de la asociación</h1>
    </div>

</div>
<br>
<br>


    <table class="table">
        <tr>
            <th><?= __('Sigla') ?></th>
            <td><?= h($association->acronym) ?></td>
        </tr>
        <tr>
            <th><?= __('Nombre') ?></th>
            <td><?= h($association->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Dirección') ?></th>
            <td><?= h($association->location) ?></td>
        </tr>
        <tr>
            <th><?= __('Horario') ?></th>
            <td><?= h($association->schedule) ?></td>
        </tr>
        <tr>
            <th><?= __('Sede') ?></th>
            <td><?= $association->has('headquarters') ? $this->Html->link($association->headquarters->name, ['controller' => 'Headquarters', 'action' => 'view', $association->headquarters->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Tarjeta autorizada') ?></th>
            <td><?= ($this->Number->format($association->authorized_card) ? 'Aprobada': 'Reprobada' ); ?></td>
        </tr>
        <tr>
            <th><?= __('Estado') ?></th>
            <td><?= ($this->Number->format($association->enable) ? 'Habilitada': 'Deshabilitada' ); ?></td>
        </tr>
    </table>


    <br>

    <div class="row text-center">
      <div class="col-xs-12">
         <?php
            echo $this->Html->link(
            'Atrás',
            ['controller' => 'Associations', 'action' => 'index'], ['class'=>'btn btn-primary']
            );
          ?>
      </div>
    </div>
