<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;


/**
 * Headquarters Controller
 *
 * @property \App\Model\Table\HeadquartersTable $Headquarters
 */
class HeadquartersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        if($this->Auth->user())
        {
            $this->viewBuilder()->layout('admin_views');
            $headquarters = $this->paginate($this->Headquarters);

            $this->set(compact('headquarters'));
            $this->set('_serialize', ['headquarters']);
        }
        else
        {
            return $this->redirect(['controller'=>'pages', 'action'=>'home']);
        }


    }

    /**
     * View method
     *
     * @param string|null $id Headquarters id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        if($this->Auth->user())
        {
            try
            {
                $this->viewBuilder()->layout('admin_views');
                $headquarters = $this->Headquarters->get($id, [
                    'contain' => []
                ]);
            }
            catch (RecordNotFoundException $e)
            {
                $this->Flash->error(__('La información que está tratando de recuperar no existe en la base de datos. Verifique e intente de nuevo'));
                return $this->redirect(['action' => 'index']);
            }

        }
        else
        {
            return $this->redirect(['controller'=>'pages', 'action'=>'home']);
        }


        $this->set('headquarters', $headquarters);
        $this->set('_serialize', ['headquarters']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if($this->Auth->user())
        {
            $this->viewBuilder()->layout('admin_views');
            $headquarters = $this->Headquarters->newEntity();
            if ($this->request->is('post')) {

                if(!empty($this->request->data['file']['name']))
                {
                    $id = $this->addHeadquarterImage($this->request->data['file']);

                    unset($this->request->data['file']); //Quitamos los datos del archivo

                    if($id != false)
                    {
                        $this->request->data['image_name'] = $id;
                        $headquarters = $this->Headquarters->patchEntity($headquarters, $this->request->data);
                        if ($this->Headquarters->save($headquarters)) {
                            $this->Flash->success(__('La sede se guardó exitosamente.'));
                            return $this->redirect(['action' => 'index']);
                        } else {
                            $this->deleteHeadquarterImage($id); //En caso de que no se pueda agregar la información de la sede en la bd, se borra la imagen de la sede
                            $this->Flash->error(__('La sede no pudo ser guardada. Por favor intente de nuevo'));
                        }
                    }
                    else
                    {
                        $this->Flash->error(__('La sede no pudo ser guardada. Por favor verifique que la imagen esté en formato jpg, png o jpeg'));
                    }
                }
                else
                {
                    $this->Flash->error(__('Debe adjuntar una imagen'));
                }


            }
            $this->set(compact('headquarters'));
            $this->set('_serialize', ['headquarters']);
        }
        else
        {
            return $this->redirect(['controller'=>'pages', 'action'=>'home']);
        }

    }

    /**
     * Edit method
     *
     * @param string|null $id Headquarters id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if ($this->Auth->user()) {

            try
            {
                $this->viewBuilder()->layout('admin_views');
                $headquarters = $this->Headquarters->get($id, [
                    'contain' => []
                ]);
            }
            catch (RecordNotFoundException $e)
            {
                $this->Flash->error(__('La información que está tratando de recuperar no existe en la base de datos. Verifique e intente de nuevo'));
                return $this->redirect(['action' => 'index']);
            }


            if ($this->request->is("get")) {
                $session = $this->request->session();

                $session->write('Headquarter.image_name', $headquarters->image_name);
            }

            if ($this->request->is(['patch', 'post', 'put']))
            {

                $session = $this->request->session(); //Vamos a recuperar
                $id = $session->read('Headquarter.image_name'); //Recuperamos el nombre de la imagen anterior por defecto

                if (!empty($this->request->data['file']['name']))
                {

                    $deleted = $this->deleteHeadquarterImage($session->read('Headquarter.image_name'));

                    if($deleted)
                    {
                        $id = $this->addHeadquarterImage($this->request->data['file']);

                        if(!$id)
                        {
                            $this->Flash->error(__('La sede no pudo ser guardada ya que no se pudo guardar la nueva imagen. Por favor intente de nuevo.'));
                            return $this->redirect(['action' => 'index']);
                        }
                    }
                    else
                    {
                        $this->Flash->error(__('La sede no pudo ser guardada ya que ocurrió un error al tratar de borrar la imagen antigua. Por favor intente de nuevo'));
                        return $this->redirect(['action' => 'index']);
                    }

                }



                unset($this->request->data['file']); //Quitamos los datos del archivo

                $this->request->data['image_name'] = $id;
                $headquarters = $this->Headquarters->patchEntity($headquarters, $this->request->data);

                if ($this->Headquarters->save($headquarters))
                {
                    $this->Flash->success(__('La sede se guardó exitosamente.'));
                    return $this->redirect(['action' => 'index']);
                }
                else
                {
                    $this->Flash->error(__('La sede no pudo ser guardada. Por favor intente de nuevo'));
                }

            }
                $this->set(compact('headquarters'));
                $this->set('_serialize', ['headquarters']);
        }
        else
        {
            return $this->redirect(['controller' => 'pages', 'action' => 'home']);
        }



    }

    /**
     * Delete method
     *
     * @param string|null $id Headquarters id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if($this->Auth->user())
        {
            $this->viewBuilder()->layout('admin_views');
            $this->request->allowMethod(['post', 'delete']);
            try
            {
                $headquarters = $this->Headquarters->get($id);

                try
                {
                    $image_name = $headquarters->image_name; //Se borra primero la imagen

                    if ($this->Headquarters->delete($headquarters)) {
                        $this->deleteHeadquarterImage($image_name); //Se borra primero la imagen
                        $this->Flash->success(__('La sede se eliminó exitosamente.'));
                    } else {
                        $this->Flash->error(__('La sede no pudo ser eliminada. Por favor intente de nuevo'));
                    }
                    return $this->redirect(['action' => 'index']);
                }
                catch (\PDOException $e)
                {
                    $this->Flash->error(__('No se pudo borrar la sede. Esto puede deberse a que tiene información asociada en la base de datos, por ejemplo asociaciones. Debe borrar cualquier asociación que pertenezca a esta sede y luego borrar la sede.'));
                    return $this->redirect(['action' => 'index']);
                }
            }
            catch (RecordNotFoundException $record)
            {
                $this->Flash->error(__('La información que está tratando de recuperar no existe en la base de datos. Verifique e intente de nuevo'));
                return $this->redirect(['action' => 'index']);
            }

        }
        else
        {
            return $this->redirect(['controller'=>'pages', 'action'=>'home']);
        }

    }

    private function addHeadquarterImage($file)
    {
        $this->loadComponent('Upload');
        return $this->Upload->saveHeadquarterImage($file);
    }

    private function deleteHeadquarterImage($fileName)
    {
        $deleted = false;
        $filePath = WWW_ROOT .'img'.DS .'headquarter';

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



}
