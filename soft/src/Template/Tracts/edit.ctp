<div class="row text-center">
    <div class="col-xs-12">
        <h1>¡Editá las fechas tractos!</h1>
    </div>

</div>
<br>
<br>

    <?= $this->Form->create($tract) ?>
        <div class="form-group">


            <?= $this->Form->input('number', ['class'=>'form-control', 'label'=>'Número de tracto' , 'min'=>'1', 'max'=>'4', 'id'=>'tract_number']); ?>
            <br>
            <br>
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <label>Fecha de inicio</label>

                    <label for=".date">Fecha de inicio</label><input type='date' name='date' class='form-control' id='date' onchange='setTractNumber(this)' value = "<?php echo $tract->date->format('Y-m-d') ?>">

                </div>
                <div class="col-xs-12 col-md-6">
                    <label style="margin-bottom: 15px;">Fecha de finalización</label>
                    <input type='date' name='deadline' class='form-control' id='deadline'  onchange='setTractNumber(this)' value = "<?php echo $tract->deadline->format('Y-m-d') ?>">

                </div>
            </div>



        </div>

<br>
<br>



    <?= $this->Form->button(__('Guardar'), ['id'=>'asso_id', 'class'=>'form-control']) ?>
    <?= $this->Form->end() ?>

    <br>
		<div class="row text-center">
			<div class="col-xs-12">
				 <?php
						echo $this->Html->link(
						'Atrás',
						['controller' => 'Tracts', 'action' => 'index'], ['class'=>'btn btn-primary']
						);
					?>
			</div>
		</div>

<?= $this->Html->script('tract_add'); ?>