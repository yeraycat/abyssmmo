<?php

require_once(dirname(__FILE__) . "/template/header_component.php");
require_once(dirname(__FILE__) . "/template/footer_component.php");

$header_component = new HeaderComponent($user, "loggedin", TRUE);
$header_component->render();

$footer_component = new FooterComponent($GAME_OWNER, $user);

?>

<div class="row">
    <div class="col s12">
        <h3>Welcome back, your last visit was: <br /><?= $user->get_last_visit() ?>.</h3>
    </div>
</div>
<div class="row">
    <div class="col s12">
        <h4><?= $GAME_NAME ?> Latest news:</h4>
        <p><?= $content ?></p>
    </div>
</div>

<?php

$footer_component->render();