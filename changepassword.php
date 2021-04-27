<?php
/**
 * Created by Chris on 9/29/2014 3:53 PM.
 */

require_once 'core/init.php';

$user = new User();

if(!$user->isLoggedIn()) {
    Redirect::to('index.php');
}

if(Input::exists()) {
    if(Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'password_current' => array(
                'required' => true,
                'min' => 6
            ),
            'password_new' => array(
                'required' => true,
                'min' => 6
            ),
            'password_new_again' => array(
                'required' => true,
                'min' => 6,
                'matches' => 'password_new'
            )
        ));
    }

    if($validation->passed()) {
            $password = Input::get('password_current');

            if(!password_verify($password, $user->data()->haslo)) {
            echo 'Podaj prawidłowe aktualne hasło.';
                } else {


            //$salt = Hash::salt(32);
            $user->update(array(
                'haslo' => Hash::make(Input::get('password_new')),
                //'salt' => $salt
            ));

            Session::flash('home', 'Hasło zostało zaktualizowane');
            Redirect::to('index.php');

        }
    } else {
        foreach($validation->errors() as $error) {
            echo $error, '<br>';
        }
    }
}
?>

<form action="" method="post">
    <div class="field">
        <label for="password_current">Aktualne hasło:</label>
        <input type="password" name="password_current" id="password_current">
    </div>

    <div class="field">
        <label for="new_password">Nowe hasło:</label>
        <input type="password" name="password_new" id="password_new">
    </div>

    <div class="field">
        <label for="password_new_again">Powtórz nowe hasło</label>
        <input type="password" name="password_new_again" id="password_new_again">
    </div>

    <input type="hidden" name="token" id="token" value="<?php echo escape(Token::generate()); ?>">
    <input type="submit" value="Zmień hasło">
</form>
