<?php
$file_name = 'logs.txt';
$myfile = fopen($file_name, 'r') or die ('Không mở được file: '. $file_name);
while(!feof($myfile)) {
    echo fgets($myfile);
}
fclose($myfile);