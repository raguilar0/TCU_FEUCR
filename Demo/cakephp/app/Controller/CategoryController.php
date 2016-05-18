<?php
/**
 * Created by PhpStorm.
 * User: Iva
 * Date: 19/10/14
 * Time: 01:16 PM
 */
App::uses('AppController', 'Controller');
class CategoryController extends AppController
{
    public $helpers = array('Html', 'Form');
    var $components = array('Session');

    public function index()
    {
        $this->data = $this->Category->generateTreeList(null, null, null, '');
        $this->set('categorylist',$this->data);
        //$this->set('data', $this->Category->find('threaded', array('order' => array('Category.name' => 'asc'))));
    }

    // Función encargada de mostrar la información de cada categoría.
    public function view($id = null)
    {
        $this->Category->id = $id;
        if (!$this->Category->exists())
        {
            throw new NotFoundException(__('Categoría Inválida'));
        }
        $this->set('category', $this->Category->read(null, $id));
        $parentName = $this->Category->getParentNode($id);
        $this->set('parent', $parentName);
        $this->set('child', $this->Category->find('list', array(
                    'conditions' => array('parent_id' => $id),
                    'order' => array('Category.name' => 'asc'))));
    }

    // Función encargada de agregar categorías a la base de datos.
    public function add()
    {
        $this->set('categories',$this->Category->generateTreeList(
            null,
            null,
            null,
            '____'
        ));
        if ($this->request->is('post'))
        {
            $this->Category->create();
            if ($this->Category->save($this->request->data))
            {
                $this->Session->setFlash(__('Esta categoría ha sido guardada.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('No se ha podido guardar esta categoría.'));
        }
    }

    public function edit($id = null)
    {
        $this->set('categories',$this->Category->generateTreeList(
            null,
            null,
            null,
            '___'
        ));
        $this->Category->id = $id;
        if (!$this->Category->exists())
        {
            throw new NotFoundException(__('Categoría Inexistente'));
        }
        if ($this->request->is('post') || $this->request->is('put'))
        {
            if ($this->Category->save($this->request->data))
            {
                $this->Session->setFlash(__('Se han guardado los cambios'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('No se pudo almacenar los cambios, inténtelo de nuevo'));
        }
        else
        {
            $this->request->data = $this->Category->read(null, $id);
        }
    }

    public function delete($id = null)
    {
        $this->request->onlyAllow('post');
        $this->Category->id = $id;
        if (!$this->Category->exists()) {
            throw new NotFoundException(__('Categoría Inválida'));
        }
        if ($this->Category->removeFromTree($id, true))
        {
            $this->Session->setFlash(__('Categoría Borrada'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('La categoría no pudo eliminarse'));
        return $this->redirect(array('action' => 'index'));
    }

    function moveup($id = null)
    {
        $this->Category->id = $id;
        if (!$this->Category->exists())
        {
            throw new NotFoundException(__('Categoría Inexistente'));
        }
        if($this->Category->moveUp())
        {
            $this->Session->setFlash(__('Categoría Modificada'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('No pudo hacerse la modificación'));
        return $this->redirect(array('action' => 'index'));
    }

    function movedown($id = null)
    {
        $this->Category->id = $id;
        if (!$this->Category->exists())
        {
            throw new NotFoundException(__('Categoría Inexistente'));
        }
        if($this->Category->moveDown())
        {
            $this->Session->setFlash(__('Categoría Modificada'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('No pudo hacerse la modificación'));
        return $this->redirect(array('action' => 'index'));
    }

}