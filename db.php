<?php
function executeQuery($query) {
    // Create connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "employee_leave_management_system";
    
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Execute query and fetch results
    $result = $conn->query($query);
    
    if ($result === FALSE) {
        echo "Error executing query: " . $conn->error;
        return null;
    }
    
    // Fetch all rows if it's a SELECT query
    if ($result instanceof mysqli_result) {
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $result->free();
        $conn->close();
        return $data;
    }

    // Return the result for non-SELECT queries (e.g., INSERT, UPDATE, DELETE)
    $conn->close();
    return true;
}

// Example usage
// $query = "INSERT INTO user (id, name1) Values ('2', 'h')";

// $result = executeQuery($query);

// if ($result !== null) {
//     print_r($result);
// }
?>