<div class = 'row text-center'>
    <div class = 'col-xs-12'>
        <h1>Bienvenido <?= $this->request->session()->read('Auth.User.username');?></h1>
    </div>
</div>