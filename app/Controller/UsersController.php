<?php

App::uses('AppController', 'Controller');

class UsersController extends AppController {


    public function index() {
		$user = $this->Session->read('User.id');
		if(isset($user) AND $user!=''){
			$this->User->recursive = 0;
			$this->set('users', $this->paginate());
			$this->set('users', $this->User->find('all'));
		}
		else{
			return $this->redirect(array('action' => 'login'));
		}
    }



    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->findById($id));
	}


    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(
                __('The user could not be saved. Please, try again.')
            );
        }
    }

    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
/* 			$this->User->validator()->getField('username')->setRule('usernameUniqueId', array(
				'rule' => 'usernameUniqueId',
                'message' => 'User Name is already Exists. Please Select use other Name.'
			)); */
			
				$existing = $this->User->find('all', array(
					'conditions' => array(
						'username' => $this->User->username,
						'id !=' => $this->User->id 
					 )
				));
				$validate_count=count($existing);

			if($validate_count == 0)
			{
				if ($this->User->save($this->request->data)) {
					$this->Session->setFlash(__('The user has been saved'));
					return $this->redirect(array('action' => 'index'));
				}
				$this->Session->setFlash(
					__('The user could not be saved. Please, try again.')
				);
			}
			else{
				$this->Session->setFlash(
					__('User Name is already exists Please select other one..')
				);
			}
			
        } else {
            $this->request->data = $this->User->findById($id);
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
        // Prior to 2.5 use
        // $this->request->onlyAllow('post');

        $this->request->allowMethod('post');

        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User deleted'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        return $this->redirect(array('action' => 'index'));
    }


public function beforeFilter() {
    parent::beforeFilter();
    // Allow users to register and logout.
    $this->Auth->allow('add', 'logout');
}


public function logout() {
	$this->Session->delete('User.id');
    return $this->redirect($this->Auth->logout());
}

public function login() {
    if ($this->request->is('post')) {
        if ($this->Auth->login()) {
			$this->Session->write('User.id', $this->Auth->user('id'));
			return $this->redirect(array("controller" => "Posts", 'action' => 'index'));
        }
        $this->Session->setFlash(__('Your username or password was incorrect.'));
    }
}


}

