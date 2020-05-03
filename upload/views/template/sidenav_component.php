<?php

class SidenavComponent {

    public function __construct($user, $game_name, $extra_css_classes="") {
        $this->user = $user;
        $this->extra_css_classes = $extra_css_classes;
        $this->game_name = $game_name;
    }
    
    public function render() {
        ?>
        <div id="slide-out" class="sidenav sidenav-fixed teal">
            <div class="sidenav-logo"></div>
            <div class="sidenav-title"><?= $this->game_name ?></div>
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