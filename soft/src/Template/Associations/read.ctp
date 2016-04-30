<div class="row text-center">
    <div class="col-xs-12">
        <h1> <?php echo $data['name'].' ('.$data['acronym'].')';?> </h1>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-md-4">
        <h3><b>Ubicación</b></h3>
    </div>

    <div class="col-xs-12 col-md-8">
        <h3><?php echo $data['location'];?> </h3>
    </div>

</div>

<hr>

<div class="row">
    <div class="col-xs-12 col-md-4">
        <h3><b>Horario</b></h3>
    </div>

    <div class="col-xs-12 col-md-8">
          <h3><?php echo $data['schedule'];?> </h3>
        
    </div>   

</div>

<hr>

<div class="row">
    <div class="col-xs-12 col-md-4">
        <h3><b>Tarjeta Autorizada</b></h3>
    </div>

    <div class="col-xs-12 col-md-8">
          <h3><?php echo ($data['authorized_card'] == 1 ? 'Autorizada':'Sin Autorización');?> </h3>
        
    </div>

</div>

<hr>


<div class="row">
    <div class="col-xs-12 col-md-4">
        <h3><b>Sede</b></h3>
    </div>

    <div class="col-xs-12 col-md-8">
          <h3><?php echo $data['headquarter'];?> </h3>
        
    </div>  

</div>

<hr>


<br>
<br>


<div class="row text-center">
    <div class="col-xs-12">
      <h2>Montos de Tracto</h2>
    </div>

</div>

<br>

<div class="table-responsive">
  <table class="table tables">
  <thead>
    <tr>
      <th>#</th>
      <th>Cantidad Asignada</th>
      <th>Fecha de Asignación</th>      
      <th>Fecha de Inicio del Tracto</th>
      <th>Fecha de Fin del Tracto</th>
      <th>Total en Gastos</th>              
      <th>Saldo</th>   
    </tr>
  </thead>
  <tbody>


      <?php

          foreach ($data['amounts'] as $key => $value) {
             echo "<tr>";
              echo "<td>".$value['tract']['number']."</td>";
              echo "<td>".$value['amount']."</td>";
              echo "<td>".$value['date']."</td>";              
              echo "<td>".$value['tract']['date']."</td>";
              echo "<td>".$value['tract']['deadline']."</td>";
              echo "<td>".$value['spent']."</td>";                        
              echo "<td>".($value['amount']-$value['spent'])."</td>";   
             echo "</tr>";
          }
      ?>




  </tbody>
</table>
</div>

<br>
<br>

<div class="row text-center">
  <div class="col-xs-12">
     <?php echo $this->Html->link('Atrás', '/associations/show_associations/1', ['class'=>'btn btn-primary']);?>
  </div>
</div>