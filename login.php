<?php
// Database connection settings
$host = 'localhost';
$dbname = 'sound_db';
$username = 'your_db_username';
$password = 'your_db_password';

try {
    // Connect to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get user input from the POST request
    $user = $_POST['username'];
    $email = $_POST['email'];
    $pass = password_hash($_POST['password'], PASSWORD_BCRYPT); // Securely hash the password

    // Insert user into database
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$user, $email, $pass]);

    // Redirect only after successful registration, no echo before this
    header("Location: info.html");
    exit();
} catch (PDOException $e) {
    // Optional: Redirect to error page instead
    echo "Error: " . $e->getMessage(); // You may remove this in production
}

echo "<script>alert('Registration successful!'); window.location.href='info.html';</script>";
exit();

?>
