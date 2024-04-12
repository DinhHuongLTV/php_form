<?php 
$dir = 'upload/img/';
$errors = [];

if (isset($_POST['submit'])) {
    $file = $_FILES['your_file'];
    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';
    if ($file['error']) {
        $errors['file']['error'] = 'Có lỗi khi submit file, chọn lại file';
    } else {
        $extension_accepted = ['jpg', 'png'];
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $file_size_in_mb = round($file['size']/1024/1024, 2);
        if (!in_array($extension, $extension_accepted)) {
            $errors['file']['accepted'] = 'Không chấp nhận định dạng khác ngoài png, jpg';
        } else if ($file_size_in_mb > 5){
            $errors['file']['large'] = 'File quá lớn';
        }   
    }

    if (empty($errors)) {
        if (file_exists($dir.'/'.$file['name'])) {
            if (isset($_POST['Ghi_De'])) {
                move_uploaded_file($file['tmp_name'], $dir.$file['name']);
            } else {
                move_uploaded_file($file['tmp_name'], $dir.time().$file['name']);
            }
        } else {
            move_uploaded_file($file['tmp_name'], $dir.$file['name']);
        }
    }
}   
?>
<form action="" method="post" enctype="multipart/form-data">
    <div>
        <input type="file" name="your_file"> <br>
        <span style="color: red; font-style:italic;"><?php echo isset($errors['file']) ? reset($errors['file']) : null?></span>
    </div>
    <div style="margin-top: 20px;">
        <input type="radio" name="Ghi_De" id=""> <label for="">Up ảnh mới?</label> <br>
    </div>
    <button type="submit" name="submit" value="submit" style="margin-top: 20px;">Submit</button>
</form>