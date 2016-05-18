<?php

App::uses('AppController', 'Controller');

class ChecksController extends AppController
{
    /*public $helpers = array('Html', 'Form');
	var $components = array('Session');
	var $uses = array('Product', 'Platform', 'Category', 'CategoryProduct', 'Stock','Wishlist','ProductWishlist');
    */
	var $uses = array('Product','Check','CheckProduct','CardUser','User', 'Debitcard', 'DebitcardsUser','Countries','ShippingAddress');
	public function check(){
		
		$address = $this->request->data['Checks']['address'];
		$this->set(compact('address'));
		
		$idUser = $this->Session->read("Auth.User.id");
		$userLocation = $this->ShippingAddress->find('first',array('conditions'=>array('ShippingAddress.id ='=>$address)));
		
		$direccion = $userLocation['ShippingAddress']['address'];
		$this->set(compact('direccion'));
		
		$sendCost = $this->costoEnvio($userLocation['ShippingAddress']['country']);
		$countryName = $this->Countries->find('first',array('conditions'=>array('Countries.id ='=>$userLocation['ShippingAddress']['country'])));
		$countryName = $countryName['Countries']['country_name'];
		$this->set(compact('sendCost'));
		$this->set(compact('countryName'));
        // Extraer numeros de tarjetas tarjetas y pasarlas
        // Debitcard->                Debitcard.card_number              'CardUser.card_id =' => 'Debitcard.id'

        /*$this->set('debitcards', $this->CardUser->find('list', array(
                        'fields' => array('CardUser.card_id'),
                        'conditions' => array('CardUser.user_id =' => $idUser)
                   ))
        );*/

        $cards = $this->CardUser->find('all', array('conditions' => array('CardUser.user_id =' => $idUser)));
        $debitcards = array();
        foreach($cards as $card){
            $debitcards = Hash::merge($debitcards,$this->Debitcard->find('list',array(
                'fields'=>array('Debitcard.card_number'),
                'conditions'=>array('Debitcard.id'=>$card['CardUser']['card_id']))));
        }
        $this->set(compact('debitcards'));
		
        $cart = array();

        if ($this->Session->check('Cart')) {
            $cart = $this->Session->read('Cart');
        }

        $this->set(compact('cart'));
		
		/*$saddress = $this->SaddressUser->find('all',array('conditions' => array('user_id = '=>$idUser)));
		$address = array();
		
		foreach($saddress as $sadres){
			$address = Hash::merge($address,$this->ShippingAddress->find('list',array('fields'=>array('ShippingAddress.address'),'conditions'=>array('id ='=>$sadres['SaddressUser']['address_id']))));
		}
		
		$this->set(compact('address'));*/

        }
	
	public function receipt(){
        // Guardar factura: IDCHECK, idDebit, total,GENERAL_DISCOUNT,DATE
		$total = $this->request->data['Check']['amount'];
		$debCard = $this->request->data['Check']['debcard'];
        $this->set('finalPrice',$total);
		
		$address = $this->request->data['Check']['address'];
		
		$direccion = $this->ShippingAddress->find('first',array('conditions'=>array('id = '=>$address)));
		$direccion = $direccion['ShippingAddress']['address'];
		$this->set(compact('direccion'));

		// Encuentra la tarjeta
        //$debCard = $this->CardUser->find('first',array('conditions'=>array('CardUser.card_id'=>$debCard)));
        //$debCard = $debCard['CardUser']['card_id'];

        // Descuenta de la tarjeta
		$transaction = $this->Debitcard->find('first',array('conditions'=>array('Debitcard.id'=>$debCard)));
		if(($transaction['Debitcard']['balance'] - $total >= 0) && ($transaction['Debitcard']['expiration_date']>date("Y-m-d"))){
			$this->Debitcard->id = $debCard;
			$this->Debitcard->set(array('balance' => $transaction['Debitcard']['balance'] - $total));
			$this->Debitcard->save();
			
			// Aquí se guarda la factura, trayendo los datos del formulario
			$checkId=0;
			if ($this->request->is('post')) {
				// Genera la factura
				$this->Check->create();
				if ($this->Check->save($this->request->data)) {
					$id = $this->request->data['Check']['id'];
					$this->Check->read(null, $id);
					$this->Check->set(['debitcard_id'=>$debCard,'shipping_addresses_id'=>$address, 'amount'=>$total, 'general_discount'=> 0, 'sold_the'=>date("Y-m-d H:i:s")]);
					$this->Check->save();
					$checkId = $this->Check->id;
				}
				
				// Muestra el valor de factura
				$this->set('idCheck',$checkId);
				
				$cart = array();
				if ($this->Session->check('Cart')) {
					$cart = $this->Session->read('Cart');
				}
				$this->set(compact('cart'));
				$number = 0;
				foreach($cart as $key => $product ){
					$discount = $product['Product']['discount'];
					$price = $product['Product']['price'];
					$qty = $this->Session->read('CartQty.'.$number);
					// Guardar items de factura: ID,IDCHECK,IDPRODUCT,DISCOUNT,PRICE,QTY
                    $this->CheckProduct->save();
					$id=$this->CheckProduct->id;
					$this->CheckProduct->set(array(
						'id' => $id,'check_id'=>$checkId,'product_id'=>$product['Product']['id'],'discount'=>$discount,'prize'=>$price,'quantity'=>$qty
					));
					$this->CheckProduct->save();
					$number++;
				}
				$this->Session->delete('Cart');
				$this->Session->delete('CartQty');
				$this->Session->delete('CartPrc');
			}
		
		}

	}

    public function index(){
        // Obtiene el id de usuario
        $idUser = $this->Session->read("Auth.User.id");
        // Obtiene todas las tarjetas a nombre de este usuario
        $debCard= $this->CardUser->find('all',array('conditions'=>array('CardUser.user_id'=>$idUser)));

        // Aqui deberian obtenerse todas las facturas hechas con esas tarjetas (codigo aun no funciona)
        $checks = array();
		foreach($debCard as $card){ 
			//echo $card['CardUser']['card_id'].'<br>';
			//array_push($checks,$this->Check->find('first',array('conditions'=>array('debitcard_id'=>$card['CardUser']['card_id']))));
            $checks = Hash::merge($checks,$this->Check->find('all',array('conditions'=>array('debitcard_id'=>$card['CardUser']['card_id']))));
		}
		$this->set(compact('checks'));
		
        // Aqui deberian obtenerse todos los productos pertenecientes a esas facturas (codigo que aun no funciona)
        //$checksProducts = $this->CheckProduct->find('all',array('conditions'=>array('CheckProduct.check_id'=>$checks)));

    }
	
	public function view($id){
		// Revisar si es el usuario dueño de la factura

        $check = $this->Check->find('first',array('conditions'=>array('check.id'=>$id)));
        //echo $check['Check']['debitcard_id'].'<br>';
        $card = $this->CardUser->find('first',array('conditions'=>array('card_id'=>$check['Check']['debitcard_id'])));
        //echo $card['CardUser']['user_id'];
		$address = $this->ShippingAddress->find('first',array('conditions'=>array('id = '=>$check['Check']['shipping_addresses_id'])));
		$address = $address['ShippingAddress']['address'];
		$this->set(compact('address'));
		

        if($card['CardUser']['user_id'] == $this->Session->read('Auth.User.id') || $this->Session->read("Auth.User.role") == 'admin'){
            $items = $this->CheckProduct->find('all',array('conditions'=>array('check_id'=>$id)));
            $products = array();
            foreach($items as $item){
                //echo $item['CheckProduct']['product_id'].'<br>';
                array_push($products,$this->Product->find('first',array('conditions'=>array('Product.id'=>$item['CheckProduct']['product_id']))));
            }
            $this->set(compact('check'));
            $this->set(compact('items'));
            $this->set(compact('products'));
        }
		
	}

	// verifica cuanto tiempo ha pasado desde la compra y cambia el estado de la factura
    // 0-Enviada --> al min después de la compra
    // 1-EnProceso -->  a los 2min después de la compra
    // 2-Entregada -->  después de los 2min de la compra
    public function cstatus(){
        $checks  = $this->Check->find('all');//, array('fields' => array('Check.id')));
        foreach ($checks as $check):
            if ( (time() - strtotime($check['Check']['sold_the'])) > 60 && (time() - strtotime($check['Check']['sold_the'])) <= 61 ){
                $this->Check->read(null, $check['Check']['id']);
                $this->Check->set('dstatus', 0);
                $this->Check->save();
            }
            if( (time() - strtotime($check['Check']['sold_the'])) > 61 && (time() - strtotime($check['Check']['sold_the'])) <= 120){
                $this->Check->read(null, $check['Check']['id']);
                $this->Check->set('dstatus', 1);
                $this->Check->save();
            }
            if ( (time() - strtotime($check['Check']['sold_the'])) > 120 ){
                $this->Check->read(null, $check['Check']['id']);
                $this->Check->set('dstatus', 2);
                $this->Check->save();
            }
        endforeach;
        unset($checks);
        return $this->redirect(array('action' => 'index'));
    }
	
	public function costoEnvio($num){
		switch($num){
			case 52:
				return 2.99;
			default:
				return 6.99;
		}
	}
	
}

?>