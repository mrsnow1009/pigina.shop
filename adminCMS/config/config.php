<?php 
    /* cau hinh db, danh sach ngon ngu */
    file_exists($_LEVEL.'config/identify.php')?include_once($_LEVEL.'config/identify.php'):die($_LEVEL.'config/identify.php khong ton tai');
    /* cau hinh bien toan cuc */
    file_exists($_LEVEL.'config/config_global.php')?include_once($_LEVEL.'config/config_global.php'):die($_LEVEL.'config/config_global.php khong ton tai');
    /* cau hinh ngon ngu - global*/
    file_exists(_PHISICAL_PATH_ROOT.'language/global_lang_vn.php')?include_once(_PHISICAL_PATH_ROOT.'language/global_lang_vn.php'):die(_PHISICAL_PATH_ROOT.'language/global_lang_vn.php khong ton tai');
    /* cau hinh ngon ngu */
    file_exists(_PHISICAL_PATH_ADMIN.'language/lang_vn.php')?include_once(_PHISICAL_PATH_ADMIN.'language/lang_vn.php'):die(_PHISICAL_PATH_ADMIN.'language/lang_vn.php khong ton tai');
    define('_LANG', serialize($LANG));
    /* cau hinh dong bo frontend va backend */
    file_exists($_LEVEL.'config/define.php')?include_once($_LEVEL.'config/define.php'):die($_LEVEL.'config/define.php khong ton tai');
    /* include file session */
    file_exists(_PATH_SESSION_CLASS)?include_once(_PATH_SESSION_CLASS):die(_PATH_SESSION_CLASS.' khong ton tai');

    /* cau hinh path file va folder */
    file_exists(_PHISICAL_PATH_ADMIN.'config/define.php')?include_once(_PHISICAL_PATH_ADMIN.'config/define.php'):die(_PHISICAL_PATH_ADMIN.'config/define.php khong ton tai');
    /* khai bao attribute */
    file_exists(_PHISICAL_PATH_ADMIN.'config/define_general.php')?include_once(_PHISICAL_PATH_ADMIN.'config/define_general.php'):die(_PHISICAL_PATH_ADMIN.'config/define_general.php khong ton tai');
    /* cau hinh cac url file */
    file_exists(_PHISICAL_PATH_ADMIN.'config/config_link.php')?include_once(_PHISICAL_PATH_ADMIN.'config/config_link.php'):die(_PHISICAL_PATH_ADMIN.'config/config_link.php khong ton tai');
    
?>