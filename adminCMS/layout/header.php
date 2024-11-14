<nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top">
    <div class="container-fluid">
        <button onclick="menuLeft()" id="navleft-option" class="navbar-toggler d-block me-3" type="button"><span class="navbar-toggler-icon"></span></button>
        <a title="<?php echo $LANG['index']; ?>" class="navbar-brand" href="index.php"><img src="assets/images/logo.png" alt=""></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-top">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-top">
            <ul class="navbar-nav w-100">
                <li class="nav-item">
                    <a class="nav-link" href="index.php" title=""><?php echo $LANG['index']; ?></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="javascript:;" role="button" data-bs-toggle="dropdown" title=""><i class="fa-regular fa-sitemap"></i> <?php echo $LANG['category']; ?></a></a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="<?php echo _LINK_CATEGORY_CONTENT; ?>" title=""><?php echo $LANG['category-content']; ?></a></li>
                        <li><a class="dropdown-item" href="<?php echo _LINK_CATEGORY_PRODUCT; ?>" title=""><?php echo $LANG['category-product']; ?></a></li>
                    </ul>
                </li> 
                <li class="nav-item ms-md-auto">
                    <a href="<?php echo _LINK_ORDER_LIST; ?>" class="btn btn-primary position-relative" title="">
                        <?php echo $LANG['order']; ?>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">3</span>
                    </a>
                </li>
                <li class="nav-item ms-md-5">
                    <a href="<?php echo _LINK_CONTACT_LIST; ?>" class="btn btn-primary position-relative" title="">
                        <?php echo $LANG['contact']; ?>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">1</span>
                    </a>
                </li>
                <!-- <li class="nav-item ms-md-5">
                    <a class="nav-link" href="#" title="">Newsletter</a>
                </li> -->
                <li class="nav-item dropdown ms-md-5">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" title=""><i class="fa-regular fa-user rounded-pill"></i> <?php echo $LANG['hello']; ?>, <?php echo $webmt_fullname; ?></a></a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="<?php echo _LINK_WEBMASTER_INFO; ?>" title="<?php echo $LANG['account-info']; ?>"><?php echo $LANG['account-info']; ?></a></li>
                        <li><a class="dropdown-item" href="<?php echo _LINK_WEBMASTER_CHANGE_PASSWORD; ?>" title="<?php echo $LANG['change-password']; ?>"><?php echo $LANG['change-password']; ?></a></li>
                        <li><a class="dropdown-item" href="logout.php" title=""><?php echo $LANG['logout']; ?></a></li>
                    </ul>
                </li> 
            </ul>
        </div>
    </div>
</nav>