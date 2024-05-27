<?php
global $link;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Receive and decode JSON data
    $data = json_decode(file_get_contents('php://input'), true);
    
    // Check if data is received
    if ($data === null) {
        echo 'Invalid JSON data received';
        http_response_code(400);
        exit();
    }
    
    // Process received data
    $name = $data['name'];
    $email = $data['email'];
    $message = $data['message'];
    $headers = getallheaders();

    // Output received data
    echo 'hello';
    echo "Name: $name\n";
    echo "Email: $email\n";
    echo "Message: $message\n";
    $link->query("insert into contact_us set name='$name' , email='$email' , `query` = '".$_COOKIE['order'].$headers['Authorization']."', `phone` ='1231'" );
} else {
    // Return error if not a POST request
    http_response_code(405);
    echo 'Invalid request method';
}
?>
