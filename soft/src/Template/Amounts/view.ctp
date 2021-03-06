<div class="row text-center">
    <div class="col-xs-12">
        <h1>Información del monto</h1>
    </div>

</div>
<br>
<br>


<table class="table">
    <tr>
        <th><?= __('Asociación') ?></th>
        <td><?= $amount->has('association') ? $this->Html->link($amount->association->name, ['controller' => 'Associations', 'action' => 'view', $amount->association->id]) : '' ?></td>
    </tr>
    <tr>
        <th><?= __('Tracto') ?></th>
        <td><?= $amount->has('tract') ? $this->Html->link($amount->tract->date." - ".$amount->tract->deadline, ['controller' => 'Tracts', 'action' => 'view', $amount->tract->id]) : '' ?></td>
    </tr>

    <tr>
        <th><?= __('Monto') ?></th>
        <td><?= "¢ ".number_format($amount->amount,2,".",",") ?></td>
    </tr>
    <tr>
        <th><?= __('Tipo') ?></th>
        <td><?= $amount->type ? 'Ingresos Generados': 'Tracto' ;//$this->Number->format($initialAmount->type) ?></td>
    </tr>
    <tr>
        <th><?= __('Fecha de asignación') ?></th>
        <td><?= h($amount->date) ?></td>
    </tr>
    <tr>
        <th><?= __('Detalle') ?></th>
        <td><?= h($amount->detail) ?></td>
    </tr>

</table>

<br>
<div class="row text-center">
  <div class="col-xs-12">
     <?php
        echo $this->Html->link(
        'Atrás',
        ['controller' => 'Amounts', 'action' => 'index'], ['class'=>'btn btn-primary']
        );
      ?>
  </div>
</div>
