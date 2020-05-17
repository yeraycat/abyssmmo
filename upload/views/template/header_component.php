<?php

if (strpos($_SERVER['PHP_SELF'], "header_component.php") !== false)
{
    exit;
}

require_once(dirname(__FILE__) . "/../../global_func.php");
require_once(dirname(__FILE__) . "/../../models/setting.php");
require_once(dirname(__FILE__) . "/sidenav_component.php");


class HeaderComponent {

    public function __construct(
        $user, $extra_css_classes="", $sidenav=FALSE
    ) {
        $this->user = $user;
        $this->game_name = Setting::get('GAME_NAME')->value;
        $this->extra_css_classes = $extra_css_classes;
        $this->sidenav = $sidenav;
    }

    public function render() {
        if ($this->user) {
            $money = money_formatter($this->user->money);
            $crystals = money_formatter($this->user->crystals, '');
        }
        
        if ($this->sidenav) {
            $this->sidenav_component = new SidenavComponent(
                $this->user,
                $this->game_name,
                $this->extra_css_classes
            );
        }

        if ($this->user) {
            $energy_percentage = (int) ($this->user->energy / $this->user->max_energy * 100);
            $will_percentage = (int) ($this->user->will / $this->user->max_will * 100);
            $experc = (int) ($this->user->exp / $this->user->get_exp_needed() * 100);
            $brave_percentage = (int) ($this->user->brave / $this->user->max_brave * 100);
            $hp_percentage = (int) ($this->user->hp / $this->user->max_hp * 100);
        }
        ?>
        <!DOCTYPE html>
        <html>
            <head>
                <meta charset='utf-8'>
                <meta http-equiv='X-UA-Compatible' content='IE=edge'>
                <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
                <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
                <link href="css/game-mobile.css" type="text/css" rel="stylesheet" />
                <link href="css/game.css" type="text/css" rel="stylesheet" />
                <link href="css/custom.css" type="text/css" rel="stylesheet" />
                <title><?= $this->game_name ?></title>
            </head>
        <body class="teal darken-4 teal-text text-lighten-4 <?= $this->extra_css_classes ?>">
            <header class="header">
                <nav>
                    <div class="nav-wrapper teal">
                        <a href="/index.php" class="brand-logo"><?= $this->game_name ?></a>
                        <?php if (isset($this->user)): ?>
                            <ul class="right hide-on-med-and-down">
                                <li><a href="/viewuser.php?u=<?= $this->user->userid ?>"><?= $this->user->username ?> (L<?= $this->user->level ?>)</a></li>
                                <li><a class="wallet-icon" href="/shops.php"><?= $money ?></a></li>
                                <li><a class="crystals-icon" href="/cmarket.php"></span><?= $crystals ?></a></li>
                                <li><a class="energy-icon" href="#"></span><?= $energy_percentage ?> %</a></li>
                                <li><a class="life-icon" href="#"></span><?= $hp_percentage ?> %</a></li>
                                <li><a class="brave-icon" href="#"></span><?= $this->user->brave ?></a></li>
                                <li><a class="house-icon" href="#"></span><?= $will_percentage ?> %</a></li>
                                <li><a href="/logout.php"><i class="material-icons">power_settings_new</i></a></li>
                            </ul>
                        <?php endif; ?>
                    </div>
                </nav>

                
            </header>
            <?php if($this->sidenav): ?>
                <?= $this->sidenav_component->render() ?>
            <?php endif; ?>
            <main class="container">
        <?php
    }
}