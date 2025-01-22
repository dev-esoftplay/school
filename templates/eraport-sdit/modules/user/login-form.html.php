<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php echo $sys->meta(); ?>

        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            html {
                height: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
                background-color: #F4F7F8;
            }

            .login_box {
                display: flex;
                flex-direction: column;
                gap: 2rem;
                padding: 2rem;
            }

            .login_title {
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .login_title img {
                width: 28rem;
            }

            .login_form {
                display: flex;
                flex-direction: column;
                gap: 0.375rem;
            }

            .login_submit {
                font-family: 'Poppins';
                font-weight: bold;
            }

            h3 {
                margin: 0;
            }
        </style>
    </head>
    <body>
        <div class="login_box">
            <div class="login_title text-center">
                <img src="<?php echo _URL ?>templates/eraport-sdit/img/logo.webp" alt="Login Logo"/>
                <h3>Selamat Datang Kembali!</h3>
            </div>

            <form method="POST" class="login_form">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Username anda" name="usr" required>
                </div>

                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password anda" name="pwd" required>
                </div>

                <div class="checkbox">
                    <label><input type="checkbox" name="rememberme"> Remember me</label>
                </div>

                <div>
                    <button type="submit" class="login_submit btn btn-success btn-block">Submit</button>
                </div>
            </form>
        </div>

        <script src="<?php echo _URL; ?>templates/admin/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    </body>
</html>