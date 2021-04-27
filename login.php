<?php
require_once 'core/init.php';
include ('includes/loginheader.php');
if(Input::exists()){
    if(Token::check(Input::get('token'))){
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
                'email'=>array('required'=>true),
                'haslo'=>array('required'=>true)
            ));
        if($validation->passed()){
            $user = new User();
            $login = $user->login(Input::get('email'), Input::get('haslo'));

            if($login){
                Redirect::to('index.php');
            }else{
                echo 'Przykro nam, błędny email lub hasło!';
            }
        }else{
            foreach($validation->errors() as $error){
                echo $error, '<br>';
            }
        }
    }
}
?>
<div class = "container">
    <div class="row">
        <div class ="col-md-5 mx-auto">

            <form action="" method="post">
                <div class="form-group">
                    <label for="email">Email/Nr telefonu</label>
                    <input type="text" name="email" id="email" class="form-control">
                </div>

                <div class="form-group">
                    <label for="haslo">Hasło</label>
                    <input type="password" name="haslo" id="haslo" class="form-control">
                </div>

                <div>
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                </div>
<br>

                <div class="d-grid">
                    <button type="submit" class="btn btn-info" value="Zaloguj">Zaloguj</button>
                </div>

            </form>

        </div>
    </div>
</div>



<?php
include ('includes/footer.php');
?>
