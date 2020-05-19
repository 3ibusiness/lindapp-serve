<?php
// Check existence of id parameter before processing further

$result = [];

if (isset($_GET["contact"]) && !empty(trim($_GET["contact"]))) {
    // Include config file
    require_once "config.php";

    // Prepare a select statement
    $sql = "SELECT * FROM ecc_keys WHERE contact = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_contact);

        // Set parameters
        $param_contact = trim($_GET["contact"]);

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 1) {
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                // Retrieve individual field value
                $contact = $row["contact"];
                $public_key = $row["public_key"];
                $result = array('code' => 200, 'contact' => $row["contact"], 'public_key' => $row["public_key"]);

            } else {
                $result = array('code' => 404, 'message' => 'Something went wrong. Please try again later. '.$param_contact);
            }

        } else {
            $result = array('code' => 404, 'message' => 'Script doesn\'t execute '.$contact);
        }
    }

echo json_encode($result);
    // Close statement
    mysqli_stmt_close($stmt);

    // Close connection
    mysqli_close($link);
}
?>
