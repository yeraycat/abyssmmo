<?php

require_once(dirname(__FILE__) . "/template/header_component.php");
$header_component = new HeaderComponent(null, "login");
$header_component->render();
?>
<main>
    <div class="row">
        <div class="game-description col s12 l6">
            <h4>Sobre <?= $GAME_NAME ?></h3>
            <?= $GAME_DESCRIPTION ?>
        </div>
        <div class="signup-form col s12 l6">  
            <h4>Login</h4>      
            <form class="row" action="authenticate.php" method="post" name="login" onsubmit="return saveme();" id="login">
                <div class="input-field col s12">
                    <input id="username" type="text" name="username" class="validate">
                    <label for="username">Usuario</label>
                </div>
                <div class="input-field col s12">
                    <input id="password" type="password" name="password" class="validate">
                    <label for="password">Password</label>
                </div>
                <div class="input-field col s12">
                    Mantener sesión
                    <div class="switch">
                        <label>
                            No
                            <input type="checkbox" name="save">
                            <span class="lever"></span>
                            Sí
                        </label>
                    </div>
                </div>
                <div class="input-field col s12">
                <button class="btn waves-effect waves-light" type="submit" name="action">Login
                    <i class="material-icons right">send</i>
                </button>
                </div>
            </form>
        </div>
    </div>
    <h3>
        <a href='register.php'>¡Regístrate ahora!</a>
    </h3>
</main>
