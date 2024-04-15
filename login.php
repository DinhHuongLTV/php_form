<?php 
$page_title = 'Đăng nhập';
$errors = [];
checkUser();
if (isset($_POST['submit'])) {
    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username)) {
        $errors['username']['required'] = 'Không được để trống tên';
    } else {
        $sql = 'SELECT * from users where username = :username';
        $data = [
            ':username' => $username
        ];
        $res = $connection->prepare($sql);
        $res->execute($data);
        if ($res->rowCount() == 0) {
            $errors['username']['notfound'] = 'Sai tên đăng nhập';
        }
    }


    // validate password
    if (empty($password)) {
        $errors['password']['required'] = 'Không được để trống Mật khẩu';
    } else {
        if (empty($errors['username'])) {
            $sql = 'SELECT * from users where password = :password';
            $data = [
                ':password' => $password
            ];
            $res = $connection->prepare($sql);
            $res->execute($data);
            if ($res->rowCount() == 0) {
                $errors['password']['incorrect'] = 'Nhập sai mật khẩu';
            }
        }
    }

    if (empty($errors)) {
        $_SESSION['success'] = 'Đăng nhập thành công';
        $_SESSION['user'] = $username;
        if (isset($_POST['save_info'])) {
            $cookie_data = ['user' => $username, 'password' => $password];
            saveCookie($cookie_data, 15);
        }
        header('Location: index.php?action=home');
        exit();
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
    <title><?php echo empty($page_title) ? 'FORM PHP' : $page_title?></title>
</head>
<body>
    <div class="col-lg-4">
        <form method="post" class="">
            <div class="form-group">
                <label for="Username">Username: </label>
                <input class="form-control" type="text" name="username" id="" style="margin-top: 20px;" value="<?php echo old('username')?>"> <br>
                <?php 
                form_validate('<span class="text-danger">', '</span> </br>', $errors, 'username');
                ?>
            </div>
            <div class="form-group">
                <label for="password">Password: </label>
                <input class="form-control" id="password" type="password" name="password" style="margin-top: 20px;" value="<?php echo old('password')?>"> <br>
                <?php 
                    form_validate('<span class="text-danger">', '</span> </br>', $errors, 'password');
                ?>  
            </div>
            <div class="form-group">
                <label for="">Lưu đăng nhập</label>
                <input type="checkbox" name="save_info" id="">
            </div>
            <button class="btn btn-primary" type="submit" name="submit" value="submited">Submit</button>
            <a href="index.php?action=register">Đăng ký mới</a>
        </form>
    </div>
</body>