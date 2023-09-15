<?php
//Проверяем была ли отправлена форма и если да то сравниваем введенные email и password 
//с соответствующими записями в базе данных
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $conn = require __DIR__ . "/database.php";
    $stmt = $conn->prepare("SELECT * FROM user WHERE email = :email");
    try {
        if ($stmt->execute([':email'=>$email])) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            echo $result['password_hash'];
            exit;
        }
    } catch (PDOException $e) {
    
        echo "Connection failed: " . $e->getMessage();
    }


}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Signup</title>
    <!-- Подключаем стили -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css" />
</head>

<body>
    <h1>Login</h1>
    <form method="post">
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" />
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" />
        </div>
        <button type="submit">Log in</button>

    </form>
</body>

</html>