<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root"; // Change this if you're using a different username
    $password = ""; // Change this if you're using a different password
    $dbname = "restaurant_reservations"; // Name of the database

    // Get form data
    $name = htmlspecialchars(strip_tags($_POST['name']));
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars(strip_tags($_POST['phone']));
    $date = $_POST['date'];
    $time = $_POST['time'];
    $guests = intval($_POST['guests']);
    $special_requests = htmlspecialchars(strip_tags($_POST['special_requests']));

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert data into database
    $sql = "INSERT INTO reservations (name, email, phone, reservation_date, reservation_time, guests, special_requests) 
            VALUES ('$name', '$email', '$phone', '$date', '$time', $guests, '$special_requests')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Reservation successful! Thank you for booking with us.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>
