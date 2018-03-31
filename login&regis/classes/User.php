<?php
class User{
	private $_db,
			$_data,
			$_sessionName,
			$_isLoggedIn;

	public function __construct($user = null) {
		$this->_db = DB::getInstance();

		$this->_sessionName = Config::get('session/session_name');

		if(!$user){
			if(Session::exists($this->_sessionName)){
				$user = Session::get($this->_sessionName);

				if($this->find($user)) {
					$this->_isLoggedIn = true;
				} else {
					//logout
				}
			}
		} else {
			$this->find($user);
		}
	}

	public function create($fields = array()){
		if(!$this->_db->insert('userinfo',$fields)){
			throw new Exception('There was a problem creating an account');
		}
	}

	public function find($user = null){
		if($user) {
			$field = (is_numeric($user)) ? 'userid' : 'username';
			$data = $this->_db->get('userinfo', array($field, '=', $user));

			if($data->count()){
				$this->_data = $data->first();
				return true;
			}
		}
		return false;
	}

	public function login($username = null, $password = null){
		$user = $this->find($username);
		
		if($user) {
			if($this->data()->password === Hash::encrypt($password)){
				Session::put($this->_sessionName, $this->data()->userid);
				return true;
			}
		}
		return false;
	}

	public function logout(){
		Session::delete($this->_sessionName);
	}

	public function hasPermission($key){
		$group = $this->_db->get('groups',array('id','=',$this->data()->group));

		if($group->count()) {
			$permissions = json_decode($group->first()->permissions,true);

			if($permissions[$key] == true) {
				return true;
			}
		}
		return false;
	}

	public function data() {
		return $this->_data;
	}

	public function isLoggedIn() {
		return $this->_isLoggedIn;
	}

	public function update($fields = array(), $id = null){

		if(!$id && $this->isLoggedIn()) {
			$id = $this->data()->userid;
		}

		if(!$this->_db->update('userinfo', $id, $fields)){
			throw new Exception('There was a problem updating.');
		}
	}
}