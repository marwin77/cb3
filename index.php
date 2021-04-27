<?php
require_once 'core/init.php';
include('includes/indexheader.php');
if(Session::exists('home')){
    echo '<p>' . Session::flash('home'). '</p>';

}
$user = new User();

//echo Session::get(Config::get('session/session_name'));
/*
$user = new User(Session::get(Config::get('session/session_name')));
echo $user->data()?->id;
*/
if($user->isLoggedIn()){
    echo 'Nazwa sesji: '.Session::get(Config::get('session/session_name')).'<br>';
    $_SESSION['user'] = $user->data()->nrTelefonu;


    ?>

    <p>Witaj, <a href="profile.php?user=<?php echo escape($user->data()->nrTelefonu);?>"><?php echo escape($user->data()->imie); ?></p>


    <ul>
        <li><a href="update.php">Update Profile</a></li>
        <li><a href="changepassword.php">Change Password</a></li>
        <li><a href="logout.php">Log out</a></li>
    </ul>

    <?php
    if($user->data()->grupa == 1){
    Redirect::to('sklep.php');
    }else{
        Redirect::to('dashboard.php');
    }
}
    /*
    if($user->hasPermission('administrator')){
        $_SESSION['permission'] = 'administrator';


        ?>
        <form action="dashboard.php" method="post">
            <div class="field">
                <label for="nrKlienta">Nr telefonu klienta</label>
                <input type="text" name="nrKlienta" id="nrKlienta" autocomplete="off">
            </div>

            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
            <input type="submit" value="Szukaj">
        </form>


        <?php

    }elseif ($user->hasPermission('supermoderator')){
        $_SESSION['permission'] = 'supermoderator';
    }elseif ($user->hasPermission('moderator')){
        $_SESSION['permission'] = 'moderator';
    }
    else {

        $_SESSION['user']=$user->data()->nrTelefonu;
        Redirect::to('sklep.php');
    }
    $_SESSION['user']=$user->data()->nrTelefonu;
    Redirect::to('dashboard.php');
}

*/




    include ('includes/footer.php');




