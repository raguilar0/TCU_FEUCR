<?php
/**
 * Created by PhpStorm.
 * User: Iva
 * Date: 18/10/14
 * Time: 11:41 PM
 */

class CheckProduct extends AppModel{
    public $hasToMany = array('Product');
    public $BelongsToMany = array('Check');
}
?>