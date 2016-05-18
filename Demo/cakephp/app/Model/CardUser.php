<?php

class CardUser extends AppModel{

    var $validate = array(
        'user_id' => array('rule' => 'uniqueCombi', 'message' => 'Combinación ya registrada'),
        'card_id'  => array('rule' => 'uniqueCombi', 'message' => 'Combinación ya registrada')
    );
    function uniqueCombi()
    {
        $combi = array(
            "{$this->alias}.user_id" => $this->data[$this->alias]['user_id'],
            "{$this->alias}.card_id"  => $this->data[$this->alias]['card_id']
        );
        return $this->isUnique($combi, false);
    }

    public function bringAllRegisters() {
        return $this->find('all');
    }


    public function removeRegister() {
        $this->delete(1);
        return $this->bringAllRegisters();
    }
}