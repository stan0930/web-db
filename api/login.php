<?php
     header('Content-Type: application/json');
     $servername = "localhost"; // 数据库服务器地址
     $username = "root"; // 数据库用户名
     $password = ""; // 数据库密码
     $dbname = "tourism_db"; // 数据库名称

     $conn = new mysqli($servername, $username, $password, $dbname);
     // 检查连接
     if ($conn->connect_error) {
        die(json_encode(['error' => "Connection failed: " . $conn->connect_error]));
     }
       if ($_SERVER["REQUEST_METHOD"] == "POST") {
         $data = json_decode(file_get_contents("php://input"), true);
          if (isset($data['email']) && isset($data['password'])) {
                 $email = $conn->real_escape_string($data['email']);
                 $password = $data['password'];
             $sql = "SELECT * FROM users WHERE email = '$email'";
                 $result = $conn->query($sql);
                 if ($result->num_rows > 0) {
                     $user = $result->fetch_assoc();
                     if (password_verify($password, $user['password'])) {
                        echo json_encode(['message' => 'Login successful.', 'user' => [
                             'id' => $user['id'],
                             'email' => $user['email'],
                             'firstname' => $user['firstname'],
                             'lastname' => $user['lastname']
                        ]]);
                      } else {
                        echo json_encode(['error' => 'Invalid email or password.']);
                       }
                     } else {
                        echo json_encode(['error' => 'Invalid email or password.']);
                    }
          }else {
             echo json_encode(['error' => "Missing parameters."]);
         }
     }
 $conn->close();
 ?>