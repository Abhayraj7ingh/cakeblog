<?php

App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {
     public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'User name can not be Blank.'
            ),
			'usernameUnique' => array(
				'rule' => 'usernameUnique',
                'message' => 'User Name is already Exists. Please Select anotherone.'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'A password is required'
            )
        ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'author')),
                'message' => 'Please enter a valid role',
                'allowEmpty' => false
            )
        )
    ); 



	
	
	public function usernameUniqueId($id) 
	{
        $existing = $this->find('first', array(
        'conditions' => array(
            'username' => $this->data[$this->name]['username'],
			'user_id !=' => $id
         )
    ));

    return (count($existing) == 0);
	}

public function usernameUnique() 
{
    $existing = $this->find('first', array(
        'conditions' => array(
            'username' => $this->data[$this->name]['username']
         )
    ));

    return (count($existing) == 0);
}


	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$passwordHasher = new BlowfishPasswordHasher();
			$this->data[$this->alias]['password'] = $passwordHasher->hash(
				$this->data[$this->alias]['password']
			);
		}
		return true;
	}
	
	

	

	
}

?>