<div class="row text-center">
    <div class="col-xs-12">
        <h1>Información del monto inicial</h1>
    </div>

</div>
<br>
<br>


    <table class="table">
        <tr>
            <th><?= __('Asociación') ?></th>
            <td><?= $initialAmount->has('association') ? $this->Html->link($initialAmount->association->name, ['controller' => 'Associations', 'action' => 'view', $initialAmount->association->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Tracto') ?></th>
            <td><?= $initialAmount->has('tract') ? $this->Html->link($initialAmount->tract->date." - ".$initialAmount->tract->deadline, ['controller' => 'Tracts', 'action' => 'view', $initialAmount->tract->id]) : '' ?></td>
        </tr>

        <tr>
            <th><?= __('Monto') ?></th>
            <td><?= "¢ ".number_format($initialAmount->amount,2,".",",") ?></td>
        </tr>
        <tr>
            <th><?= __('Tipo') ?></th>
            <td><?= $initialAmount->type ? 'Ingresos Generados': 'Tracto' ;//$this->Number->format($initialAmount->type) ?></td>
        </tr>
        <tr>
            <th><?= __('Fecha de asignación') ?></th>
            <td><?= h($initialAmount->date) ?></td>
        </tr>
    </table>

    <br>
    <div class="row text-center">
      <div class="col-xs-12">
         <?php
            echo $this->Html->link(
            'Atrás',
            ['controller' => 'InitialAmounts', 'action' => 'index'], ['class'=>'btn btn-primary']
            );
          ?>
      </div>
    </div>
