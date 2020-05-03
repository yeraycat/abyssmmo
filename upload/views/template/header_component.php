<?php

if (strpos($_SERVER['PHP_SELF'], "header_component.php") !== false)
{
    exit;
}

require_once(dirname(__FILE__) . "/../../models/setting.php");
require_once(dirname(__FILE__) . "/sidenav_component.php");


class HeaderComponent {

    public function __construct(
        $user, $extra_css_classes="", $sidenav=False
    ) {
        $this->user = $user;
        $this->game_name = Setting::get('GAME_NAME')->value;
        $this->extra_css_classes = $extra_css_classes;
        $this->sidenav = $sidenav;
    }

    public function render() {
        $money = money_formatter($this->user->money);
        $crystals = money_formatter($this->user->crystals, '');
        if ($this->sidenav) {
            $this->sidenav_component = new SidenavComponent(
                $this->user,
                $this->game_name,
                $this->extra_css_classes
            );
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
                    <ul class="right hide-on-med-and-down">
                        <?php if (isset($this->user)): ?>
                            <li><a href="/viewuser.php?u=<?= $this->user->userid ?>"><?= $this->user->username ?> (L<?= $this->user->level ?>)</a></li>
                            <li><a href="/shops.php"><?= $money ?></a></li>
                            <li><a href="/cmarket.php"><i class="material-icons left">star_border</i><?= $crystals ?></a></li>
                            <li><a href="/logout.php"><i class="material-icons">power_settings_new</i></a></li>
                        <?php endif; ?>
                    </ul>
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