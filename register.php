<?php
    require_once 'core/init.php';

    if(Input::exists()){
        echo '';
    }
?>

<form action="" method="post">
    <div class="field">
        <label for="imie">Imię</label>
        <input type="text" name="imie" id="imie" value="" autocomplete="off">
    </div>

    <div class="field">
        <label for="nazwisko">Nazwisko</label>
        <input type="text" name="nazwisko" id="nazwisko" value="" autocomplete="off">
    </div>

    <div class="field">
        <label for="haslo">Podaj hasło</label>
        <input type="password" name="haslo" id="haslo">
    </div>

    <div class="field">
        <label for="haslo2">Powtórz hasło</label>
        <input type="password" name="haslo2" id="haslo2">
    </div>

    <input type="submit" value="Zarejestruj"

</form>