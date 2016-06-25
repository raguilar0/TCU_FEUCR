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
      <th>Numero</th>
      <th>Proveedor</th>
      <th>Resposable</th>
      <th>Monto</th>
			<th>Estado</th>
    </tr>
  </thead>
  <tbody>

      <?php
          foreach ($invoice as $key) {
              echo "<tr>";
              echo "<td>".$key['number']."</td>";
              echo "<td>".$key['provider']."</td>";
              echo "<td>".$key['attendant']."</td>";
              echo "<td>".$key['amount']."</td>";
							//echo "<td>".$key['mail']."</td>";
							if($key['state'] == 0) {
								echo "<td> Sin aprobar </td>";
							}
							if($key['state'] == 1){
									echo "<td> Aprobada </td>";
							}
							echo "<td>".$this->Html->link('','/invoices/modify_invoice/'.$key['id'], ['class'=>'glyphicon glyphicon-pencil btn btn-primary', 'target'=>'_blank'])."  "
							.$this->Form->postLink('', ['action' => 'delete', $key->id], ['class'=>'glyphicon glyphicon-remove btn btn-danger' ,'confirm' => __('¿Estás seguro de que deseas borrarlo? # {0}?', $key->id)]);
          }
      ?>
  </tbody>
</table>
</div>

<div class="row text-center">
  <div class="col-xs-12">
     <?php echo $this->Html->link('Atrás', '/associations/index-associations/', ['class'=>'btn btn-primary']);?>
  </div>
</div>
