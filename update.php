<?php
require_once 'core/init.php';

$user = new User();
if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}
if(Input::exists()){
    if(Token::check(Input::get('token'))){
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
                'salt' => array(
                        'required'=>true
                    //tu musi być zawarty ten sam zestw reguł jak przy rejestracji
                )
        ));
        if($validation->passed()){
            try{
                $user->update(array(
                    //lista elementów do aktualizzacji:
                    'salt'=>Input::get('salt')
                ));
             Session::flash('home', 'Twoje dane zostały zaktualizowane');
             Redirect::to('index.php');
            }catch (Exception $e){
                die($e->getMessage());
            }
        }else{
            foreach ($validation->errors() as $error) {
                echo $error.'<br>';
            }
        }
    }
    else{
        echo 'nie';
    }
}



?>
    <form action="" method="post">
        <div class="field"></div>
        <label for="salt">Salt</label>
        <input type="text" name="salt" value="<?php echo escape($user->data()->salt); ?>">
        <input type="submit" value="Uaktualnij">
        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

    </form>
