<?php

require_once(dirname(__FILE__) . "/template/header_component.php");
require_once(dirname(__FILE__) . "/template/footer_component.php");
require_once(dirname(__FILE__) . "/template/sidenav_component.php");

$header_component = new HeaderComponent($user, "gamerules", TRUE);
$footer_component = new FooterComponent($GAME_OWNER, $user);

$header_component->render();
?>
<div class="row">
    <div class="col s12">
        <h2>Voting</h2>
        <p>Here you may vote for <?= $GAME_NAME ?> at various RPG toplists and be rewarded.</p>
        <ul>
            <li><a href=''>Vote at NonRewardedTop (no reward)</a></li>
            <li><a href='votetwg.php'>Vote at TWG (20% energy restore)</a></li>
            <li><a href='votetrpg.php'>Vote at TOPRPG (\$300)</a></li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col s12">
        
    </div>
</div>
<?php

$footer_component->render();