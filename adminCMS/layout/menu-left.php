<div class="nav-left" id="nav-left">
    <div class="accordion border-end" id="menu-left">

        <div class="accordion-item border-0 rounded-0 mb-1">
            <h2 class="accordion-header" id="heading-widget">
                <button class="accordion-button collapsed fw-bold shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-widget" aria-expanded="false" aria-controls="collapse-widget"><?php echo $LANG['config'].' '.$LANG['widget']; ?></button>
            </h2>
            <div id="collapse-widget" class="accordion-collapse collapse" aria-labelledby="heading-widget" data-bs-parent="#menu-left">
                <div class="accordion-body p-0">
                    <div class="list-group list-group-flush">
                        <a href="<?php echo _LINK_WIDGET_BOX_LIST; ?>" class="list-group-item list-group-item-action" title=""><?php echo $LANG['list-widget-box']; ?></a>
                        <?php if(_DEV_MODE === 1){ ?>
                        <a href="<?php echo _LINK_WIDGET_LIST; ?>" class="list-group-item list-group-item-action" title=""><?php echo $LANG['list-widget']; ?></a>
                        <a href="<?php echo _LINK_WIDGET_CREATE; ?>" class="list-group-item list-group-item-action" title=""><?php echo $LANG['add-widget']; ?></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion-item border-0 rounded-0 mb-1">
            <h2 class="accordion-header" id="heading-category">
                <button class="accordion-button collapsed fw-bold shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-category" aria-expanded="false" aria-controls="collapse-category"><?php echo $LANG['category']; ?></button>
            </h2>
            <div id="collapse-category" class="accordion-collapse collapse" aria-labelledby="heading-category" data-bs-parent="#menu-left">
                <div class="accordion-body p-0">
                    <div class="list-group list-group-flush">
                        <a href="<?php echo _LINK_CATEGORY_CONTENT; ?>" class="list-group-item list-group-item-action" title=""><?php echo $LANG['category-content']; ?></a>
                        <a href="<?php echo _LINK_CATEGORY_PRODUCT; ?>" class="list-group-item list-group-item-action" title=""><?php echo $LANG['category-product']; ?></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion-item border-0 rounded-0 mb-1">
            <h2 class="accordion-header" id="heading-content">
                <button class="accordion-button collapsed fw-bold shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-content" aria-expanded="false" aria-controls="collapse-content"><?php echo $LANG['content']; ?></button>
            </h2>
            <div id="collapse-content" class="accordion-collapse collapse" aria-labelledby="heading-content" data-bs-parent="#menu-left">
                <div class="accordion-body p-0">
                    <div class="list-group list-group-flush">
                        <a href="<?php echo _LINK_CONTENT_LIST; ?>" class="list-group-item list-group-item-action" title=""><?php echo $LANG['list-article']; ?></a>
                        <a href="<?php echo _LINK_CONTENT_CREATE; ?>" class="list-group-item list-group-item-action" title=""><?php echo $LANG['add-article']; ?></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion-item border-0 rounded-0 mb-1">
            <h2 class="accordion-header" id="heading-news">
                <button class="accordion-button collapsed fw-bold shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-news" aria-expanded="false" aria-controls="collapse-news"><?php echo $LANG['news']; ?></button>
            </h2>
            <div id="collapse-news" class="accordion-collapse collapse" aria-labelledby="heading-news" data-bs-parent="#menu-left">
                <div class="accordion-body p-0">
                    <div class="list-group list-group-flush">
                        <a href="<?php echo _LINK_NEWS_LIST; ?>" class="list-group-item list-group-item-action" title=""><?php echo $LANG['list-news']; ?></a>
                        <a href="<?php echo _LINK_NEWS_CREATE; ?>" class="list-group-item list-group-item-action" title=""><?php echo $LANG['add-news']; ?></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion-item border-0 rounded-0 mb-1">
            <h2 class="accordion-header" id="heading-product">
                <button class="accordion-button collapsed fw-bold shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-product" aria-expanded="false" aria-controls="collapse-product"><?php echo $LANG['product']; ?></button>
            </h2>
            <div id="collapse-product" class="accordion-collapse collapse" aria-labelledby="heading-product" data-bs-parent="#menu-left">
                <div class="accordion-body p-0">
                    <div class="list-group list-group-flush">
                        <a href="<?php echo _LINK_PRODUCT_LIST; ?>" class="list-group-item list-group-item-action" title=""><?php echo $LANG['list-product']; ?></a>
                        <a href="<?php echo _LINK_PRODUCT_CREATE; ?>" class="list-group-item list-group-item-action" title=""><?php echo $LANG['add-product']; ?></a>
                        <a href="<?php echo _LINK_PRODUCT_PRICE_LIST; ?>" class="list-group-item list-group-item-action" title=""><?php echo $LANG['list-product-price']; ?></a>
                        <a href="<?php echo _LINK_PRODUCT_PRICE_CREATE; ?>" class="list-group-item list-group-item-action" title=""><?php echo $LANG['add-product-price']; ?></a>
                        <a href="<?php echo _LINK_COLOR_LIST; ?>" class="list-group-item list-group-item-action" title=""><?php echo $LANG['list-color']; ?></a>
                        <a href="<?php echo _LINK_COLOR_CREATE; ?>" class="list-group-item list-group-item-action" title=""><?php echo $LANG['add-color']; ?></a>
                        <a href="<?php echo _LINK_SIZE_LIST; ?>" class="list-group-item list-group-item-action" title=""><?php echo $LANG['list-size-attribute']; ?></a>
                        <a href="<?php echo _LINK_SIZE_CREATE; ?>" class="list-group-item list-group-item-action" title=""><?php echo $LANG['add-size-attribute']; ?></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion-item border-0 rounded-0 mb-1">
            <h2 class="accordion-header" id="heading-unit">
                <button class="accordion-button collapsed fw-bold shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-unit" aria-expanded="false" aria-controls="collapse-unit"><?php echo $LANG['unit']; ?></button>
            </h2>
            <div id="collapse-unit" class="accordion-collapse collapse" aria-labelledby="heading-unit" data-bs-parent="#menu-left">
                <div class="accordion-body p-0">
                    <div class="list-group list-group-flush">
                        <a href="<?php echo _LINK_UNIT_LIST; ?>" class="list-group-item list-group-item-action" title=""><?php echo $LANG['list-unit']; ?></a>
                        <a href="<?php echo _LINK_UNIT_CREATE; ?>" class="list-group-item list-group-item-action" title=""><?php echo $LANG['add-unit']; ?></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion-item border-0 rounded-0 mb-1">
            <h2 class="accordion-header" id="heading-brand">
                <button class="accordion-button collapsed fw-bold shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-brand" aria-expanded="false" aria-controls="collapse-brand"><?php echo $LANG['brand']; ?></button>
            </h2>
            <div id="collapse-brand" class="accordion-collapse collapse" aria-labelledby="heading-brand" data-bs-parent="#menu-left">
                <div class="accordion-body p-0">
                    <div class="list-group list-group-flush">
                        <a href="<?php echo _LINK_BRAND_LIST; ?>" class="list-group-item list-group-item-action" title=""><?php echo $LANG['list-brand']; ?></a>
                        <a href="<?php echo _LINK_BRAND_CREATE; ?>" class="list-group-item list-group-item-action" title=""><?php echo $LANG['add-brand']; ?></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion-item border-0 rounded-0 mb-1">
            <h2 class="accordion-header" id="heading-order">
                <button class="accordion-button collapsed fw-bold shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-order" aria-expanded="false" aria-controls="collapse-order"><?php echo $LANG['order']; ?></button>
            </h2>
            <div id="collapse-order" class="accordion-collapse collapse" aria-labelledby="heading-order" data-bs-parent="#menu-left">
                <div class="accordion-body p-0">
                    <div class="list-group list-group-flush">
                        <a href="<?php echo _LINK_ORDER_LIST; ?>" class="list-group-item list-group-item-action" title=""><?php echo $LANG['list-order']; ?></a>
                        <?php if(_DEV_MODE === 1){ ?>
                        <a href="<?php echo _LINK_ORDER_CREATE; ?>" class="list-group-item list-group-item-action" title=""><?php echo $LANG['add-order']; ?></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion-item border-0 rounded-0 mb-1">
            <h2 class="accordion-header" id="heading-deliverymethod">
                <button class="accordion-button collapsed fw-bold shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-deliverymethod" aria-expanded="false" aria-controls="collapse-deliverymethod"><?php echo $LANG['deliverymethod']; ?></button>
            </h2>
            <div id="collapse-deliverymethod" class="accordion-collapse collapse" aria-labelledby="heading-deliverymethod" data-bs-parent="#menu-left">
                <div class="accordion-body p-0">
                    <div class="list-group list-group-flush">
                        <a href="<?php echo _LINK_DELIVERYMETHOD_LIST; ?>" class="list-group-item list-group-item-action" title=""><?php echo $LANG['list-deliverymethod']; ?></a>
                        <a href="<?php echo _LINK_DELIVERYMETHOD_CREATE; ?>" class="list-group-item list-group-item-action" title=""><?php echo $LANG['add-deliverymethod']; ?></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion-item border-0 rounded-0 mb-1">
            <h2 class="accordion-header" id="heading-paymentmethod">
                <button class="accordion-button collapsed fw-bold shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-paymentmethod" aria-expanded="false" aria-controls="collapse-paymentmethod"><?php echo $LANG['paymentmethod']; ?></button>
            </h2>
            <div id="collapse-paymentmethod" class="accordion-collapse collapse" aria-labelledby="heading-paymentmethod" data-bs-parent="#menu-left">
                <div class="accordion-body p-0">
                    <div class="list-group list-group-flush">
                        <a href="<?php echo _LINK_PAYMENTMETHOD_LIST; ?>" class="list-group-item list-group-item-action" title=""><?php echo $LANG['list-paymentmethod']; ?></a>
                        <a href="<?php echo _LINK_PAYMENTMETHOD_CREATE; ?>" class="list-group-item list-group-item-action" title=""><?php echo $LANG['add-paymentmethod']; ?></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion-item border-0 rounded-0 mb-1">
            <h2 class="accordion-header" id="heading-banner">
                <button class="accordion-button collapsed fw-bold shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-banner" aria-expanded="false" aria-controls="collapse-banner"><?php echo $LANG['banner']; ?></button>
            </h2>
            <div id="collapse-banner" class="accordion-collapse collapse" aria-labelledby="heading-banner" data-bs-parent="#menu-left">
                <div class="accordion-body p-0">
                    <div class="list-group list-group-flush">
                        <a href="<?php echo _LINK_BANNER_LIST; ?>" class="list-group-item list-group-item-action" title=""><?php echo $LANG['list-banner']; ?></a>
                        <a href="<?php echo _LINK_BANNER_CREATE; ?>" class="list-group-item list-group-item-action" title=""><?php echo $LANG['add-banner']; ?></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion-item border-0 rounded-0 mb-1">
            <h2 class="accordion-header" id="heading-contact-form">
                <button class="accordion-button collapsed fw-bold shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-contact-form" aria-expanded="false" aria-controls="collapse-contact-form"><?php echo $LANG['contact-form']; ?></button>
            </h2>
            <div id="collapse-contact-form" class="accordion-collapse collapse" aria-labelledby="heading-contact-form" data-bs-parent="#menu-left">
                <div class="accordion-body p-0">
                    <div class="list-group list-group-flush">
                        <a href="<?php echo _LINK_CONTACT_FORM_LIST; ?>" class="list-group-item list-group-item-action" title=""><?php echo $LANG['list-contact-form']; ?></a>
                        <?php if(_DEV_MODE === 1){ ?>
                        <a href="<?php echo _LINK_CONTACT_FORM_CREATE; ?>" class="list-group-item list-group-item-action" title=""><?php echo $LANG['add-contact-form']; ?></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion-item border-0 rounded-0 mb-1">
            <h2 class="accordion-header" id="heading-template">
                <a class="accordion-button collapsed fw-bold shadow-none no-caret" href="<?php echo _LINK_TEMPLATE_LIST; ?>" title=""><?php echo $LANG['list-template']; ?></a>
            </h2>
        </div>

        <div class="accordion-item border-0 rounded-0 mb-1">
            <h2 class="accordion-header" id="heading-company">
                <button class="accordion-button collapsed fw-bold shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-company" aria-expanded="false" aria-controls="collapse-company"><?php echo $LANG['information'].' '.$LANG['company']; ?></button>
            </h2>
            <div id="collapse-company" class="accordion-collapse collapse" aria-labelledby="heading-company" data-bs-parent="#menu-left">
                <div class="accordion-body p-0">
                    <div class="list-group list-group-flush">
                        <a href="<?php echo _LINK_COMPANY_LIST; ?>" class="list-group-item list-group-item-action" title=""><?php echo $LANG['list-company']; ?></a>
                        <a href="<?php echo _LINK_BRANCH_LIST; ?>" class="list-group-item list-group-item-action" title=""><?php echo $LANG['list-branch']; ?></a>
                        <a href="<?php echo _LINK_BRANCH_CREATE; ?>" class="list-group-item list-group-item-action" title=""><?php echo $LANG['add-branch']; ?></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion-item border-0 rounded-0 mb-1">
            <h2 class="accordion-header" id="heading-webmaster">
                <button class="accordion-button collapsed fw-bold shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-webmaster" aria-expanded="false" aria-controls="collapse-webmaster"><?php echo $LANG['webmaster']; ?></button>
            </h2>
            <div id="collapse-webmaster" class="accordion-collapse collapse" aria-labelledby="heading-webmaster" data-bs-parent="#menu-left">
                <div class="accordion-body p-0">
                    <div class="list-group list-group-flush">
                        <a href="<?php echo _LINK_WEBMASTER_LIST; ?>" class="list-group-item list-group-item-action" title=""><?php echo $LANG['account_list']; ?></a>
                        <a href="<?php echo _LINK_WEBMASTER_CREATE; ?>" class="list-group-item list-group-item-action" title=""><?php echo $LANG['add-webmaster']; ?></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion-item border-0 rounded-0 mb-1">
            <h2 class="accordion-header" id="heading-config">
                <button class="accordion-button collapsed fw-bold shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-config" aria-expanded="false" aria-controls="collapse-config"><?php echo $LANG['config'].' '.$LANG['system']; ?></button>
            </h2>
            <div id="collapse-config" class="accordion-collapse collapse" aria-labelledby="heading-config" data-bs-parent="#menu-left">
                <div class="accordion-body p-0">
                    <div class="list-group list-group-flush">
                        <a href="<?php echo _LINK_CONFIG_SMTP; ?>" class="list-group-item list-group-item-action" title=""><?php echo $LANG['smtp-config']; ?></a>
                        <a href="<?php echo _LINK_CONFIG_OTHER; ?>" class="list-group-item list-group-item-action" title=""><?php echo $LANG['other-config']; ?></a>
                        <a href="<?php echo _LINK_CONFIG_ROBOT_SITEMAP; ?>" class="list-group-item list-group-item-action" title=""><?php echo $LANG['robot-sitemap-config']; ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>