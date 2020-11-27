<?php

session_start();

include('db.php');

// * Setting time
// PHP

define('TIMEZONE', 'Asia/Kolkata');
date_default_timezone_set(TIMEZONE);

// MySQL

$now = new DateTime();
$mins = $now->getOffset() / 60;
$sgn = ($mins < 0 ? -1 : 1);
$mins = abs($mins);
$hrs = floor($mins / 60);
$mins -= $hrs * 60;
$offset = sprintf('%+d:%02d', $hrs*$sgn, $mins);

getConn()->query("SET time_zone='$offset';");


class Account {
    private $id;
    private $authenticated;

    public function __construct()
    {
        $this->id = NULL;
        $this->authenticated = FALSE;
    }

    public function register(string $username, string $email, string $password) {
        $conn = getConn();

        $username = trim($username);
        $email = trim($email);
        $password = trim($password);

        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Bad e-mail provided');
        }

        $check = "SELECT * FROM accounts WHERE username='$username'";
        $res = $conn->query($check);

        if($res->num_rows) {
            throw new Exception('An account with same username already exists');
        }

        $create_user = "INSERT INTO accounts (username, email, password) VALUES ('$username', '$email', '$hashed_pass')";
        if ($conn->query($create_user)) {
            return TRUE;
        } else {
            throw new Exception('Some error occured while creating the user');
        }

        return FALSE;
    }

    public function login(string $username, string $password) {
        $conn = getConn();

        $username = trim($username);
        $password = trim($password);

        $check = "SELECT * FROM accounts WHERE username='$username'";
        $res = $conn->query($check);

        if($res->num_rows) {
            $user = $res->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                
                $this->id = intval($user['account_id']);
                $this->authenticated = TRUE;
                
                if (session_status() == PHP_SESSION_ACTIVE) {
                    $query = "REPLACE INTO sessions (session_id, account_id, login_ts) VALUES ('".session_id()."', '$this->id', NOW())";
                    $conn->query($query);
                }

                return $this->id;

            } else {
                throw new Exception('Wrong password');
            }
        }

        throw new Exception('User not found');
    }

    public function check() {
        $conn = getConn();
        if (session_status() == PHP_SESSION_ACTIVE) {
            $query =  "SELECT * FROM sessions, accounts WHERE (sessions.session_id = '".
            session_id().
            "') AND (sessions.login_ts >= (NOW() - INTERVAL 1 HOUR)) AND (sessions.account_id = accounts.account_id)";
            // echo $query;
            $res = $conn->query($query);
            if ($res->num_rows)
            {
                $res = $res->fetch_assoc();
                if (is_array($res)) {
                    $this->id = intval($res['account_id']);
                    $this->authenticated = TRUE;

                    return $this->id;
                }
            }
        }
        return NULL;
    }

    public function logout() {
        $conn = getConn();

        if (is_null($this->id)) {
            return;
        }

        $this->id = NULL;
        $this->authenticated = FALSE;

        if (session_status() == PHP_SESSION_ACTIVE) {
            $query = "DELETE FROM sessions WHERE (session_id = '".session_id()."')";
            $conn->query($query);
        }
    }

    public function getSessionInfo() {
        $conn = getConn();
        $id = $this->id;
        $q = "SELECT * FROM sessions WHERE account_id=$id";
        $res = $conn->query($q);

        if($res->num_rows) {
            return $res->fetch_assoc();
        }
    }

    public function getInfo() {
        $conn = getConn();
        $id = $this->id;
        $q = "SELECT * FROM accounts WHERE account_id=$id";
        $res = $conn->query($q);

        if($res->num_rows) {
            return $res->fetch_assoc();
        }
    }

    public function isAuthenticated(): bool {
        return $this->authenticated;
    }


    public function closeOtherSessions() {
        if (is_null($this->id)) return;

        if (session_status() == PHP_SESSION_ACTIVE) {
            $conn = getConn();

            $query = "DELETE FROM sessions WHERE (session_id != '".session_id()."') AND (account_id = '$this->id')";
            $conn->query($query);
        }
    }
}

?>

<!-- date('Y-m-d H:i:s', time()) -->