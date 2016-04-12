<?php
App::uses('AppHelper','View/Helper');

class CarritoHelper extends AppHelper{
    public function calcularCarrito($productsInCart,$qty,$price){
        $valor = 0;
        $number=0;
        if(isset($productsInCart)){
            foreach ($productsInCart as $productInCart) {
                $valor=$valor + ( $qty[$number] * $price[$number] );
                $number++;
            }
        }

        return $valor;
    }

}

?>