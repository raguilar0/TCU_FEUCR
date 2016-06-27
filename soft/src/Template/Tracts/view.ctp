<div class="row text-center">
    <div class="col-xs-12">
        <h1>Información del tracto</h1>
    </div>

</div>
<br>
<br>

<div class="table-responsive">
    <table class="table">

        <tr>
            <th><?= __('Número') ?></th>
            <td><?= $this->Number->format($tract->number) ?></td>
        </tr>
        <tr>
            <th><?= __('Fecha de Inicio') ?></th>
            <td><?= h($tract->date) ?></td>
        </tr>
        <tr>
            <th><?= __('Fecha de Finalización') ?></th>
            <td><?= h($tract->deadline) ?></td>
        </tr>
    </table>
</div>




