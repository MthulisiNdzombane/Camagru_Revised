<?php

class Database {
    public $isConnected;
    protected $datab;

    //connect to database
    public function __construct($username = "me_user", $password = "", $host = "127.0.0.1", $dbname = "camagru_db", $options = array()) {
        $this->isConnected = TRUE;
        try {
            $this->datab = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8",$username, $password, $options);
            $this->datab->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->datab->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
    //disconnect from DB
    public function Disconnect() {
        $this->datab = NULL;
        $this->isConnected = FALSE;
    }
    //get a single row
    public function getRow($query, $params = array()) {
        try {
            $stmt = $this->datab->prepare($query);
            $stmt->execute($params);
            return $stmt->fetch();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
    //get rows
    public function getRows($query, $params = array()) {
        try {
            $stmt = $this->datab->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll();
        } catch(PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
    //insert row
    public function insertRow($query, $params = array()) {
        try {
            $stmt = $this->datab->prepare($query);
            $stmt->execute($params);
            return TRUE;
        } catch(PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
    //update row
    public function updateRow($query, $params = array()) {
        $this->insertRow($query, $params);
    }
    //delet row
    public function deleteRow($query, $params = array()) {
        $this->insertRow($query, $params);
    }

    //Upload images when taking photos.
    public function insertUserPic($user, $destinationPath) {
        try {
            $stmt = $this->datab->prepare("SELECT `id_user` FROM `users` WHERE `username` = :user");
            $stmt->bindParam(':user', $user);
            $stmt->execute();
            $userID = $stmt->fetch(PDO::FETCH_ASSOC)['id_user'];

            $stmt = $this->datab->prepare("INSERT INTO `images`(`img_path`, `user_id`) VALUES (:path, :id)");
            $stmt->bindParam(':path', $destinationPath);
            $stmt->bindParam(':id', $userID);
            $stmt->execute();
            return TRUE;
        } catch(PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
}   
