<?php

require_once(dirname(__FILE__) . "/template/header_component.php");
require_once(dirname(__FILE__) . "/template/footer_component.php");
require_once(dirname(__FILE__) . "/template/sidenav_component.php");

$header_component = new HeaderComponent($user, "explore", TRUE);
$footer_component = new FooterComponent($GAME_OWNER, $user);
$cyberstate = $user->location == 5;
$industrial_sector = $user->location == 4;
$game_url = determine_game_urlbase();

$header_component->render();
?>
<div class="row">
    <div class="col s12">
        <h2>You begin exploring the area you're in, you see a bit that interests you.</h2>
    </div>
</div>
<div class="row">
    <div class="col s12 <?= $cyberstate ? 'l4' : 'l6' ?>">
        <div class="card teal lighten-3">
            <div class="card-content teal-text text-darken-4">
                <span class="card-title">Market Place</span>
                <ul>
                    <li><a class="teal-text text-darken-2" href='shops.php'>Shops</a></li>
                    <li><a class="teal-text text-darken-2" href='itemmarket.php'>Item Market</a></li>
                    <li><a class="teal-text text-darken-2" href='cmarket.php'>Crystal Market</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col s12 <?= $cyberstate ? 'l4' : 'l6' ?>">
        <div class="card teal lighten-3">
            <div class="card-content teal-text text-darken-4">
                <span class="card-title">Serious Money Makers</span>
                <ul>
                    <li><a class="teal-text text-darken-2" href='monorail.php'>Travel Agency</a></li>
                    <li><a class="teal-text text-darken-2" href='estate.php'>Estate Agent</a></li>
                    <li><a class="teal-text text-darken-2" href='bank.php'>City Bank</a></li>
                </ul>
            </div>
        </div>
    </div>
    <?php if($cyberstate): ?>
    <div class="col s12 l4">
        <div class="card teal lighten-3">
            <div class="card-content teal-text text-darken-4">
                <span class="card-title">Cyber State</span>
                <ul>
                    <li><a class="teal-text text-darken-2" href='cyberbank.php'>Cyber Bank</a></li>
                </ul>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>
<div class="row">
    <div class="col s12 l4">
        <div class="card teal darken-3">
            <div class="card-content">
                <span class="card-title">Dark Side</span>
                <ul>
                    <li><a class="teal-text text-lighten-3" href='fedjail.php'>Federal Jail</a></li>
                    <li><a class="teal-text text-lighten-3" href='slotsmachine.php?tresde=<?= $tresder ?>'>Slots Machine</a></li>
                    <li><a class="teal-text text-lighten-3" href='roulette.php?tresde=<?= $tresder ?>'>Roulette</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col s12 l8">
        <div class="card teal lighten-3">
            <div class="card-content teal-text text-darken-4">
                <span class="card-title">Statistics Dept</span>
                <ul>
                    <li><a class="teal-text text-darken-2" href='userlist.php'>Users List</a></li>
                    <li><a class="teal-text text-darken-2" href='stafflist.php'><?= $GAME_NAME ?> Staff</a></li>
                    <li><a class="teal-text text-darken-2" href='halloffame.php'>Hall of Fame</a></li>
                    <li><a class="teal-text text-darken-2" href='stats.php'>Game Stats</a></li>
                    <li><a class="teal-text text-darken-2" href='usersonline.php'>Users Online</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <?php if($cyberstate): ?>
    <div class="col s12 l6">
        <div class="card teal lighten-3">
            <div class="card-content teal-text text-darken-4">
                <span class="card-title">Cyber Casino</span>
                <ul>
                    <li><a class="teal-text text-darken-2" href='slotsmachine3.php'>Super Slots</a></li>
                </ul>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="col s12 <?= $cyberstate ? 'l6' : 'l12' ?>">
        <div class="card teal lighten-3">
            <div class="card-content teal-text text-darken-4">
                <span class="card-title">Mysterious</span>
                <ul>
                    <li><a class="teal-text text-darken-2" href='crystaltemple.php'>Crystal Temple</a></li>
                    <?php if($industrial_sector): ?>
                    <li><a class="teal-text text-darken-2" href='battletent.php'>Battle Tent</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col s12">
    <p>This is your referal link: http://<?= $game_url ?>/register.php?REF=<?= $userid ?> </p>
    Every signup from this link earns you two valuable crystals!
    </div>
</div>
<?php

$footer_component->render();