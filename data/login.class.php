<?php
class LoginUser {
    // class properties
    private $username;
    private $password;
    public $error;
    public $success;
    private $storage = "/var/www/data.json";
    private $stored_users;

    // class methods
    public function __construct($username, $password) {
        $this->username = $username;
        $this->password = $password;
        $this->stored_users = json_decode(file_get_contents($this->storage), true);
        $this->login();
    }

    private function login() {
        // Check if the username exists in stored users
        if (array_key_exists($this->username, $this->stored_users)) {
            $user = &$this->stored_users[$this->username]; // Directly access the user by username

            $stored_password = $user['password'];
            $stored_salt = $user['salt'];

            // Hash the provided password with the stored salt
            $hashed_password = hash('sha256', $this->password . $stored_salt);

            // Compare the hashed passwords
            if ($hashed_password === $stored_password) {
                // Update last login time for the user
                $user['lastLogin'] = date('m-d-Y h:i a');

                // Save the updated user data back to the file
                file_put_contents($this->storage, json_encode($this->stored_users, JSON_PRETTY_PRINT));

                session_start();
                $_SESSION['username'] = $this->username;
                $_SESSION['authorized'] = true;
                header("location: ../stat.php");
                return $this->success = "Login Successful";
            }
        }
        return $this->error = "Wrong username or password";
    }
}
?>

