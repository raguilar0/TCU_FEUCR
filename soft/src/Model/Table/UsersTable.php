<?php
// src/Model/Table/UsersTable.php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Auth\DefaultPasswordHasher;

class UsersTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
        $this->belongsTo('Associations');

    }

    public function validationDefault(Validator $validator)
    {

       $validator


              ->notEmpty('password', 'Contraseña requerida')
              ->add('password', 'validFormat',[
                'rule'=>array('custom', '/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/'),
                'message' => 'Password debe tener mínimo 8 caracteres y al menos un número'
              ])
              ->notEmpty('repass', 'Ingrese su contraseña de nuevo.')
              ->add('repass', [
                      'compare' => [
                                  'rule' => ['compareWith','password'],
                                  'message' => 'Las contraseñas no coinciden.'
                                  ]
              ])
              ->notEmpty('name', 'Nombre requerido')
              ->add('name', 'validFormat', [
                          'rule' => array('custom', '/^[A-Za-z]+$/'),
                          'message' => 'Debe contener únicamente letras.'
              ])
              
              ->notEmpty('last_name_1')
              ->add('last_name_1', 'validFormat', [
                          'rule' => array('custom', '/^[A-Za-z]+$/'),
                          'message' => 'Debe contener únicamente letras.'
              ])
              ->notEmpty('last_name_2')
              ->add('last_name_2', 'validFormat', [
                          'rule' => array('custom', '/^[A-Za-z]+$/'),
                          'message' => 'Debe contener únicamente letras.'
              ])
              ->notEmpty('role')
              ->notEmpty('username')
              ->add('username', 'validFormat', [
                          'rule' => array('custom', '/^[a-z0-9\_\-\.]+@ucr.ac.cr$/'),
                          'message' => 'Debe ser un correo institucional válido.'

              ])
              ;






      return $validator;
    }


        public function validationChangePassword(Validator $validator)
        {
            $validator


              ->notEmpty('password', 'Contraseña requerida')
              ->add('password', 'validFormat',[
                'rule'=>array('custom', '/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/'),
                'message' => 'Password debe tener mínimo 8 caracteres y al menos un número'
              ])
              ->notEmpty('repass', 'Ingrese su contraseña de nuevo.')
              ->add('repass', [
                      'compare' => [
                                  'rule' => ['compareWith','password'],
                                  'message' => 'Las contraseñas no coinciden.'
                                  ]
              ]);

              return $validator;
        }



    public function validationChangePass(Validator $validator)
    {
        $validator
            ->add('old_password','custom',[
                'rule'=>  function($value, $context){
                    $user = $this->get($context['data']['id']);
                    if ($user && (new DefaultPasswordHasher)->check($value, $user->password)) {
                        return true;
                    }
                    return false;
                },
                'message'=>'La contraseña antigua no coincide',
                'errorField' =>'old_password'
            ])
            ->notEmpty('old_password');

        $validator
            ->add('password1', [
                'length' => [
                    'rule' => ['minLength', 8],
                    'message' => 'La contraseña debe ser mínimo de 8 caracteres',
                ]
            ])
            ->add('password1',[
                'match'=>[
                    'rule'=> ['compareWith','password2'],
                    'message'=>'Las contraseñas no son iguales!',
                ]
            ])
            ->notEmpty('password1');

        return $validator;
    }

}
?>
