<?php

App::uses('AppController', 'Controller');

class ProductsController extends AppController
{
    public $helpers = array('Html', 'Form');
	var $components = array('Session');
	var $uses = array('Product', 'Platform', 'Category', 'CategoryProduct', 'Stock','Wishlist','ProductWishlist','Countries','SaddressUser','ShippingAddress');

	
	public function index()
    {
		$this->set('products', $this->Product->find("all", array('conditions' => array("Product.enabled = 1"))));

		if($this->Session->read("Auth.User.role") == 'admin'){
            $this->set('role','admin');
			$this->set('products', $this->Product->find("all"));
        }
        else{
            $this->set('role','cust');
			$this->set('products', $this->Product->find("all", array('conditions' => array("Product.enabled = 1"))));
        }
		
		$this->set('categorylist',$this->Category->generateTreeList(
            null,
            null,
            null,
            ' • '
        ));
    }
	
	public function beforeFilter()
    {
        parent::beforeFilter();
        // Permite a usuarios no registrados buscar.
        $this->Auth->allow('search', 'filterStock');
    }

    public function view($id = null)
    {
        if(!$id)
        {
            throw new NotFoundException(__('Invalid product'));
        }

        $product = $this->Product->findById($id);
        if (!$product) {
            throw new NotFoundException(__('Invalid product'));
        }
		$this->set('platform', $this->Product->Platform->find('first', array('conditions' => array('Platform.id' == $product['Product']['platform_id']))));
		$this->set('categories', $this->Product->Category->find('list'));
		$this->set('cant', $this->Product->Stock->find('first', array('conditions' => array('Stock.product_id' == $product['Product']['id']))));
        $this->set('product', $product);
		
		$user =  $this->Session->read("Auth.User.id");
        $wish = $this->Wishlist->field('id', array('user_id ' => $user));

        if($this->ProductWishlist->field('id',array('wishlist_id'=>$wish,'product_id'=>$id)) != null){
            $this->set('in_list','1');
        }
        else{
            $this->set('in_list','0');
        }

    }
	
	// added in sprint 3
	public function enableOrDisable($id = null) {
		if($this->Session->read("Auth.User.role") == 'admin') {
			if (!$id) {
				throw new NotFoundException(__('Invalid product'));
			}

			$product = $this->Product->findById($id);
			if (!$product) {
				throw new NotFoundException(__('Invalid product'));
			}

			$this->Product->read(null, $id);
			if( $product['Product']['enabled'] == FALSE){
				$this->Product->set('enabled', 1);
			}
			if( $product['Product']['enabled'] == TRUE){
				$this->Product->set('enabled', 0);
			}
			$this->Product->save();
			return $this->redirect(array('action' => 'index'));
				
		}else{
            $this->Session->setFlash(__('Acceso no permitido.'));
            return $this->redirect(array('action' => 'index'));
        }
    }
	
	public function edit($id = null) {
		if($this->Session->read("Auth.User.role") == 'admin') {
			$this->set('platforms', $this->Platform->find('list'));
			$this->set('categories', $this->Category->find('list'));
			if (!$id) {
				throw new NotFoundException(__('Invalid product'));
			}

			$product = $this->Product->findById($id);
			if (!$product) {
				throw new NotFoundException(__('Invalid product'));
			}
			
			$this->set('cant', $this->Product->Stock->find('first', array('conditions' => array('Stock.product_id' == $product['Product']['id']))));

			if ($this->request->is(array('product', 'put'))) {
				$this->Product->id = $id;
				if ($this->Product->save($this->request->data)) {
					$stock_id = $this->Stock->find('first', array('conditions' => array('Stock.product_id' == $id)));
					$this->Stock->id = $stock_id; 
					$this->Stock->saveField('amount', $this->request->data['Product']['amount']);
					if($this->request->data['Product']['archivo']['error'] == 0 &&  $this->request->data['Product']['archivo']['size'] > 0){
						// Informacion del tipo de archivo subido $this->data['Product']['archivo']['type']
						//$destino = WWW_ROOT.'uploads'.DS;
						$destino = WWW_ROOT.'img'.DS;
						move_uploaded_file($this->request->data['Product']['archivo']['tmp_name'], $destino.$this->request->data['Product']['archivo']['name']);
						$id = $this->request->data['Product']['id'];
						$this->Product->read(null, $id);
						$this->Product->set('image', $this->request->data['Product']['archivo']['name']);
						$this->Product->save();
					}
					$this->Session->setFlash(__('El producto se ha actualizado.'));
					return $this->redirect(array('action' => 'index'));
				}
				$this->Session->setFlash(__('No se pudo guardar los cambios.'));
			}

			if (!$this->request->data) {
				$this->request->data = $product;
			}
		}else{
            $this->Session->setFlash(__('Acceso no permitido.'));
            return $this->redirect(array('action' => 'index'));
        }
    }
	
	//necesito recibir la plataforma, la categoría y la cantidad.
    //meto una entrada en stocks con la cantidad
    //recibo un array con la lista de categorías a las q pertenece el producto y meto por cada entrada en el array, una nueva entrada en categories_products
    //en amount viene la cantidad
    //en category viene el array de categorías
	public function add() {
		if($this->Session->read("Auth.User.role") == 'admin') {
			$this->set('platforms', $this->Platform->find('list'));
			$this->set('categories', $this->Category->find('list'));
			if ($this->request->is('post')) { 
				$this->Product->create();
				if ($this->Product->save($this->request->data)) {
					$this->Product->Stock->save(['product_id'=>$this->Product->id, 'amount'=>$this->request->data['Product']['amount']]);
					if($this->request->data['Product']['archivo']['error'] == 0 &&  $this->request->data['Product']['archivo']['size'] > 0){
					  // Informacion del tipo de archivo subido $this->data['Product']['archivo']['type']
					  //$destino = WWW_ROOT.'uploads'.DS;
					  $destino = WWW_ROOT.'img'.DS;
					  move_uploaded_file($this->request->data['Product']['archivo']['tmp_name'], $destino.$this->request->data['Product']['archivo']['name']);
					  $id = $this->request->data['Product']['id'];
					  $this->Product->read(null, $id);
					  $this->Product->set('image', $this->request->data['Product']['archivo']['name']);
					  $this->Product->save();

					}
					$this->Session->setFlash(__('Your product has been saved.'));
					return $this->redirect(array('action' => 'index'));
				}
				$this->Session->setFlash(__('Unable to add your product.'));
			}
		}else{
            $this->Session->setFlash(__('Acceso no permitido.'));
            return $this->redirect(array('action' => 'index'));
        }
    }
	
    public function delete($id)
    {
		if($this->Session->read("Auth.User.role") == 'admin') {
			if ($this->request->is('get'))
			{
				throw new MethodNotAllowedException();
			}

			if ($this->Product->delete($id))
			{
				/*$this->Session->setFlash(
					__('The post with id: %s has been deleted.', h($id))
				);*/
				return $this->redirect(array('action' => 'index'));
			}
		}else{
            $this->Session->setFlash(__('Acceso no permitido.'));
            return $this->redirect(array('action' => 'index'));
        }
    }
	
	function filterStock() {
       $this->set('results', $this->Product->find("all", array('conditions' => array("Product.outofstock != 1"))));
	   $this->set('categorylist',$this->Category->generateTreeList(
            null,
            null,
            null,
            ' • '
        ));
    }
	
    function search() {
        if (isset($this->request->data['Products']['q'])) {
            $con = $this->request->data['Products']['q'];
        } else {
            $con = "";
        }

        $this->set('results',$this->Product->find('all',array(
            'conditions' =>  array (
                'OR' => array(
                    'Product.name LIKE' => '%'.$con.'%',
                    'Product.release_year LIKE' => '%'.$con.'%',
                    'Product.description LIKE' => '%'.$con.'%',
                    'Platform.name LIKE' => '%'.$con.'%',
                )

            )
        )));
		
		$this->set('categorylist',$this->Category->generateTreeList(
            null,
            null,
            null,
            ' • '
        ));
    }

    public function agregarCarrito($id,$price){

        $this->Product->id = $id;
        if (!$this->Product->exists()) {
            throw new NotFoundException(__('Invalid product'));
        }else{
            $productsInCart = $this->Session->read('Cart');
            $number = 0;
            $alreadyIn = false;
            foreach ($productsInCart as $productInCart) {
                if ($productInCart['Product']['id'] == $id) {
                    $alreadyIn = true;
                    // aumentar cantidad del objeto actual y actualizar el precio
                    $this->Session->write('CartQty.'.$number , $this->Session->read('CartQty.'.$number) + 1 );
                    $this->Session->write('CartPrc.'.$number, $price);
                    /* CHEQUEAR SI HAY EN STOCK*/
                }
                $number++;
            }
            if(!$alreadyIn){
                // agregar al carrito
                $this->Session->write('Cart.' . $number, $this->Product->read(null, $id));
                $this->Session->write('CartQty.'.$number, 1);
                $this->Session->write('CartPrc.'.$number, $price);
                /* CHEQUEAR SI HAY EN STOCK*/
            }
        }
        //return $this->redirect(array('action' => 'index'));
        return $this->redirect(Controller::referer());
    }

    public function carrito(){
        $cart = array();

        if ($this->Session->check('Cart')) {
            $cart = $this->Session->read('Cart');
        }

        $this->set(compact('cart'));
		
		$idUser = $this->Session->read("Auth.User.id");
		
		$saddress = $this->SaddressUser->find('all',array('conditions' => array('user_id = '=>$idUser)));
		$address = array();
		
		foreach($saddress as $sadres){
			$address = Hash::merge($address,$this->ShippingAddress->find('list',array('fields'=>array('ShippingAddress.address'),'conditions'=>array('id ='=>$sadres['SaddressUser']['address_id']))));
		}
		
		$this->set(compact('address'));
		
    }

    public function eliminarCarrito($id){
        if (is_null($id)) {
            throw new NotFoundException(__('Invalid request'));
        }
        if ($this->Session->delete('Cart.' . $id)) {
            $cart = $this->Session->read('Cart');
            sort($cart);
            $this->Session->write('Cart', $cart);

            $this->Session->delete('CartQty.'.$id);
            $cartqty = $this->Session->read('CartQty');
            sort($cartqty);
            $this->Session->write('CartQty',$cartqty);

            $this->Session->delete('CartPrc.'.$id);
            $cartprc = $this->Session->read('CartPrc');
            sort($cartprc);
            $this->Session->write('CartPrc',$cartprc);

        }
        return $this->redirect(array('action' => 'carrito'));
    }

    public function vaciar(){
        $this->Session->delete('Cart');
        $this->Session->delete('CartQty');
        $this->Session->delete('CartPrc');
        return $this->redirect(array('action'=>'index'));
    }
	
	public function discount(){
        $this->set('products', $this->Product->find("all", array('conditions' => array("Product.enabled = 1",'Product.discount > 0'))));

        if($this->Session->read("Auth.User.role") == 'admin'){
            $this->set('role','admin');
            $this->set('products', $this->Product->find("all",array('conditions'=>array('Product.discount > 0'))));
        }
        else{
            $this->set('role','cust');
            $this->set('products', $this->Product->find("all", array('conditions' => array("Product.enabled = 1",'Product.discount > 0'))));
        }

        $this->set('categorylist',$this->Category->generateTreeList(
            null,
            null,
            null,
            ' • '
        ));

    }

}
?>