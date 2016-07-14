<br>
<br>

<div class="boxes index large-9 medium-8 columns content">
    <div class="table-responsive">
    <table class="table read_association">
        <thead>
            <tr>
            	<th><?= $this->Paginator->sort('type',['label'=>'Tipo']) ?></th>
                <th><?= $this->Paginator->sort('little_amount',['label'=>'Caja chica']) ?></th>
                <th><?= $this->Paginator->sort('big_amount',['label'=>'Caja fuerte']) ?></th>
                <th class="actions"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($boxes as $box): ?>
            <tr>
            	 <?php if($box->type == 0){
                    echo "<td>Tracto</td>";
                }else{
                    echo "<td>Ing. Generados</td>";
                }?>
                <td><?= "¢ ".number_format($box->big_amount,2 ,".",",") ?></td>
                <td><?= "¢ ".number_format($box->little_amount,2,".",",") ?></td>
                <td class="actions">
                    <?= $this->Html->link(__(''), ['action' => 'edit', $box->id], ['class'=>'glyphicon glyphicon-pencil btn btn-primary']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
   
</div>


