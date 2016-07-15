<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Exception\Exception;
use Cake\Datasource\Exception\RecordNotFoundException;

/**
 * Boxes Controller
 *
 * @property \App\Model\Table\BoxesTable $Boxes
 */
class BoxesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index(){
        if(($this->request->session()->read('Auth.User.role')) != 'admin'){
			return $this->redirect($this->Auth->redirectUrl());
		}else{
		    $this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vista
		    $tracts = $this->Boxes->Tracts->find()->select(['id','date','deadline']);
            $temp = array();
    
            foreach ($tracts as $key => $value)
            {
                $temp[$value->id] = $value->date." - ".$value->deadline;
            }
    
            $tracts = $temp;
		    $this->paginate = [
            'contain' => ['Associations','Tracts']
            ];
            
            $boxes = $this->paginate($this->Boxes);
            $this->set(compact('boxes'));
            $this->set('_serialize', ['boxes']);
		}
    }

    /**
     * View method
     *
     * @param string|null $id Box id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null){
        try
        {
            $box = $this->Boxes->get($id, [
                'contain' => ['Associations']
            ]);

            $this->set('box', $box);
            $this->set('_serialize', ['box']);
        }
        catch (RecordNotFoundException $e)
        {
            $this->Flash->error(__('La información que está tratando de recuperar no existe en la base de datos. Verifique e intente de nuevo'));
            return $this->redirect(['action' => 'index']);
        }

    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
   /* public function add(){
        $box = $this->Boxes->newEntity();
        if ($this->request->is('post')) {
            $box = $this->Boxes->patchEntity($box, $this->request->data);
            if ($this->Boxes->save($box)) {
                $this->Flash->success(__('The box has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The box could not be saved. Please, try again.'));
            }
        }
        $associations = $this->Boxes->Associations->find('list', ['limit' => 200]);
        $this->set(compact('box', 'associations'));
        $this->set('_serialize', ['box']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Box id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null){
        if(($this->request->session()->read('Auth.User.role')) == 'admin' || ($this->request->session()->read('Auth.User.role')) == 'rep'){

            try
            {
                $this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vista
                $tracts = $this->Boxes->Tracts->find()
                    ->select(['id','date','deadline'])
                    ->where(['YEAR(date)'=>date('Y')])
                    ->orWhere(['YEAR(date)'=>(date('Y') + 1)])
                    ->orWhere(['YEAR(date)'=>(date('Y') - 1)]);
                $temp = array();
                $invoices_type = array('Tracto'=> 0, 'Ingresos Generados'=> 1);

                foreach ($tracts as $key => $value)
                {
                    $temp[$value->id] = $value->date." - ".$value->deadline;
                }
                $tract = $temp;
                $box = $this->Boxes->get($id, [
                    'contain' => ['Tracts']
                ]);
                if ($this->request->is(['patch', 'post', 'put'])) {
                    $box = $this->Boxes->patchEntity($box, $this->request->data);
                    if ($this->Boxes->save($box)) {
                        $this->Flash->success(__('La caja fue modificada correctamente'));
                        if(($this->request->session()->read('Auth.User.role')) != 'rep'){
                            return $this->redirect(['action' => 'index']);
                        }else{
                            return $this->redirect(['action' => 'modify']);
                        }
                    } else {
                        $this->Flash->error(__('La caja no pudo ser guardada. Por favor intente de nuevo.'));
                    }
                }
                $associations = $this->Boxes->Associations->find('list');
                $tracts = $this->Boxes->Tracts->find('list');
                $this->set(compact('box', 'associations', 'tracts'));
                $this->set('_serialize', ['box']);
                $this->set('data', $tract);
            }
            catch (RecordNotFoundException $e)
            {
                $this->Flash->error(__('La información que está tratando de recuperar no existe en la base de datos. Verifique e intente de nuevo'));
                return $this->redirect(['action' => 'index']);
            }

            
        }else{
		    return $this->redirect($this->Auth->redirectUrl());
		}
    }

    /**
     * Delete method
     *
     * @param string|null $id Box id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        try
        {
            $box = $this->Boxes->get($id);

            try
            {
                if ($this->Boxes->delete($box)) {
                    $this->Flash->success(__('La caja se borró correctamente'));
                } else {
                    $this->Flash->error(__('La caja no pudo ser borrada. Intente nuevamente'));
                }
                return $this->redirect(['action' => 'index']);
            }
            catch (\PDOException $e)
            {
                $this->Flash->error(__('Error al borrar la caja. Es posible que esta caja tenga información asociada, debe borrar dicha información e intentar de nuevo.'));
                return $this->redirect(['action' => 'index']);
            }

        }
        catch (RecordNotFoundException $record)
        {
            $this->Flash->error(__('La información que está tratando de recuperar no existe en la base de datos. Verifique e intente de nuevo'));
            return $this->redirect(['action' => 'index']);
        }



    }
    
    public function modify(){
		if(($this->request->session()->read('Auth.User.role')) != 'rep'){
			return $this->redirect($this->Auth->redirectUrl());
		}
		else{
			$id = $this->request->session()->read('Auth.User.association_id');
			$this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vista
			$actualDate = date("Y-m-d");
			$tract_id = $this->getTractId($actualDate) ;
			$boxes = $this->Boxes->find()
						->select(['id','type','little_amount','big_amount'])
						->andwhere(['association_id'=>$id,'tract_id' =>$tract_id]);
			$boxes = $boxes->toArray();
			if($this->request->is(array('post','put'))){
				if($boxes != []){
					$box = $this->Boxes->newEntity($this->request->data);
					$query = $this->Boxes->query();
					$query->update()
						  ->set(['big_amount'=> $this->request->data['big_amount'], 'little_amount'=>$this->request->data['little_amount']])
						  ->andwhere(['association_id'=> $id,'tract_id'=> $tract_id])
						  ->execute();
					$boxes = $this->Boxes->find()
						->select(['little_amount','big_amount'])
						->andwhere(['association_id'=>$id,'tract_id' =>$tract_id]);
					$boxes = $boxes->toArray();
					
				}
			}
			$this->set('boxes',$boxes);
		}
	}
	
	private function getTractId($actualDate){
		$this->loadModel('Tracts');
		//$actualDate = date("Y-m-d");
		$id = $this->Tracts->find()
					->hydrate(false)
					->select(['id'])
					->where(function ($exp) use($actualDate) {
                        return $exp
                        	->lte('date',$actualDate)
                        	->gte('deadline',$actualDate);
                    });
        $id = $id->toArray();
		return $id[0]['id'];
	}
	
	
	public function isAuthorized($user)
    {


        if(in_array($this->request->action, ['modify', 'edit'])){
        	  return true;
        }
    
        return parent::isAuthorized($user);
    }
}
