<?php 
include("config.php");

if ($_SERVER["REQUEST_METHOD"] === "POST"){
     $fname = isset($_POST['first-name']) ? $_POST['first-name'] : '';
    $lname = isset($_POST['last-name']) ? $_POST['last-name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $age = isset($_POST['age']) ? $_POST['age'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Hash the password before storing
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("UPDATE `registration` SET `fname`=?, `lname`=?, `email`=?, `phone`=?, `age`=?, `gender`=?, `address`=?, `password`=? WHERE `email`=?");
    $stmt->bind_param("sssssssss", $fname, $lname, $email, $phone, $age, $gender, $address, $hashed_password, $email);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        echo "<script>alert('Update successful!');</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
    header("Location: http://localhost/practis/from-db/home.php"); // Redirect to the form page after update
    $stmt->close();

}

?>