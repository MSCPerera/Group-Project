<?php
// Handle registration functionality
if (isset($_POST['register_submit'])) {
    $title = $_POST['title'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $tin = $_POST['tin_number'];
    $nic = $_POST['nic_number'];
    $homePhone = $_POST['home_phone'];
    $mobilePhone = $_POST['mobile_phone'];
    $division = $_POST['division'];
    $divisionalNumber = $_POST['divisional_number'];

    $query = "INSERT INTO users (title, first_name, last_name, gender, address, tin_number, nic_number, home_phone, mobile_phone, division, divisional_number) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssssssss", $title, $firstName, $lastName, $gender, $address, $tin, $nic, $homePhone, $mobilePhone, $division, $divisionalNumber);

    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }
}
// Handle password reset functionality
if (isset($_POST['reset_password_submit'])) {
    $username = $_POST['username'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($newPassword === $confirmPassword) {
        $query = "UPDATE users SET password = ? WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $newPassword, $username);

        if ($stmt->execute()) {
            echo "Password reset successful!";
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Passwords do not match.";
    }
}
?>