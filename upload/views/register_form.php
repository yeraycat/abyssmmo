<?php
    require_once(dirname(__FILE__) . "/template/header_component.php");
    require_once(dirname(__FILE__) . "/template/footer_component.php");

    $header_component = new HeaderComponent(null, "register");
    $footer_component = new FooterComponent($GAME_OWNER);

    $header_component->render();
?>
    <div class="col l6 offset-l3">
        <h3 class="row">Regístrate</h3>
        <form class="row" action="register.php" method="post">
            <input type="hidden" name="ref" value="<?= $fref ?>" />
            <div class="input-field col s12">
                <input id="username" type="text" name="username" class="teal-text text-lighten-4 validate">
                <label for="username">Usuario</label>
            </div>
            <div class="input-field col s12">
                <input id="password" type="password" name="password" class="teal-text text-lighten-4 validate">
                <label for="password">Password</label>
            </div>
            <div class="input-field col s12">
                <input id="cpassword" type="password" name="cpassword" class="teal-text text-lighten-4 validate">
                <label for="cpassword">Confirm password</label>
            </div>
            <div class="input-field col s12">
                <input id="email" type="email" name="email" class="teal-text text-lighten-4 validate">
                <label for="email">Email</label>
            </div>
            <div class="input-field col s12">
                <input id="promo" type="text" name="promo" class="teal-text text-lighten-4 validate">
                <label for="promo">Promo code</label>
            </div>
            <div class="input-field col s12">
                <button class="btn waves-effect waves-light" type="submit" name="action">Sign up
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </form> 
    </div>
    

<?php
    $footer_component->render();
