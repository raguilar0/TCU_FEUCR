<!-- src/Template/Users/read.ctp -->

<div class="row text-center">
	<div class="col-xs-12">
		<h1>Edición de Facturas</h1>
	</div>
</div>
<br>
<br>


<div class="table-responsive">
  <table class="table read_association">
  <thead>
    <tr>
       <th> Número</th>
        <th><?= $this->Paginator->sort('kind', ['label'=>'Tipo']) ?></th>
        <th><?= $this->Paginator->sort('date', ['label'=>'Fecha']) ?></th>
        <th>Proveedor</th>
        <th>Responsable</th>
        <th>Monto</th>
        <th><?= $this->Paginator->sort('state',['label'=>'Estado']) ?></th>
        <th class="actions"><?= __('Acciones') ?></th>
    </tr>
  </thead>
  <tbody>

      <?php
          foreach ($invoice as $key) {
              echo "<tr>";
              echo "<td>".$key['number']."</td>";
              switch ($key->kind) {
              case 0:
                  echo "<td> Tracto </td>";
                  break;
              case 1:
                   echo "<td> Ing.Gen. </td>";
                   break;
              default:
                  echo "<td> Superavit </td>";
                  break;

              }
              echo "<td>".$key['date']."</td>";
              echo "<td>".$key['provider']."</td>";
              echo "<td>".$key['attendant']."</td>";
              echo "<td>". "¢ ".h(number_format($key['amount'], 2, ".",","))."</td>";
							switch ($key->state) {
                  case 0:
                      echo "<td> Pendiente </td>";
                      break;
                  case 1:
                       echo "<td> Aprobada </td>";
                       break;
                  default:
                      echo "<td> Rechazada </td>";
                      break;

               }
							echo "<td>".$this->Html->link('','/invoices/modify_invoice/'.$key['id'], ['class'=>'glyphicon glyphicon-pencil btn btn-primary'])."  "
							.$this->Form->postLink('', ['action' => 'delete', $key->id], ['class'=>'glyphicon glyphicon-remove btn btn-danger' ,'confirm' => __('¿Estás seguro de que deseas borrarlo? # {0}?', $key->id)]);
          }
      ?>
  </tbody>
</table>
</div>
