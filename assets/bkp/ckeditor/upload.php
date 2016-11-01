<?php
 
// Function number as indicated by CKEditor.
$func_number = $_GET['CKEditorFuncNum'] ;
 
// The returned url of the uploaded file
$url = '' ;
 
// Optional message to show to the user (file renamed, invalid file, not authenticated...)
$message = '';
 
// In CKeditor the uploaded file was sent as 'upload'
if (isset($_FILES['upload'])) {
     
    $name = $_FILES['upload']['name'];
    $temp_name = $_FILES['upload']['tmp_name'];
     
    // If filename exists then append number '1' and increment it
    $actual_name = pathinfo($name, PATHINFO_FILENAME);
    $original_name = $actual_name;
    $extension = pathinfo($name, PATHINFO_EXTENSION);
     
    $count = 1;
    while(file_exists('image/' . $actual_name . "." . $extension)) {
         
        $actual_name = (string)$original_name . $count;
        $name = $actual_name . "." . $extension;
        $count++;
         
    }
     
    // Upload file
    move_uploaded_file($temp_name, 'image/'. $name);
     
    // Get base url
    $base_url =  "http://" . $_SERVER['SERVER_NAME'];
     
    // Build the url that should be used for this file   
    $url = $base_url . "/ckeditor/image/" . $name ;
     
} else {
     
    $message = 'No file has been sent';
     
}
 
// We are in an iframe, so we must talk to the object in window.parent
echo "<script type='text/javascript'> window.parent.CKEDITOR.tools.callFunction($func_number, '$url', '$message')</script>";
 
?>