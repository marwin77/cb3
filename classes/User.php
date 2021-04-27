<?php


class User
{
    private $_db,
            $_data,
            $_sessionName,
            $_isLoggedIn;

    public function __construct($user = null){
        $this->_db = DB::getInstance();

        $this->_sessionName = Config::get('session/session_name');

        if(!$user){
            if(Session::exists($this->_sessionName)){
                $user = Session::get($this->_sessionName);

                if($this->find($user)){
                    $this->_isLoggedIn=true;

                }else{
                    $this->_isLoggedIn=false;
                }

            }
        }else{
            $this->find($user);
        }
    }

    public function update($fields = array(), $id = null){

        if(!$id && $this->isLoggedIn()){
            $id = $this->data()->id;
        }

        if(!$this->_db->update('users', $id, $fields)){
            throw new Exception('Wystąpił problem z aktualizacją danych');
        }
    }

    public function create($fields = array()){
        if(!$this->_db->insert('users', $fields)){
            throw new Exception('Wystąpił problem z utworzeniem nowego użytkownika');
        }
    }

    public function find($user = null){
        if($user){
            $field = (is_numeric($user)) ? 'nrTelefonu' : 'email';
            $data = $this->_db->get('users', array($field, '=', $user));

            if($data->count()){
                $this->_data = $data->first();
                return true;
            }
        }
       return false;
    }

    public function login($email = null, $haslo = null){

        $user = $this->find($email);

        if($user){
            if(password_verify($haslo, $this->data()->haslo)) {
                    Session::put($this->_sessionName, $this->data()->nrTelefonu);
                    return true;
                }
        }
        return false;
    }

    public function hasPermission($key){
        $group = $this->_db->get('grupy', array('id', '=', $this->data()->grupa));
        if($group->count()){
            $permissions = json_decode($group->first()->permissions, true);

            return !empty($permissions[$key]);
        }
        return false;
    }

    public function exists(){
        return (!empty($this->_data)) ? true : false;
    }

    public function logout(){
        Session::delete($this->_sessionName);
    }

    public function data(){
        return $this->_data;
    }

    public function isLoggedIn(){
        return $this->_isLoggedIn;
    }


}