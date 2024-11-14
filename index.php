<?php 

    $_LEVEL ='';
    file_exists('config/config.php')?include_once('config/config.php'):die('config/config.php khong ton tai');

    file_exists(_PATH_DB_LOCAL_CLASS)?include_once(_PATH_DB_LOCAL_CLASS):die(_PATH_DB_LOCAL_CLASS.' khong ton tai');
    file_exists(_PATH_METHOD_CLASS)?include_once(_PATH_METHOD_CLASS):die(_PATH_METHOD_CLASS.' khong ton tai');
    
    /* khai bao bien toan cuc */
    // $Session = new Session();

    /* get data - layout */

?>
<!DOCTYPE html>
<html>
<head>

</head>
<body>
    controler -> data -> layout -> script
</body>

</html>