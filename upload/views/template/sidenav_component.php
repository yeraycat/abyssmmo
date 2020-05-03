<?php

class SidenavComponent {

    public function __construct($user, $game_name, $extra_css_classes="") {
        $this->user = $user;
        $this->extra_css_classes = $extra_css_classes;
        $this->game_name = $game_name;
    }
    
    public function render() {
        $money = money_formatter($this->user->money);
        $crystals = money_formatter($this->user->crystals, '');
        $energy_percentage = (int) ($this->user->energy / $this->user->max_energy * 100);
        $hp_percentage = (int) ($this->user->hp / $this->user->max_hp * 100);
        $will_percentage = (int) ($this->user->will / $this->user->max_will * 100);
        $brave = $this->user->brave;

        ?>
        <div id="slide-out" class="sidenav sidenav-fixed teal">
            <div class="sidenav-logo hide-on-med-and-down"></div>
            <div class="sidenav-title hide-on-med-and-down"><?= $this->game_name ?></div>
            <div class="sidenav-stats hide-on-large-only">
                <div class="row">
                    <div class="col s12 sidenav-stats__username">
                        <a href="/viewuser.php?u=<?= $this->user->userid ?>"><?= $this->user->username ?> (L<?= $this->user->level ?>)</a>
                    </div> 
                </div>
                <div class="row">
                    <div class="col s6 sidenav-stats__money">
                        <a class="wallet-icon" href="/shops.php"><?= $money ?></a>
                    </div>
                    <div class="col s6 sidenav-stats__crystals">
                        <a class="crystals-icon" href="/cmarket.php"></span><?= $crystals ?></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col s6 sidenav-stats__energy">
                        <a class="energy-icon" href="/shops.php"><?= $energy_percentage ?> %</a>
                    </div>
                    <div class="col s6 sidenav-stats__life">
                        <a class="life-icon" href="/cmarket.php"></span><?= $hp_percentage ?> %</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col s6 sidenav-stats__brave">
                        <a class="brave-icon" href="/shops.php"><?= $brave ?> %</a>
                    </div>
                    <div class="col s6 sidenav-stats__will">
                        <a class="house-icon" href="/cmarket.php"></span><?= $will_percentage ?> %</a>
                    </div>
                </div>
            </div>
            <ul>
                <li><a href="/index.php">Home</a></li>
                <li><a href="/inventory.php">Items</a></li>
                <?php if(!$this->user->is_in_hospital()): ?>
                    <li><a href="/explore.php">Explore</a></li>
                    <li><a href="/gym.php">Gym</a></li>
                    <li><a href="/criminal.php">Crimes</a></li>
                    <li><a href="/education.php">Local school</a></li>
                <?php endif; ?>
                <?php if($this->user->is_admin()): ?>
                    <li><a href="/new_staff.php">Admin panel</a></li>
                <?php endif; ?>
                <?php if($this->user->is_donator()): ?>
                    <li><a href="/friendslist.php">Friends list</a></li>
                    <li><a href="/blacklist.php">Black list</a></li>
                <?php endif; ?>
                <li><a href="/preferences.php">Preferences</a></li>
                <li><a href="/viewuser.php?u=<?= $this->user->userid ?>">My profile</a></li>
            </ul>  
        </div>
        <a href="#" data-target="slide-out" class="sidenav-trigger teal-text text-lighten-3"><i class="material-icons">menu</i></a>
                
        <?php
    }
}