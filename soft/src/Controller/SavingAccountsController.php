<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * SavingAccounts Controller
 *
 * @property \App\Model\Table\SavingAccountsTable $SavingAccounts
 */
class SavingAccountsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vist
        $this->paginate = [
            'contain' => ['Associations', 'Tracts']
        ];
        $savingAccounts = $this->paginate($this->SavingAccounts);

        $this->set(compact('savingAccounts'));
        $this->set('_serialize', ['savingAccounts']);
    }

    /**
     * View method
     *
     * @param string|null $id Saving Account id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vist
        $savingAccount = $this->SavingAccounts->get($id, [
            'contain' => ['Associations', 'Tracts']
        ]);

        $this->set('savingAccount', $savingAccount);
        $this->set('_serialize', ['savingAccount']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vist
        $savingAccount = $this->SavingAccounts->newEntity();
        if ($this->request->is('post')) {
            $savingAccount = $this->SavingAccounts->patchEntity($savingAccount, $this->request->data);
            if ($this->SavingAccounts->save($savingAccount)) {
                $this->Flash->success(__('La cuenta de ahorros ha sido guardada.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('La cuenta de ahorros no ha podido ser guardada. Inténtelo de nuevo'));
            }
        }
        $associations = $this->SavingAccounts->Associations->find('list', ['limit' => 200]);
        $tracts = $this->SavingAccounts->Tracts->find('list', ['limit' => 200]);
        $this->set(compact('savingAccount', 'associations', 'tracts'));
        $this->set('_serialize', ['savingAccount']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Saving Account id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vist
        $savingAccount = $this->SavingAccounts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $savingAccount = $this->SavingAccounts->patchEntity($savingAccount, $this->request->data);
            if ($this->SavingAccounts->save($savingAccount)) {
                $this->Flash->success(__('La cuenta de ahorros ha sido guardada.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('La cuenta de ahorros no ha podido ser guardada. Inténtelo de nuevo'));
            }
        }
        $associations = $this->SavingAccounts->Associations->find('list', ['limit' => 200]);
        $tracts = $this->SavingAccounts->Tracts->find('list', ['limit' => 200]);
        $this->set(compact('savingAccount', 'associations', 'tracts'));
        $this->set('_serialize', ['savingAccount']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Saving Account id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vist
        $this->request->allowMethod(['post', 'delete']);
        $savingAccount = $this->SavingAccounts->get($id);
        if ($this->SavingAccounts->delete($savingAccount)) {
            $this->Flash->success(__('La cuenta de ahorros ha sido borrada.'));
        } else {
            $this->Flash->error(__('La cuenta de ahorros no ha podido ser borrada. Inténtelo de nuevo.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function transfer($association_name = null)
    {
        $this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vista


        $headquarters = $this->getHeadquarters(); //Pide todas las sedes
        $tracts[0] = $this->getTracts(date('Y')-1);
        $tracts[1] = $this->getTracts(date('Y'));




        if($this->request->is("POST"))
        {
            if($association_name)
            {
                if($this->request->data['first_tract'] !== $this->request->data['second_tract'])
                {
                    $association_id = $this->getAssociationId($association_name);
                    $first_tract_id = $this->getTractId($this->request->data['first_tract']);
                    $second_tract_id = $this->getTractId($this->request->data['second_tract']);

                    $oldAccount = $this->getAccount($first_tract_id,$association_id);

                    $newAccount['amount'] = $oldAccount['amount'];
                    $newAccount['bank'] = $oldAccount['bank'];
                    $newAccount['account_owner'] = $oldAccount['account_owner'];
                    $newAccount['card_number'] = $oldAccount['card_number'];
                    $newAccount['association_id'] = $association_id;
                    $newAccount['tract_id'] = $second_tract_id;

                    if($this->createSavingAccount($newAccount))
                    {
                        die("Se transfirió la cuenta con éxito");
                    }
                    else
                    {
                        die("No se pudo transferir la cuenta. Intentelo más tarde");
                    }
                }
                else
                {
                    die("Las fechas deben ser distintas");
                }

            }
        }


        $this->set('head',$headquarters);
        $this->set('data', $tracts);

    }

    private function createSavingAccount($newAccount)
    {
        $success = false;
        $savingAccount = $this->SavingAccounts->newEntity($newAccount);

        if ($this->SavingAccounts->save($savingAccount)) {
            $success = true;
        }

        return $success;

    }

    private function getAccount($tract_id,$association_id)
    {
        $account = $this->SavingAccounts->find()
                        ->andWhere(['association_id'=>$association_id, 'tract_id'=>$tract_id]);

        $account = $account->toArray();

        return $account[0];
    }

    private function getHeadquarters()
    {
        $query = $this->SavingAccounts->Associations->Headquarters->find() //Se trae solo las sedes que tienen alguna asocicación asociada :p
        ->hydrate(false)
            ->select(['Headquarters.name'])
            ->join([
                'table'=>'associations',
                'alias'=>'a',
                'type' => 'RIGHT',
                'conditions'=>'Headquarters.id = a.headquarter_id',
            ])
            ->where(['a.enable'=>1])
            ->group(['Headquarters.name']); //Elimina repetidos


        $headquarters = $query->toArray();

        return $headquarters;
    }


    private function getTracts($year)
    {
        $this->loadModel('Tracts');

        $tracts = $this->Tracts->find()
            ->hydrate(false)
            ->where(['YEAR(date)'=>$year]); //Queremos los tractos del año actual
        $tracts = $tracts->toArray();

        return $tracts;
    }

    /**
     *  Esta funcion devuelve el id del presente tracto
     **/
    private function getTractId($actualDate)
    {
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

    private function getAssociationId($association_name)
    {
        $association_id = $this->SavingAccounts->Associations->find() //Se busca primero el id de esa sede por medio del nombre
        ->hydrate(false)
            ->select(['id'])
            ->where(['name'=>$association_name]);

        $association_id = $association_id->toArray();

        return $association_id[0]['id'];
    }

}
