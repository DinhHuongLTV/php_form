<?php 
if (isset($_SESSION['user'])) {
    header('Location: index.php?action=home');
    exit();
}
$page_title = 'Đăng ký';
$errors = [];
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($username)) {
        $errors['username']['required'] = 'Không được để trống tên đăng nhập';
    } else if (strlen($username) < 5){
        $errors['username']['short'] = 'Tên đăng nhập quá ngắn';
    } else {
        $sql = 'select * from users where username = :username';
        $data = [':username' => $username];
        $res = $connection->prepare($sql);
        $res->execute($data);
        if ($res->rowCount() > 0) {
            $errors['username']['exists'] = 'Tên đăng nhập đã sử dụng';
        }
    }

    // validate email
    if (empty($email)) {
        $errors['email']['required'] = 'Không được để trống email';
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email']['validate'] = 'Email sai định dạng';
        } else {
            $sql = 'select * from users where email = :email';
            $data = [':email' => $email];
            $res = $connection->prepare($sql);
            $res->execute($data);
            if ($res->rowCount() > 0) {
                $errors['email']['exists'] = 'Email này đã sử dụng';
            }
        }
    } 

    // validate password
    if (empty($password)) {
        $errors['password']['required'] = 'Không được để trống Mật khẩu';
    } else {
         if (strlen($password) < 8) {
        $errors['password']['length'] = 'Mật khẩu phải có ít nhất 8 ký tự';
        } else if (!preg_match('/[a-zA-Z]/', $password)) {
            $errors['password']['uppercase'] = 'Mật khẩu phải chứa ký tự';
        } else if (!preg_match('/[A-Z]/', $password)) {
            $errors['password']['uppercase'] = 'Mật khẩu phải chứa ký tự in hoa';
        } else if (!preg_match('/[0-9]/', $password)) {
            $errors['password']['uppercase'] = 'Mật khẩu phải có ít nhất 1 số';
        } else if (!preg_match('/(?=.*\\W).*/', $password)) {
            $errors['password']['special'] = 'Mật khẩu phải có ký tự đặc biệt';
        }
    }
    if (empty($errors)) {
        $sql = 'insert into users (username, password, email) values (:username, :password, :email)';
        $data = [
            ':username' => $username,
            ':password' => $password,
            ':email' => $email
        ];
        $obj_sql = $connection->prepare($sql);
        $res = $obj_sql->execute($data);
        if ($res) {
            $_SESSION['user'] = $username;
            header('Location: index.php?action=home');
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap-grid.min.css">
    <title> <?php echo empty($page_title) ? 'FORM PHP' : $page_title?></title>
</head>
<body>
<form method="post">
    <label for="username">Username: </label>
    <input id="username" type="text" name="username" value="<?php echo old('username')?>"> <br>
    <?php 
        form_validate('<span class="text-danger">', '</span> </br>', $errors, 'username');
    ?>

    <label for="email">Email: </label>
    <input id="email" type="email" name="email" style="margin-top: 20px;" value="<?php echo old('email')?>"> <br>
    <?php 
        form_validate('<span class="text-danger">', '</span> </br>', $errors, 'email');
    ?>

    <label for="password">Password: </label>
    <input id="password" type="password" name="password" style="margin-top: 20px;" value="<?php echo old('password')?>"> <br>
    <?php 
        form_validate('<span class="text-danger">', '</span> </br>', $errors, 'password');
    ?>

    <button type="submit" name="submit" value="submited">Submit</button>
    <a href="index.php?action=login">Đăng nhập</a>
</form>