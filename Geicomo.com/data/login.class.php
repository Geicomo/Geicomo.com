<?php 
class LoginUser{
	// class properties
	private $username;
	private $password;
	public $error;
	public $success;
	private $storage = "data.json";
	private $stored_users;

	// class methods
	public function __construct($username, $password){
		$this->username = $username;
		$this->password = $password;
		$this->stored_users = json_decode(file_get_contents($this->storage), true);
		$this->login();
	}

private function login() {
    foreach ($this->stored_users as $user) {
        if ($user['username'] === $this->username) {
            $stored_password = $user['password'];
            $stored_salt = $user['salt'];
            
            // Hash the provided password with the stored salt
            $hashed_password = hash('sha256', $this->password . $stored_salt);
            
            // Compare the hashed passwords
            if ($hashed_password === $stored_password) {
                session_start();
		$_SESSION['username'] = $this->username;
		$_SESSION['authorized'] = true;
                header("location: ../stat.php");
    		return $this->success = "Login Successful";
                exit();
            }
        }
    }
    return $this->error = "Wrong username or password";
}


}
?>
