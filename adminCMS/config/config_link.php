<?php
    define('_LINK_HOME', 'index.php');
    /**
        login
    */
    define('_LINK_LOGIN', 'login.php');
    /**
        dashboard
    */
    define('_LINK_DASHBOARD', _LINK_HOME);
    /**
        categories
    */
    define('_LINK_CATEGORY_LIST', _LINK_HOME.'?module=category&act=list');
    define('_LINK_CATEGORY_CREATE', _LINK_HOME.'?module=category&act=create');
    define('_LINK_CATEGORY_CONTENT', _LINK_CATEGORY_LIST.'&node=content');
    define('_LINK_CATEGORY_PRODUCT', _LINK_CATEGORY_LIST.'&node=product');
    /**
        content
    */
    define('_LINK_ARTICLE_LIST', _LINK_HOME.'?module=content&act=list');
    define('_LINK_ARTICLE_CREATE', _LINK_HOME.'?module=content&act=create');
    define('_LINK_CONTENT_LIST', _LINK_ARTICLE_LIST.'&node=content');
    define('_LINK_CONTENT_CREATE', _LINK_ARTICLE_CREATE.'&node=content&lang='._LANG_ADMIN_DEFAULT);
    define('_LINK_NEWS_LIST', _LINK_ARTICLE_LIST.'&node=news');
    define('_LINK_NEWS_CREATE', _LINK_ARTICLE_CREATE.'&node=news&lang='._LANG_ADMIN_DEFAULT);
    /**
        product
    */
    define('_LINK_PRODUCT_LIST', _LINK_HOME.'?module=product&act=list');
    define('_LINK_PRODUCT_CREATE', _LINK_HOME.'?module=product&act=create');
    /**
        unit
    */
    define('_LINK_UNIT_LIST', _LINK_HOME.'?module=unit&act=list');
    define('_LINK_UNIT_CREATE', _LINK_HOME.'?module=unit&act=create');
    /**
        brand
    */
    define('_LINK_BRAND_LIST', _LINK_HOME.'?module=brand&act=list');
    define('_LINK_BRAND_CREATE', _LINK_HOME.'?module=brand&act=create');
    /**
        member
    */
    define('_LINK_MEMBER_LIST', _LINK_HOME.'?module=member&act=list');
    define('_LINK_MEMBER_CREATE', _LINK_HOME.'?module=member&act=create');
    /**
        order
    */
    define('_LINK_ORDER_LIST', _LINK_HOME.'?module=order&act=list');
    define('_LINK_ORDER_CREATE', _LINK_HOME.'?module=order&act=create');
    define('_LINK_ORDER_DETAIL', _LINK_HOME.'?module=order&act=detail');
    /**
        delivery method
    */
    define('_LINK_DELIVERYMETHOD_LIST', _LINK_HOME.'?module=deliverymethod&act=list');
    define('_LINK_DELIVERYMETHOD_CREATE', _LINK_HOME.'?module=deliverymethod&act=create');
    /**
        payment method
    */
    define('_LINK_PAYMENTMETHOD_LIST', _LINK_HOME.'?module=paymentmethod&act=list');
    define('_LINK_PAYMENTMETHOD_CREATE', _LINK_HOME.'?module=paymentmethod&act=create');
    /**
        banner
    */
    define('_LINK_BANNER_LIST', _LINK_HOME.'?module=banner&act=list');
    define('_LINK_BANNER_CREATE', _LINK_HOME.'?module=banner&act=create');
    /**
        contact
    */
    define('_LINK_CONTACT_LIST', _LINK_HOME.'?module=contact&act=list');
    define('_LINK_CONTACT_CREATE', _LINK_HOME.'?module=contact&act=create');
    /**
        webmaster
    */
    define('_LINK_WEBMASTER', _LINK_HOME.'?module=webmaster');
    define('_LINK_WEBMASTER_LIST', _LINK_WEBMASTER.'&act=list');
    define('_LINK_WEBMASTER_INFO', _LINK_WEBMASTER.'&act=info');
    define('_LINK_WEBMASTER_CHANGE_PASSWORD', _LINK_WEBMASTER.'&act=change-password'); /* done */
    define('_LINK_WEBMASTER_CREATE', _LINK_WEBMASTER.'&act=create');
    /**
        template
    */
    define('_LINK_TEMPLATE_LIST', _LINK_HOME.'?module=template&act=list');
    define('_LINK_TEMPLATE_CREATE', _LINK_HOME.'?module=template&act=create');
    /**
        company
    */
    define('_LINK_COMPANY_LIST', _LINK_HOME.'?module=company&act=list');
    define('_LINK_COMPANY_CREATE', _LINK_HOME.'?module=company&act=create');
    /**
        branch
    */
    define('_LINK_BRANCH_LIST', _LINK_HOME.'?module=branch&act=list');
    define('_LINK_BRANCH_CREATE', _LINK_HOME.'?module=branch&act=create');
    /**
        config
    */
    define('_LINK_CONFIG_SMTP', _LINK_HOME.'?module=config&act=smtp');
    define('_LINK_CONFIG_OTHER', _LINK_HOME.'?module=config&act=other');
    define('_LINK_CONFIG_ROBOT_SITEMAP', _LINK_HOME.'?module=config&act=robot-sitemap');
    /**
        size
    */
    define('_LINK_SIZE_LIST', _LINK_HOME.'?module=size&act=list');
    define('_LINK_SIZE_CREATE', _LINK_HOME.'?module=size&act=create');
    /**
        color
    */
    define('_LINK_COLOR_LIST', _LINK_HOME.'?module=color&act=list');
    define('_LINK_COLOR_CREATE', _LINK_HOME.'?module=color&act=create');
    /**
        product price
    */
    define('_LINK_PRODUCT_PRICE_LIST', _LINK_HOME.'?module=product-price&act=list');
    define('_LINK_PRODUCT_PRICE_CREATE', _LINK_HOME.'?module=product-price&act=create');
    /**
        contact form
    */
    define('_LINK_CONTACT_FORM_LIST', _LINK_HOME.'?module=contact-form&act=list');
    define('_LINK_CONTACT_FORM_CREATE', _LINK_HOME.'?module=contact-form&act=create');
    /**
        widget
    */
    define('_LINK_WIDGET_LIST', _LINK_HOME.'?module=widget&act=list');
    define('_LINK_WIDGET_CREATE', _LINK_HOME.'?module=widget&act=create');
    define('_LINK_WIDGET_BOX_LIST', _LINK_HOME.'?module=widget&act=box_list');
    define('_LINK_WIDGET_BOX_CREATE', _LINK_HOME.'?module=widget&act=box_create');
?>