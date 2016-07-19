
<div class="row text-center">
	<div class="col-xs-12">
		<h1>¡Administrá los Usuarios!</h1>
	</div>

</div>
<br>
<br>
<div class="table-responsive">

	<table class="table">
		<thead>
		<tr>
			<th><?= $this->Paginator->sort('username',['label'=>'Nombre de usuario']) ?></th>
			<th><?= $this->Paginator->sort('name',['label'=>'Nombre']) ?></th>
			<th><?= $this->Paginator->sort('last_name_1',['label'=>'Primer apellido']) ?></th>
			<th><?= $this->Paginator->sort('last_name_2',['label'=>'Segundo apellido']) ?></th>
			<th><?= $this->Paginator->sort('role',['label'=>'Rol']) ?></th>
			<th><?= $this->Paginator->sort('state',['label'=>'Estado']) ?></th>
			<?php if(($this->request->session()->read('Auth.User.role')) != 'rep'): ?>
			<th><?= $this->Paginator->sort('association_id',['Asociación']) ?></th>
			<?php endif;?>
			<th class="actions"><?= __('Acciones') ?></th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($users as $users): ?>
			<tr>
				<td><?= h($users->username) ?></td>
				<td><?= h($users->name) ?></td>
				<td><?= h($users->last_name_1) ?></td>
				<td><?= h($users->last_name_2) ?></td>
				<td><?= h((($users->role === 'rep')? "Representante":"Administrador")) ?></td>
				<td><?= h((($users->state)? "Bloqueado": "Activo")) ?></td>
			<?php if(($this->request->session()->read('Auth.User.role')) != 'rep'): ?>
				<td><?= $users->has('association') ? $this->Html->link($users->association->name, ['controller' => 'Associations', 'action' => 'view', $users->association->id]) : '' ?></td>
				<?php endif;?>
				<td class="actions">
					<?= $this->Html->link('',['action' => 'modify-user', $users->id], ['class'=>'glyphicon glyphicon-pencil btn btn-primary' ]) ?>
					<?= $this->Form->postLink('', ['action' => 'delete', $users->id], ['class'=>'glyphicon glyphicon-remove btn btn-danger', 'confirm' => __('Estas seguro que deseas bloquearlo? # {0}?', $users->id)]) ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	<div class="paginator">
		<ul class="pagination">
			<?= $this->Paginator->prev('< ' . __('anterior')) ?>
			<?= $this->Paginator->numbers() ?>
			<?= $this->Paginator->next(__('siguiente') . ' >') ?>
		</ul>
		<p><?= $this->Paginator->counter() ?></p>
	</div>
</div>
