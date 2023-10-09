<?php
// Retrieve data from the form
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$product = $_POST['product'];
$quantity = $_POST['quantity'];
$delivery = $_POST['delivery'];

// Create a database connection
$conn = new mysqli('localhost', 'root', '', 'test');

// Check the connection
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}

// Prepare and execute the SQL query to insert the data into the database
$sql = "INSERT INTO orders (name, email, phone, product, quantity, delivery) 
        VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die('Error in preparing the statement: ' . $conn->error);
}

$stmt->bind_param("ssssis", $name, $email, $phone, $product, $quantity, $delivery);

if ($stmt->execute()) {
    echo "Order placed successfully.";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and database connection
$stmt->close();
$conn->close();
?>
