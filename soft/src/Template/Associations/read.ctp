
<div class="row text-center">
  <div class="col-xs-12">
    <h1>¡<b>Información</b> completa de la Asociación!</h1>
  </div>
</div>

<br>
<br>

<div class="table-responsive">
  <table class="table read_association">
  <thead>
    <tr>
      <th>Sigla</th>
      <th>Nombre</th>
      <th>Ubicación</th>
      <th>Horario</th>      
      <th>Tarjeta Autorizada</th>
      <th>Sede</th>         
    </tr>
  </thead>
  <tbody>
    <tr>
      <?php
          
          echo "<td>".$data['acronym']."</td>";
          echo "<td>".$data['name']."</td>";
          echo "<td>".$data['location']."</td>";
          echo "<td>".$data['schedule']."</td>";
          echo "<td>".($data['authorized_card'] == 1 ? 'Autorizada':'Sin Autorización')."</td>";
          echo "<td>".$data['headquarter']."</td>";

      ?>
    </tr>
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