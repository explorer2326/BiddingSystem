<span style="color: black; font-size: 30px;">
<?php
require_once 'init.php';

if (Session::exists('home')){
    echo Session::flash('home');
}

if(Input::exists()){
    if(CSRF_Protection::check(Input::get('token'))) {
        $validate = new RegistrationValidator();
        $validation = $validate->check($_POST, array(
            'username' => array('required' => true),
            'password' => array('required' => true)
        ));

        if($validation->passed()) {
            $user = new User();
            $login = $user->login(Input::get('username'), Input::get('password'));

            if($login) {
                $_SESSION['userid'] = $user->data()->userid;
                $_SESSION['username'] = $user->data()->username;
                $_SESSION['joined'] = $user->data()->joined;
                header('Location: ../item.php');
            } else {
                echo '<p>Sorry, username and password do not match.</p>';
            }
        } else {
            foreach ($validation->errors() as $error) {
                echo $error, '<br>';
            }
        }
    }
}
?>
</span>

<!DOCTYPE html>
<html>
<head>
    <!-- Bootstrap and CSS -->
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.1/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="CSS/LoginCSS.css">
    <link rel="stylesheet" href="//cdn.bootcss.com/font-awesome/4.2.0/css/font-awesome.min.css"/>

    <!-- bootstarp.js and jquery -->
    <script src="http://cdn.gbtags.com/jquery/2.1.1/jquery.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="http://apps.bdimg.com/libs/bootstrap/3.3.4/js/bootstrap.min.js" type="text/javascript"
            charset="utf-8"></script>
    <!-- end -->

</head>
<body>

<div class="flex-container">

    <!-- Title -->
    <header>
        <h1>MARKET28</h1>
    </header>

    <article>

        <div class="login">
            <form id="login" action="" method="post">
                <br><br>
                <br><br><br><br><br><br>
                <div>
                    Username:
                    <input type="text" name="username">
                </div>
                <div>
                    Password:
                    <input type="password" name="password">
                </div>
                <div>
                    <input type="hidden" name = "token" value = "<?php echo CSRF_Protection::generate(); ?>">
                    <input type="submit" name="submit" value="sign in" class="button">
                    <a href="registration.php"><button class="button" type="button">Register</button></a>
                </div>
                <i class="fa fa-info-circle fa-lg" id="mark"></i>
                <div class="pop">
                    <span>X</span>
                    <h1>Login Instruction</h1>
                    <P>###This is instruction###</P>
                    <P>If you want to manage users information, using account of administrator to login the system.</P>
                </div>
                
            </form>
        </div>


    </article>
    <footer>Copyright &copy; Team 28</footer>

</div>

</body>
</html>

<script type="text/javascript">
    $(document).ready(function () {
        $("#mark").click(function () {
            $(".pop").fadeIn(300);
            positionPopup();
        });

        $(".pop > span, .pop").click(function () {
            $(".pop").fadeOut(300);
        });
    });
</script>