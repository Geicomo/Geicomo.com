<?php
class RegisterUser {
    // Class properties
    private $username;
    private $raw_password;
    private $encrypted_password;
    private $email;
    private $acceptTos;
    public $error;
    public $success;
    private $storage = "data.json";
    private $logFile = "/var/www/html/logged/admin/syslog.txt";
    private $stored_users;
    private $new_user; // array

    public function __construct($username, $password, $acceptTos, $email) {
        $this->username = trim($username);
        $this->username = filter_var($this->username, FILTER_SANITIZE_STRING);

        $this->raw_password = filter_var(trim($password), FILTER_SANITIZE_STRING);

	$this->acceptTos = $acceptTos;
	$this->email = $email;
	
	$salt = bin2hex(random_bytes(3));
        $encrypted_password = hash('sha256', $this->raw_password . $salt);

        $this->stored_users = json_decode(file_get_contents($this->storage), true);

        $registrationTime = date('m-d-Y h:i:s a'); // Get current date and time in 12-hour format

        $this->new_user = [
            "password" => $encrypted_password,
	    "salt" => $salt,
	    "email" => $email,
	    "privileges" => "default",
            "registrationTime" => $registrationTime,
            "lastLogin" => null,
            "description" => "I love geicomo.com",
            "points" => 0
        ];
	if ($this->checkFieldValues() && $this->checkTosAcceptance()) {
            	$this->insertUser();
       	}
    }

    private function checkFieldValues() {
        if (empty($this->username) || empty($this->raw_password) || empty($this->email)) {
            $this->error = "All fields are required.";
            return false;
        } else {
            return true;
        }
    }

    private function usernameExists() {
        return isset($this->stored_users[$this->username]);
    }

    private function emailExists() {
        foreach ($this->stored_users as $user) {
            if (isset($user['email']) && $user['email'] === $this->email) {
                return true;
            }
        }
        return false;
    }

    private function checkTosAcceptance() {
        if ($this->acceptTos !== 'yes') {
            $this->error = "You must accept the Terms of Service.";
            return false;
        }
        return true;
    }
 
    private function insertUser() {
        if (!$this->usernameExists()) {
            if (!$this->emailExists()) {
                $this->stored_users[$this->username] = $this->new_user;
                if (file_put_contents($this->storage, json_encode($this->stored_users, JSON_PRETTY_PRINT))) {
                    $this->success = "Your registration was successful";
                    $this->logRegistration($this->username); // Log the registration
                } else {
                    $this->error = "Something went wrong, please try again";
                }
            } else {
                $this->error = "Email already in use";
            }
        } else {
            $this->error = "Username already taken, please choose a different one.";
        }
    }

    private function logRegistration($username) {
        $date = date('m-d-Y H:i:s a');
        $logMessage = "$date: New user registered! - Username: $username\n";
        file_put_contents($this->logFile, $logMessage, FILE_APPEND);
    }
}

?>

