<?php 
    if (!isset($_GET['module']) || $_GET['module'] == ''){
        header('Location: index.php?module=dashboard&act=index');
        die();
    }else
        $module = $_GET['module'];

    if (!isset($_GET['act']) || $_GET['act'] == ''){
        header('Location: index.php?module=dashboard&act=index');
        die();
    }else
        $act = $_GET['act'];

    /* node danh cho danh muc, art... - code: _NEWS, _RPRODUCT */
    if (!isset($_GET['node']) || $_GET['node'] == '')
        $node = '';
    else
        $node = $_GET['node'];

    $_LEVEL ='../';
    file_exists('config/config.php')?include_once('config/config.php'):die('config/config.php khong ton tai');

    file_exists(_PATH_DB_LOCAL_CLASS)?include_once(_PATH_DB_LOCAL_CLASS):die(_PATH_DB_LOCAL_CLASS.' khong ton tai');
    file_exists(_PATH_METHOD_CLASS)?include_once(_PATH_METHOD_CLASS):die(_PATH_METHOD_CLASS.' khong ton tai');
    
    /* kiem tra da dang nhap hay chua */
    file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_LOGIN)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_LOGIN):die(_PHISICAL_PATH_ADMIN_CONTROLLER_LOGIN.' khong ton tai');
    $login_controller = new login_controller();
    if (!$login_controller->checklogin()) {
        header('location:'._ROOT_PATH_ADMIN.'login.php?err=false');
        die();
    }
    /* khai bao bien toan cuc */
    $Session = new Session();
    /* khai bao method danh rieng cho bo source code cua admin */
    // file_exists(_PHISICAL_PATH_ADMIN_CLASSES_METHOD)?include_once(_PHISICAL_PATH_ADMIN_CLASSES_METHOD):die(_PHISICAL_PATH_ADMIN_CLASSES_METHOD.' khong ton tai');
    /* load du lieu cho module + act */
    file_exists(_PHISICAL_PATH_ADMIN_VIEW_DATA.$module.'/'.$act.'.php')?include_once(_PHISICAL_PATH_ADMIN_VIEW_DATA.$module.'/'.$act.'.php'):die(_PHISICAL_PATH_ADMIN_VIEW_DATA.$module.'/'.$act.'.php khong ton tai');
    /* load du lieu cho header */
    file_exists(_PHISICAL_PATH_ADMIN_VIEW_LAYOUT.'header-data.php')?include_once(_PHISICAL_PATH_ADMIN_VIEW_LAYOUT.'header-data.php'):die(_PHISICAL_PATH_ADMIN_VIEW_LAYOUT.'header-data.php khong ton tai');

?>
<!DOCTYPE html>
<html>
<head>
    
    <?php include _PHISICAL_PATH_ADMIN_VIEW_LAYOUT.'head.php';?>

</head>
<body>

    <!-- header -->
    <?php include _PHISICAL_PATH_ADMIN_VIEW_LAYOUT.'header.php';?>

    <!-- menu left -->
    <?php include _PHISICAL_PATH_ADMIN_VIEW_LAYOUT.'menu-left.php';?>

    <!-- contantner page -->
    <div class="container-wrapper ps-3 pe-3" id="container-wrapper">

        <?php 
            $act_view = _PHISICAL_PATH_ADMIN_VIEW.$module.'/'.$act.'.php';
            if(file_exists($act_view)) include $act_view;
            else die($act_view.' khong ton tai');
        ?>

    </div>

    <!-- footer -->
    <?php include _PHISICAL_PATH_ADMIN_VIEW_LAYOUT.'footer.php';?>

    <!-- js -->
    <?php 
        include _PHISICAL_PATH_ADMIN_VIEW_LAYOUT.'script.php';
        $act_js = _PHISICAL_PATH_ADMIN_VIEW_SCRIPT.$module.'/'.$act.'.php';
        if(file_exists($act_js)) include $act_js;
        else die($act_js.' khong ton tai');
    ?>
    
</body>

</html>