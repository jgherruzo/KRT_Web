<?php

include_once '500-DB.php';

class User extends DB{
    private $nombre;
    private $username;
    public function userExists($user, $pass){
        $md5pass = md5($pass);
        $query = $this->connect()->prepare('SELECT * FROM users WHERE Email = :user AND Password = :pass');
        $query->execute(['user' => $user, 'pass' => $md5pass]);
        if($query->rowCount()){
            return true;
        }else{
            return false;
        }
    }
    public function setUser($user){
        $query = $this->connect()->prepare('SELECT * FROM users WHERE Email = :user');
        $query->execute(['user' => $user]);
        
        foreach ($query as $currentUser) {
            $this->nombre = $currentUser['Nombre'];
            $this->username = $currentUser['Email'];
        }
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function EmailExists($user){
        $query = $this->connect()->prepare('SELECT * FROM users WHERE Email = :user');
        $query->execute(['user' => $user]);
        if($query->rowCount()){
            return true;
        }else{
            return false;
        }
	}
    public function IsStaff($user){
        $query = $this->connect()->prepare('SELECT * FROM socios WHERE DriverKey = :user');
        $query->execute(['user' => $user]);
        if($query->rowCount()){
            return true;
        }else{
            return false;
        }
	}
	
	public function InsertNewUser($Name,$Sur,$Mail,$Pass){
		
		$query = $this->connect()->prepare('INSERT INTO users VALUES Nombre = :name AND Apellido = :sur AND Email = :mail AND Password = :pass');
		$query->execute(['name' => $Name, 'sur' => $Sur, 'mail' => $Mail, 'pass' => $Pass]);
		if($query->rowCount()){
            return true;
        }else{
            return false;
        }
	}
}
?>