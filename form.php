<?php
require_once 'function.php';
$errors = [];
if (isset($_POST['submit'])) {
    // validate name
    $name = $_POST['name'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $profession = $_POST['profession'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // var_dump(isPhoneNumber('0987123123'));
    // var_dump(preg_match('/[A-Z]/', 'abcD23123'));
    // var_dump(preg_match('/[A-Z]/', 'aBc123123'));
    // die();
    // vailidate name
    if (empty($name)) {
        $errors['name']['required'] = 'Không được để trống tên';
    }

    // validate email
    if (empty($email)) {
        $errors['email']['required'] = 'Không được để trống email';
    } else {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email']['validate'] = 'Email sai định dạng';
        }
    }

    // validate phone
    if (empty($phone)) {
        $errors['phone']['required'] = 'Không được để trống SĐT';
    } else {
        if (!isPhoneNumber($phone))  {
            $errors['phone']['validate'] = 'SĐT sai định dạng';
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
        } else if (preg_match('/[a-zA-Z0-9]/', $password)) {
            $errors['password']['special'] = 'Mật khẩu phải có ký tự đặc biệt';
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
    <title>Form validation</title>
</head>
<body>
<form method="post">
    <label for="name">Name: </label>
    <input id="name" type="text" name="name"> <br>
    <?php 
        form_validate('<span class="text-danger">', '</span> </br>', $errors, 'name');
    ?>

    <label for="age">Age: </label>
    <input id="age" type="number" name="age" style="margin-top: 20px;"> <br>

    <label for="Address">Address: </label>
    <input id="Address" type="text" name="address" style="margin-top: 20px;"> <br>

    <label for="phone">Phone: </label>
    <input id="phone" type="text" name="phone" style="margin-top: 20px;"> <br>
    <?php 
        form_validate('<span class="text-danger">', '</span> </br>', $errors, 'phone');
    ?>

    <label for="profession">Profession: </label>
    <input id="profession" type="text" name="profession" style="margin-top: 20px;"> </br>
    

    <label for="email">Email: </label>
    <input id="email" type="email" name="email" style="margin-top: 20px;"> <br>
    <?php 
        form_validate('<span class="text-danger">', '</span> </br>', $errors, 'email');
    ?>

    <label for="password">Password: </label>
    <input id="password" type="password" name="password" style="margin-top: 20px;"> <br>
    <?php 
        form_validate('<span class="text-danger">', '</span> </br>', $errors, 'password');
    ?>

    <button type="submit" name="submit" value="submited">Submit</button>
</form>

    <?php
        show('<p>', '</p>', 'Name: ', $name);
        show('<p>', '</p>', 'Age: ', $age);
        show('<p>', '</p>', 'Address: ', $address);
        show('<p>', '</p>', 'Phone: ', $phone);
        show('<p>', '</p>', 'Profession: ', $profession);
        show('<p>', '</p>', 'Email: ', $email);
        show('<p>', '</p>', 'Password: ', $password, true);
    ?>
</body>
</html>
