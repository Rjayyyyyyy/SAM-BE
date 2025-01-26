<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "event_website";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (!function_exists('executeQuery')) {
    function executeQuery($query)
    {
        global $conn;
        $result = mysqli_query($conn, $query);
        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }
        return $result;
    }
}

if (!function_exists('sanitize_input')) {
    function sanitize_input($data)
    {
        global $conn;
        return mysqli_real_escape_string($conn, trim($data));
    }
}
