<?php
require_once 'init.php';

$user = new User();

if(!$user->isLoggedIn()) {
	header('Location: index.php');
}

if(Input::exists()) {
    if(CSRF_Protection::check(Input::get('token'))){

        $validate = new RegistrationValidator();
        $validation = $validate->check($_POST,array(
            'name' => array(
                'required' => true,
                'min' => 2,
                'max' => 50
            )
        ));

        if ($validation->passed()) {
            try{
                $user->update(array(
                    'name' => Input::get('name')
                ));

                Session::flash('home','Your details have been updated');
                header('Location: index.php');

            } catch(Exception $e) {
                die($e->getMessage());
            }
        } else {
            foreach ($validation->errors() as $error) {
                echo $error, '<br>';
            }
        }
    }
}


?>
	<form action="" method="post">
                <br><br>
                <br><br><br><br>
                <div class="field">
                    <div class="row" align = "left">
                        <div class="col-sm">
                            <div>
                                <input type="text" name="name" value="<?php echo escape($user->data()->name);?>">
                            </div> 
                        </div>
                        <div class="col-sm">
                        <div class="error">                      
                        </div>
                        
                 </div>
                 </div>
                <div id="submitbutton">
                    <input type="hidden" name = "token" value = "<?php echo CSRF_Protection::generate(); ?>">
                    <input type="submit" value = "Update" class="button">
                </div>
                  
                
            </form>

<?php

	echo '<p>You need to <a href="login.php">log in or <a href="registration.php">register</a></p>';
