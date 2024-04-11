<?php
function isPhoneNumber($phone) {
    $checkZeroFirst = false;
    $checkLenInt = false;
    if ($phone[0] == '0') {
        $checkZeroFirst = true;
        $phone = substr($phone, 1);
    } 

    if (strlen($phone) == 9 && filter_var($phone, FILTER_VALIDATE_INT)) {
        $checkLenInt = true;
    }
    return $checkLenInt && $checkZeroFirst;
}

function form_validate($open_tag, $close_tag, $errors, $field) {
    echo isset($errors[$field]) ? $open_tag.reset($errors[$field]).$close_tag : null;
}

function show($open_tag, $close_tag, $field, $value, $isPassword = false) {
    if ($isPassword) {
        $lenth = strlen($value);
        $value = str_repeat('*', $lenth);
    }
    echo !empty($value) ? $open_tag . $field .$value . $close_tag : null;
}

function old($field) {
    return isset($_POST[$field]) ? $_POST[$field] : null; 
}

