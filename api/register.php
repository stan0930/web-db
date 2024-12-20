<?php
     header('Content-Type: application/json');
     $servername = "localhost"; // 数据库服务器地址
     $username = "root"; // 数据库用户名
     $password = ""; // 数据库密码
     $dbname = "tourism_db"; // 数据库名称
     // 创建数据库连接
     $conn = new mysqli($servername, $username, $password, $dbname);

     if ($conn->connect_error) {
         die(json_encode(['error' => "Connection failed: " . $conn->connect_error]));
     }
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
         $data = json_decode(file_get_contents("php://input"), true);
          if (isset($data['firstname']) && isset($data['lastname']) && isset($data['email']) && isset($data['password'])) {
                 $firstname = $conn->real_escape_string($data['firstname']);
                 $lastname = $conn->real_escape_string($data['lastname']);
                 $email = $conn->real_escape_string($data['email']);
                 $password = password_hash($data['password'], PASSWORD_DEFAULT);
             $sql = "INSERT INTO users (firstname, lastname, email, password) VALUES ('$firstname', '$lastname', '$email', '$password')";
             if ($conn->query($sql) === TRUE) {
                 echo json_encode(['message' => "Registration successful."]);
             } else {
                 echo json_encode(['error' => "Registration failed: " . $conn->error]);
             }
        }else {
             echo json_encode(['error' => "Missing parameters."]);
         }
     }
     $conn->close();
 ?>
