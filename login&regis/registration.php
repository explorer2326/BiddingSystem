<?php
    require_once 'init.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 <link rel="stylesheet" type="text/css" href="CSS/registerCSS.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>register</title>
  </head>
    <style>
    .error { color: red;}
    article .button {
        margin-left: 40%;
    }
            .firstcol{
        text-align: left;
    }
    </style>
  <body>

    <header>
        <h1>Auction System</h1>
    </header>

    <article>

        
            <form action="" method="post">
                <br><br>
                <br><br><br><br>
                <div class="container">
                    <div class="row" align = "left">
                         <div class="col-sm" class="firstcol">
                            <p>Username:</p>
                            <p>Password:</p>
                            <p>Password Confirmation:</p>
                            <p>Name:</p>
                            <p>Email:</p>                            
                        </div>
                        <div class="col-sm">
                            <div>
                                <input type="text" name="username" value="<?php echo Input::get('username');?>">
                            </div>
                            <div>
                                <input type="password" name="password" value="<?php echo Input::get('password');?>">
                            </div>
                            <div>
                                <input type="password" name="password-confirmation" value="<?php echo Input::get('password-confirmation');?>">
                            </div>
                            <div>
                                <input type="text" name="name" value="<?php echo Input::get('name');?>">
                            </div>
                            <div>
                                <input type="text" name="email" value="<?php echo Input::get('email');?>">
                            </div>
                            
                        </div>
                        <div class="col-sm">
                        <div class="error" style="background-color:lightblue">

                        <?php
                            if(Input::exists()) {
                                if(CSRF_Protection::check(Input::get('token'))){
                                    $validate = new RegistrationValidator();
                                    $validation = $validate -> check($_POST,array(
                                        'username' => [
                                            'required' => true,
                                            'max' => 20,
                                            'min' => 3,
                                            'unique' => 'userinfo'
                                        ],                                        
                                        'password' => [
                                            'required' => true,
                                            'max' => 30,
                                            'min' => 6,
                                            'secure' => 'username'
                                        ],
                                        'password-confirmation' => [
                                            'required' => true,
                                            'matches' => 'password'
                                        ],
                                        'name' => [
                                            'required' => true,
                                            'max' => 30,
                                            'min' => 2
                                        ],
                                        'email' => [
                                            'required' => true,
                                            'email' => true
                                        ]
                                    ));

                                    if($validation->passed()){
                                        $user = new User();
                                        try{
                                            $user->create(array(
                                                'username' => Input::get('username'),
                                                'password' => Hash::encrypt(Input::get('password')),
                                                'name' => Input::get('name'),
                                                'email' => Input::get('email'),
                                                'joined' => date('Y-m-d H:i:s'),
                                                'group' => 1
                                            ));

                                            Session::flash('home','You have been successfully registered');
                                            header('Location: login.php');
                                        } catch(Exception $e) {
                                            die($e->getMessage());
                                        }
                                    } else {

                                        foreach ($validation->errors() as $error) {
                                            echo '* ' . $error . '<br>';
                                        }
                                    }
                                }
                            }
                        ?>                               
                        </div>
                        
                 </div>
                 </div>
                <div id="submitbutton">
                    <input type="hidden" name = "token" value = "<?php echo CSRF_Protection::generate(); ?>">
                    <input type="submit" value = "Register" class="button">
                </div>
                  
                
            </form>
      


    </article>
    <footer>Copyright &copy; Team 28</footer>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>