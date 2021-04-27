<?php
require_once 'core/init.php';
    if(!$nrTelefonu = Input::get('user')){
        Redirect::to('index.php');
    }else{
        $user = new User($nrTelefonu);
        if(!$user->exists()){
            Redirect::to(404);
        }else{
            $data = $user->data();
            echo $user->data()->nrTelefonu;

        ?>
<h3><?php echo escape($data->imie) ?></h3>
<p> Nawisko: <?php echo escape($data->nazwisko);?></p>
<?php
    }
    }
