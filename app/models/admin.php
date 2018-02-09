<?php
class Admin extends BaseModel{
	public $username, $password;
	public function __construct($attributes){
    	parent::__construct($attributes);
    }
    public static function find($id){
	    $query = DB::connection()->prepare('SELECT * FROM Admin WHERE id = :id LIMIT 1');
	    $query->execute(array('id' => $id));
	    $row = $query->fetch();

	    if($row){
	      $admin[] = new Admin(array(
	        'id' => $row['id'],
	        'username' => $row['username'],
	        'password' => $row['password']
	      ));

	      return $admin;
	    }

	    return null;
	  }

    public static function kirjaudu($username, $password){
		$query = DB::connection()->prepare('SELECT * FROM Admin WHERE username = :username AND password = :password LIMIT 1');
		$query->execute(array('username' => $username, 'password' => $password));
		$row = $query->fetch();
		if($row){
		  $admin = new Admin(array(
		  	'username' => $row['username'],
		  	'password' => $row['password']
		  ));
		  return $admin;
		}else{
		  // Käyttäjää ei löytynyt, palautetaan null
			return null;
		}
	}
}