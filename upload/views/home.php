<?php
require_once(dirname(__FILE__) . "/template/header_component.php");
require_once(dirname(__FILE__) . "/template/footer_component.php");
require_once(dirname(__FILE__) . "/template/sidenav_component.php");

$header_component = new HeaderComponent($user, "home", TRUE);
$footer_component = new FooterComponent($GAME_OWNER, $user);

$header_component->render();
?>
<div class="row">
    <div class="col s12">
        <div class="card teal darken-1">
            <div class="card-content white-text">
                <span class="card-title">General info</span>
                <table>
                    <tr>
                        <td><b>Name:</b> <?= $user->username ?></td>
                        <td><b>Crystals:</b> <?= $cm ?></td>
                    </tr>
                    <tr>
                        <td><b>Level:</b> <?= $user->level ?></td>
                        <td><b>Exp:</b> <?= $exp?>%</td>
                    </tr>
                    <tr>
                        <td><b>Money:</b> <?= $fm ?></td>
                        <td><b>HP:</b> <?= $user->hp?>/<?= $user->max_hp ?></td>
                    </tr>
                    <tr>
                        <td><b>Property:</b> <?= $user->get_house()->name ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col s12">
        <div class="card teal darken-1">
            <div class="card-content white-text">
                <span class="card-title">Stats info</span>
                <table>
                    <tr>
                        <td><b>Strength:</b> <?= $formatted_stats['strength'] ?> [Ranked: <?= $formatted_stats['strank'] ?>]</td>
                        <td><b>Agility:</b> <?= $formatted_stats['agility'] ?> [Ranked: <?= $formatted_stats['agirank'] ?>]</td>
                    </tr>
                    <tr>
                        <td><b>Guard:</b> <?= $formatted_stats['guard'] ?> [Ranked: <?= $formatted_stats['guarank'] ?>]</td>
                        <td><b>Labour:</b> <?= $formatted_stats['labour'] ?> [Ranked: <?= $formatted_stats['labrank'] ?>]</td>
                    </tr>
                    <tr>
                        <td><b>IQ:</b> <?= $formatted_stats['IQ'] ?> [Ranked: <?= $formatted_stats['IQrank'] ?>]</td>
                        <td><b>Total stats:</b> <?= $ts ?> [Ranked: <?= $tsrank ?>]</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<?php

$footer_component->render();
