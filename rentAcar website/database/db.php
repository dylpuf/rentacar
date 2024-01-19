<?php

class Database {
    public $pdo;
    private string $carTable = "car";
    private string $userTable = "klant";

    public function __construct($db = "rentacar", $host = "localhost:3307", $user = "root", $pass = "") {
        $this->pdo = new PDO("mysql:host=$host;dbname=$db;", $user, $pass);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public function insertCar($naam, $merk, $bouwjaar, $prijs, $kilometers, $brandstof, $transmissie, $kenteken) {
        $stmt = $this->pdo->prepare("INSERT INTO $this->carTable (naam, merk, bouwjaar, prijs, kilometers, brandstof, transmissie, kenteken) values (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$naam, $merk, $bouwjaar, $prijs, $kilometers, $brandstof, $transmissie, $kenteken]);
        return $this->pdo->lastInsertId();
    }
    public function deleteCar(int $carID): bool {
        $stmt = $this->pdo->prepare("DELETE FROM $this->carTable WHERE carID = ?");
        return $stmt->execute([$carID]);
    }
    public function selectAllCars() {
        $stmt = $this->pdo->query("SELECT * FROM $this->carTable");
        return $stmt;
    }
    
    public function aanmelden($naam, $email, $wachtwoord) {
        $stmt = $this->pdo->prepare("INSERT INTO $this->userTable (naam, email, wachtwoord) values (?, ?, ?)");
        $stmt->execute([$naam, $email, $wachtwoord]);
    }
    
    
    public function login($email) {
    $stmt = $this->pdo->prepare("SELECT * FROM $this->userTable where email = ?");
    $stmt->execute([$email]);
    $result = $stmt->fetch();
    return $result;
    }
}

?>
