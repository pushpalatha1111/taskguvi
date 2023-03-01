<?php
$mongo = new MongoDB\Client("mongodb://localhost:27017");
$database = $mongo->selectDatabase("mydatabase");
$collection = $database->selectCollection("users");
$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];
$password_hash = password_hash($password, PASSWORD_DEFAULT);
$user_doc = [
  "username" => $username,
  "email" => $email,
  "password" => $password_hash
];
$result = $collection->insertOne($user_doc);

if ($result->getInsertedCount() == 1) {
  echo "New user registered successfully";
} else {
  echo "Error: " . $result->getWriteErrors()[0]->getMessage();
}

?>