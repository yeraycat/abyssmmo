<?php
    require_once(dirname(__FILE__) . "/template/header_component.php");
    require_once(dirname(__FILE__) . "/template/footer_component.php");

    $header_component = new HeaderComponent(null, "register");
    $footer_component = new FooterComponent($GAME_OWNER);

    $header_component->render();
?>
    <div class="row">
        <div class="col l6 offset-l3">
            <h3><?php if($error != ""): ?>
                <?= $error ?>
            <?php else: ?>
                <?= $result ?>
            <?php endif; ?></h3>
        </div>
    </div>
    
<?php
    $footer_component->render();