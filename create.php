<?php
// Include config file
require_once "config.php";
$result = '';
// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // contact
    $input_contact = trim($_GET["contact"]);
    // public_key
    $input_public_key = $_GET["public_key"];

    // Prepare an insert statement
    $sql = "INSERT INTO ecc_keys (contact, public_key) VALUES (?, ?)";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ss", $param_contact, $param_public_key);

        // Set parameters
        $param_contact = $input_contact;
        $param_public_key = $input_public_key;
        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            $result = array('code' => 200, 'message' => 'Key create');
        } else {
            $result = array('code' => 404, 'message' => 'Something went wrong. Please try again later.');
        }
    }

    // Close statement
    mysqli_stmt_close($stmt);
}

// Close connection
mysqli_close($link);

//var_dump($result);
echo json_encode($result);
?>