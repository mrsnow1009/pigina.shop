<?php 

    $_LEVEL ='../';
    file_exists('config/config.php')?include_once('config/config.php'):die('config/config.php khong ton tai');

    file_exists(_PATH_DB_LOCAL_CLASS)?include_once(_PATH_DB_LOCAL_CLASS):die(_PATH_DB_LOCAL_CLASS.' khong ton tai');
    file_exists(_PATH_METHOD_CLASS)?include_once(_PATH_METHOD_CLASS):die(_PATH_METHOD_CLASS.' khong ton tai');
    file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_WEBMASTER)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_WEBMASTER):die(_PHISICAL_PATH_ADMIN_CONTROLLER_WEBMASTER.' khong ton tai');
    file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_LOGIN)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_LOGIN):die(_PHISICAL_PATH_ADMIN_CONTROLLER_LOGIN.' khong ton tai');

    $login_controller = new login_controller();

    /* kiem tra da dang nhap hay chua */
    if ($login_controller->checklogin()) {
        header('location:'._ROOT_PATH_ADMIN.'index.php');
        die();
    }

    /* xu ly action login */
    $txt_username       = method::_Post("txt_username","string");
    $txt_password       = method::_Post("txt_password","string");
    $act_login          = method::_Post("act_login","string");
    if ($act_login == 'login') {
        $result = $login_controller->login($txt_username,$txt_password);
        if ($result === 'error_status') {
            method::alert($LANG['error_login_status'],_LINK_LOGIN);
            die();
        }elseif ($result) {
            header('location:'._LINK_DASHBOARD);
            die();
        }else{
            method::alert($LANG['error_login'],_LINK_LOGIN);
            die();
        }
    }

    /* xu ly error dang nhap */
    // $err_login          = method::_Get("err","string");
    // $err_text = '';
    // if ($err_login == 'false')
    //     $err_text = $LANG['error_login'];
    // elseif ($err_login == 'status')
    //     $err_text = $LANG['error_login_status'];
    

?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $LANG['login']; ?></title>
    
    <?php include _PHISICAL_PATH_ADMIN_VIEW_LAYOUT.'head.php';?>

</head>
<body>

    <div class="container">
        <div class="d-flex justify-content-center vh-100 align-items-center">
            <div class="login-wrapper">
                <form action="" role="form" method="post" class="needs-validation" novalidate>
                    <div class="card h-100">
                        <h3 class="card-header text-uppercase fw-bold border border-success text-center text-bg-success pt-3 pb-3 mb-2"><?php echo $LANG['login']; ?></h3>
                        <div class="card-body ps-4 pe-4 pb-4">
                            <!-- <div class="text-danger mb-3 d-empty-none fz-07rem" id="err_login"><?php //echo $err_text; ?></div> -->
                            <div class="mb-3">
                                <input type="text" class="form-control" id="txt_username" name="txt_username" value="" placeholder="<?php echo $LANG['username']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" id="txt_password" name="txt_password" value="" placeholder="<?php echo $LANG['password']; ?>" required>
                            </div>
                            <div class="mb-3 text-end">
                                <a href="#forgot-password" title="" class="text-decoration-none" data-bs-toggle="modal"><?php echo $LANG['forgot_password']; ?></a>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary ps-5 pe-5"><?php echo $LANG['login']; ?></button>
                                <input type="hidden" value="login" name="act_login" id="act_login">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal fade" id="forgot-password" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel"><?php echo $LANG['reset_password']; ?></h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<?php echo $LANG['close']; ?>"></button>
                        </div>
                        <div class="modal-body">
                            <input type="email" class="form-control" id="txt_resetPassword" placeholder="<?php echo $LANG['enter_email']; ?>" value="" required>
                            <div class="text-danger mt-2 d-empty-none fz-07rem" id="err_forgot"></div>
                        </div>
                        <div class="modal-footer">
                            <button id="btn_resetPassword" type="button" class="btn btn-primary"><?php echo $LANG['reset_password']; ?> <i class="fa-duotone fa-spinner s-loading ms-3"></i></button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo $LANG['close']; ?></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- js -->
    <?php include _PHISICAL_PATH_ADMIN_VIEW_LAYOUT.'script.php';?>

    <script type="text/javascript">
    $(document).ready(function(){
        /* bat su kien input cua reset password nhap text */
        var delay_timer;
        $('input#txt_resetPassword').bind('keydown', function(e) { /*  blur change */
            clearTimeout(delay_timer);
            delay_timer = setTimeout(function() {
                var _email = $('input#txt_resetPassword').val();
                if (!isValidEmail(_email)){
                    $('#err_forgot').text('<?php echo $LANG["email_invalid"]; ?>');
                    $('#btn_resetPassword').attr('disabled','disabled');
                }else{
                    $('#err_forgot').text('');
                    $('#btn_resetPassword').removeAttr('disabled');
                }
                $.ajax({
                    type: 'GET',
                    url: '<?php echo _ROOT_PATH_ADMIN_AJAX; ?>',
                    dataType:'json',
                    data: 'q=check-email&tb=account&email='+_email
                }).fail(function() {
                    alert('Ajax Error!');
                }).done(function (data){
                    if (data.flag == 'true') {
                        $('#err_forgot').text('');
                        $('#btn_resetPassword').removeAttr('disabled');
                    }else{
                        $('#err_forgot').text('<?php echo $LANG["email_invalid"]; ?>');
                        $('#btn_resetPassword').attr('disabled','disabled');
                    }
                });
            }, 300 );
        });

        /* mo popup forgot: xoa input, xoa err*/
        $( "#forgot-password" ).on('shown.bs.modal', function(){
            $('input#txt_resetPassword').val('').focus();
            $('#err_forgot').text('');
        });

        /* submit forgot password */
        $( "#btn_resetPassword" ).on('click', function(){
            var _email = $('input#txt_resetPassword').val();
            if (_email != '' && isValidEmail(_email)){
                $('#btn_resetPassword').attr('disabled','disabled').addClass('show-loading');
                $.ajax({
                    type: 'GET',
                    url: '<?php echo _ROOT_PATH_ADMIN_AJAX; ?>',
                    dataType:'json',
                    data: 'q=forgot-password&email='+_email
                }).fail(function() {
                    alert('Ajax Error!');
                }).done(function (data){
                    if (data.flag == 'true') {
                        $('#err_forgot').text('<?php echo $LANG["note_reset_password_is_completed"]; ?>');
                    }else{
                        $('#err_forgot').text('<?php echo $LANG["error_try_again"]; ?>');
                    }
                    $('#btn_resetPassword').removeAttr('disabled','disabled').removeClass('show-loading');
                });
            }else{
                $('#err_forgot').text('<?php echo $LANG["email_invalid"]; ?>');
                $('#btn_resetPassword').attr('disabled','disabled');
            }
        });

    });
    </script>

</body>

</html>