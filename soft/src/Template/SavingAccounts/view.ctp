<div class="row text-center">
    <div class="col-xs-12">
        <h1>Información de la cuenta de ahorro</h1>
    </div>

</div>
<br>
<br>

<div class="table-responsive">

    <table class="table">
        <tr>
            <th><?= __('Banco') ?></th>
            <td><?= h($savingAccount->bank) ?></td>
        </tr>
        <tr>
            <th><?= __('Dueño de la tarjeta') ?></th>
            <td><?= h($savingAccount->account_owner) ?></td>
        </tr>
        <tr>
            <th><?= __('Número de cuenta') ?></th>
            <td><?= h($savingAccount->card_number) ?></td>
        </tr>
        <tr>
            <th><?= __('Asociación') ?></th>
            <td><?= $savingAccount->has('association') ? $this->Html->link($savingAccount->association->name, ['controller' => 'Associations', 'action' => 'view', $savingAccount->association->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Tracto') ?></th>
            <td><?= $savingAccount->has('tract') ? $this->Html->link($savingAccount->tract->date." - ".$savingAccount->tract->deadline, ['controller' => 'Tracts', 'action' => 'view', $savingAccount->tract->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Monto') ?></th>
            <td><?= "¢ ".number_format($savingAccount->amount,2,".",",") ?></td>
        </tr>
        <tr>
            <th><?= __('Fecha') ?></th>
            <td><?= h($savingAccount->date) ?></td>
        </tr>
    </table>
</div>


<br>
<div class="row text-center">
  <div class="col-xs-12">
     <?php
        echo $this->Html->link(
        'Atrás',
        ['controller' => 'SavingAccounts', 'action' => 'index'], ['class'=>'btn btn-primary']
        );
      ?>
  </div>
</div>
