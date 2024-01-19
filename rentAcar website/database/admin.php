<?php   
include 'db.php';
session_start();

try {
    $db = new Database();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $db->insertCar($_POST['naam'], $_POST['merk'], $_POST['bouwjaar'], $_POST['prijs'], $_POST['kilometers'], $_POST['brandstof'], $_POST['transmissie'], $_POST['kenteken']);
        echo "Successfully submitted";
    }
} catch (\Exception $e){
    echo "ERROR: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Page</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
            <div class="container">
            <div class="header">
            <h1>Car Management</h1>
            </div>

            <div class="achtergrond">
            <div class="edit-sectie">
            <h1>Add a New Car</h1>
            <form method="post" action="admin.php">
                <label for="naam">Auto Naam:</label>
                <input type="text" id="naam" name="naam" required><br>

                <label for="merk">Auto Merk:</label>
                <input type="text" id="merk" name="merk"><br>

                <label for="bouwjaar">Bouwjaar:</label>
                <input type="date" id="bouwjaar" name="bouwjaar"><br>

                <label for="prijs">Prijs:</label>
                <input type="text" id="prijs" name="prijs" required><br>

                <label for="kilometers">Kilometers:</label>
                <input type="text" id="kilometers" name="kilometers" required><br>

                <label for="brandstof">Brandstof:</label>
                <input type="text" id="brandstof" name="brandstof" required><br>

                <label for="transmissie">Transmissie:</label>
                <input type="text" id="transmissie" name="transmissie" required><br>

                <label for="kenteken">Kenteken:</label>
                <input type="text" id="kenteken" name="kenteken" required><br>

                <input type="submit" name="submit" value="Add Product">
            </form>
        </div>
        
        <div class="edit-sectie">
        <h1>Delete a Product</h1>

    <form method="post" action="">
        <label for="delete_product_id">Car ID to Delete:</label>
        <input type="text" id="delete_product_id" name="delete_product_id" required><br>

        <input type="submit" name="delete_submit" value="Delete Product">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_submit"])) {
        $delete_product_id = $_POST["delete_product_id"];

        // kijk of de product in de database is
        $check_query = "SELECT * FROM producten WHERE product_id = $delete_product_id";
        $check_result = $conn->query($check_query);

        if ($check_result->num_rows > 0) {
            // Product bestaat en verwijderd
            $delete_query = "DELETE FROM producten WHERE product_id = $delete_product_id";
            if ($conn->query($delete_query) === TRUE) {
                echo "Product succesvol verwijderd. <a href='admin.php'>Reset Pagina</a>";
            } else {
                echo "Error: " . $conn->error;
            }
        } else {
            // als produc niet bestaat
            echo "Product niet gevonden. <a href='admin.php'>Reset Pagina</a>";
        }

        $conn->close();
    }
    ?>  
        </div>
        
        
        <div class="sectie lijst-sectie">
        <h1>Auto Lijst</h1>
        <ul>

            <?php
            //  haal product info op vanuit onze database
            $stmt = $db->selectAllCars();
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch())  {
                    echo "Car ID: " . $row["carID"] . "<br>";
                    echo "Auto Naam: " . $row["naam"] . "<br>";
                    echo "Merk: " . $row["merk"] . "<br>";  
                    echo "Prijs: " . $row["prijs"] . "<br>";
                    echo "Bouwjaar: " . $row["bouwjaar"] . "<br>";
                    echo "Brandstof: " . $row["brandstof"] . "<br><br>";
                    echo "Transmissie: " . $row["transmissie"] . "<br><br>";
                    echo "Kenteken: " . $row["kenteken"] . "<br><br>";
                }
            } else {
                // als er geen product is 
                echo "<li>No products found.</li>";
            }
            ?>
        </ul>
        </div>


</div>
    </div>
        </div>
       
        
</body>
</html>

