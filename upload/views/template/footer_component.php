<?php

class FooterComponent {

    public function __construct($game_owner, $user=null) {
        $this->game_owner = $game_owner;
        $this->user = $user;
    }

    public function render() {
        ?>
        </main>
        <footer class="page-footer teal">
            <?php if($this->user): ?>
                <div class="container">
                    <div class="row">
                        <div class="col l6 s12">
                            <h5 class="white-text">Users</h5>
                            <ul>
                                <li><a class="grey-text text-lighten-3" href="/search.php">Search users</a></li>
                                <li><a class="grey-text text-lighten-3" href="/advsearch.php">Advanced search</a></li>
                                <li><a class="grey-text text-lighten-3" href="/preport.php">Report player</a></li>
                            </ul>
                        </div>
                        <div class="col l4 offset-l2 s12">
                            <h5 class="white-text">Help links</h5>
                            <ul>
                                <li><a class="grey-text text-lighten-3" href="/helptutorial.php">Help tutorial</a></li>
                                <li><a class="grey-text text-lighten-3" href="/gamerules.php">Game rules</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="footer-copyright">
                <div class="container">
                    © 2020 Copyright <?= $this->game_owner ?>
                    <span class="grey-text text-lighten-4 right">Powered by AbyssMMO made by Yeraycat, forked from code made by Dabomstew</span>
                </div>
            </div>
        </footer>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <script type="text/javascript" src="/js/sidenav.js"></script>
        <?php
    }
}
