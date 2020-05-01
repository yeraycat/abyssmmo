<?php

class FooterComponent {

    public function __construct($game_owner) {
        $this->game_owner = $game_owner;
    }

    public function render() {
        ?>
        </main>
        <footer class="page-footer teal">
            <div class="footer-copyright">
                <div class="container">
                    © 2020 Copyright <?= $this->game_owner ?>
                    <span class="grey-text text-lighten-4 right">Powered by AbyssMMO made by Yeraycat, forked from code made by Dabomstew</span>
                </div>
            </div>
        </footer>
        <?php
    }
}
