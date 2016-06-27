<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Exception\Exception;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

/**
 * Savings Controller
 *
 * @property \App\Model\Table\SavingsTable $Savings
 */
class SavingsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->viewBuilder()->layout('admin_views');
        $this->paginate = [
            'contain' => ['Associations', 'Tracts']
        ];
        $savings = $this->paginate($this->Savings);

        $this->set(compact('savings'));
        $this->set('_serialize', ['savings']);
    }

    /**
     * View method
     *
     * @param string|null $id Saving id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->viewBuilder()->layout('admin_views');
        $saving = $this->Savings->get($id, [
            'contain' => ['Associations', 'Tracts']
        ]);

        $this->set('saving', $saving);
        $this->set('_serialize', ['saving']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->viewBuilder()->layout('admin_views');

        $saving = $this->Savings->newEntity();
        if ($this->request->is('post')) {

            $this->loadComponent('Upload');

            $letter = $this->request->data['letter'];
            unset($this->request->data['letter']); //Quitamos los datos del archivo

            $letter_name = $this->Upload->savePDF($letter);

            if(!empty($letter) && $letter_name)
            {
                $this->request->data['letter'] = $letter_name;
                $saving = $this->Savings->patchEntity($saving, $this->request->data);
                if ($this->Savings->save($saving)) {
                    $this->Flash->success(__('The saving has been saved.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('The saving could not be saved. Please, try again.'));
                }
            }
            else
            {
                $this->Flash->error(__('No se pudo guardar el archivo, por favor intente de nuevo más tarde.'));
            }
            
            
            

        }
        $associations = $this->Savings->Associations->find('list');

        $tracts = $this->Savings->Tracts->find()
            ->select(['id','date','deadline'])
            ->where(['YEAR(date)'=>date('Y')])
            ->orWhere(['YEAR(date)'=>(date('Y') + 1)]);
        $temp = array();

        foreach ($tracts as $key => $value)
        {
            $temp[$value->id] = $value->date." - ".$value->deadline;
        }

        $tracts = $temp;

        $this->set(compact('saving', 'associations', 'tracts'));
        $this->set('_serialize', ['saving']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Saving id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->viewBuilder()->layout('admin_views');
        $saving = $this->Savings->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $saving = $this->Savings->patchEntity($saving, $this->request->data);
            if ($this->Savings->save($saving)) {
                $this->Flash->success(__('The saving has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The saving could not be saved. Please, try again.'));
            }
        }
        $associations = $this->Savings->Associations->find('list');
        $tracts = $this->Savings->Tracts->find()
                                        ->select(['id','date','deadline'])
                                        ->where(['YEAR(date)'=>date('Y')])
                                        ->orWhere(['YEAR(date)'=>(date('Y') + 1)])
                                        ->orWhere(['YEAR(date)'=>(date('Y') - 1)]);
        $temp = array();

        foreach ($tracts as $key => $value)
        {
            $temp[$value->id] = $value->date." - ".$value->deadline;
        }

        $tracts = $temp;

        $this->set(compact('saving', 'associations'));
        $this->set(compact('saving', 'tracts'));
        $this->set('_serialize', ['saving']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Saving id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->viewBuilder()->layout('admin_views');
        $this->request->allowMethod(['post', 'delete']);
        $saving = $this->Savings->get($id);

        $deleted = $this->deleteLetter($saving->letter);

        if ($deleted && $this->Savings->delete($saving)) {
            $this->Flash->success(__('The saving has been deleted.'));


        } else {
            $this->Flash->error(__('The saving could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    private function deleteLetter($fileName)
    {
        $deleted = false;
        $filePath = WWW_ROOT .'letters';

        try
        {
            $dir = new Folder($filePath);

            $file = new File($dir->pwd() . DS . $fileName);

            if($file->delete())
            {
                $deleted = true;
            }
        }
        catch (Exception $e)
        {
            $this->Flash->error(__('Ocurrió un error al tratar de borrar el archivo'));
            return $this->redirect(['action' => 'index']);
        }


        return $deleted;
    }

    public function download($fileName)
    {
        if($fileName)
        {
            try
            {
                $filePath = WWW_ROOT .'letters'. DS . $fileName;

                $this->response->file($filePath ,
                    ['download'=> true, 'name'=> $fileName, 'extension'=>'pdf']);
            }
            catch (Exception $e)
            {
                $this->Flash->error(__('Ocurrió un error al tratar de abrir el archivo'));
                return $this->redirect(['action' => 'index']);
            }

        }
        else
        {
            $this->Flash->error(__('El nombre del archivo es nulo'));
            return $this->redirect(['action' => 'index']);
        }
    }
}
