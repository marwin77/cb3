<?php
require_once 'core/init.php';
include ('includes/indexheader.php');
//echo $_SESSION['user'];
/*
if(!isset($_SESSION['user'])){
    Redirect::to('login.php');
}else{
    $user = new User($_SESSION['user']);
    echo $user->data()->grupa;
}

if(isset($user)){
    if($user->data()->grupa != 4){
        session_destroy();
        Redirect::to('index.php');
    }
}
echo $user->data()->grupa;
*/

if(Input::exists()) {
    if (Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'imie' => array(
                'required' => true,
                'min' => 2,
                'max' => 30
            ),
            'nazwisko' => array(
                'required' => true,
                'min' => 2,
                'max' => 30
            ),
            'nrTelefonu' => array(
                'required' => true,
                'min' => 9,
                'max' => 9,
                'unique' => 'users'
            ),

            'email' => array(
                'required' => true,
                'min' => 2,
                'max' => 30,
                'unique' => 'users'
            ),
            'haslo' => array(
                'required' => true,
                'min' => 6
            ),
            'haslo2' => array(
                'required' => true,
                'matches' => 'haslo'
            )
        ));

        if ($validation->passed()) {
            $user = new User();
            $salt = Hash::salt(32);


            try{

                $user->create(array(
                        'imie'=>Input::get('imie'),
                        'nazwisko'=>Input::get('nazwisko'),
                        'nrTelefonu'=>Input::get('nrTelefonu'),
                        'email'=>Input::get('email'),
                        'haslo'=>Hash::make(Input::get('haslo')),
                        'salt'=>'rezerwa',
                        'joined'=>date('Y-m-d H:i:s'),
                        'grupa'=>1
                ));

                Session::flash('home', 'Użytkownik został zarejstrowany');
                Redirect::to('index.php');

            }catch(Exception $e){
                die($e->getMessage());
            }
        } else {
            foreach ($validation->errors() as $error) {
               // echo $error . "<br";
                ?>
                <div class = "container">
    <div class="row">
        <div class ="col-md-5 mx-auto">
            <div class="text-danger">
            <?php echo $error;?>
        </div>
            </div>
            </div>
            </div>
            <?php
            }
        }
    }
}?>
<div class = "container">
    <div class="row">
        <div class ="col-md-5 mx-auto">

<form action="" method="post">
    <div class="form-group">
        <label for="imie">Imię</label>
        <input type="text" name="imie" id="imie" value="<?php echo escape(Input::get('imie'));?>" class="form-control">

    </div>

    <div class="form-group">
        <label for="nazwisko">Nazwisko</label>
        <input type="text" name="nazwisko" id="nazwisko" value="<?php echo escape(Input::get('nazwisko'));?>" class="form-control">
    </div>

    <div class="form-group">
        <label for="nrTelefonu">Nr telefonu: </label>
        <input type="text" name="nrTelefonu" id="nrTelefonu" value="<?php echo escape(Input::get('nrTelefonu'));?>" class="form-control">
    </div>

    <div class="form-group">
        <label for="email">E-mail</label>
        <input type="email" name="email" id="email" value="<?php echo escape(Input::get('email'));?>" class="form-control">
    </div>

    <div class="form-group">
        <label for="haslo">Podaj hasło</label>
        <input type="password" name="haslo" id="haslo" class="form-control">
    </div>

    <div class="form-group">
        <label for="haslo2">Powtórz hasło</label>
        <input type="password" name="haslo2" id="haslo2" class="form-control">
    </div>

    <div>
        <input type="hidden" name="token" value="<?php echo Token::generate();?>">
    </div>
<br>
    <div class="d-grid">
        <button type="submit" class="btn btn-info" value="Zarejestruj">Zarejestruj</button>
    </div>


</form>
        </div>
    </div>
</div>

<?php
include ('includes/footer.php');
?>


