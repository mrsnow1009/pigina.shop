<?php

    date_default_timezone_set('Asia/Ho_Chi_Minh');
    
    $DOMAIN_ACCOUNT  =  $_SERVER['HTTP_HOST'];

    $web_Config = array(
        'WebsiteName' => 'tuyetshop',
        'DomainName' => 'tuyetshop',
        'lang' => array('default' => 'vn','list' => array('en','vn')),
        'rewrite' => '1',
        'currency' => 'VND',
        'ssl' => 'off',
        'licenseCKFinder' => '',
        'view' => 'template'
    );

    $WEBCONFIG =array();
    $WEBCONFIG['DB'] = array(
        'hosting' => 'localhost',
        'name_db' => 'db_tuyetshop',
        'user_db' => 'root',
        'pass_db' => '',
        'port_db' => '');

    $WEBCONFIG['WEBSITENAME'] = $web_Config['WebsiteName'];
    $WEBCONFIG['LANG_DEFAULT'] = $web_Config['lang']['default'];
    $WEBCONFIG['LANG_ARR'] = $web_Config['lang']['list'];
    $WEBCONFIG['REWRITE'] = $web_Config['rewrite'];
    $WEBCONFIG['CURRENCY'] = $web_Config['currency'];
    $WEBCONFIG['ONSSL'] = $web_Config['ssl'];
    $WEBCONFIG['VIEW'] = $web_Config['view'];
    
    define('WEBCONFIG', serialize($WEBCONFIG));
?>
