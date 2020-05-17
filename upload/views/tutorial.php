<?php

require_once(dirname(__FILE__) . "/template/header_component.php");
require_once(dirname(__FILE__) . "/template/footer_component.php");
require_once(dirname(__FILE__) . "/template/sidenav_component.php");

$header_component = new HeaderComponent($user, "tutorial", TRUE);
$footer_component = new FooterComponent($GAME_OWNER, $user);

$header_component->render();
?>
<div class="row">
    <div class="col s12">
        <h2><?= $GAME_NAME ?> Tutorial</h2>
        <p>Welcome to the <?= $GAME_NAME ?> Tutorial, we hope that this guide will help you to better understand the game.<p>
        <br />
        <p>In <?= $GAME_NAME ?>, you are free to choose your own path. You can protect the weak, or
        exploit their weakness. Spend your money to help your friends, or horde it, they can take
        care of themselves.</p>
    </div>
</div>
<div class="row">
    <div class="col s12">
        <h3>Guide</h3>
        <a href="#general">General</a>
        <br />
        <a href="#explore">Explore</a>
        <br />
        <a href="#stat">Training</a>
        <br />
        <a href="#fight">Attacking</a>
        <br />
        <a href="#preferences">Preferences</a>
    </div>
</div>
<div class="row">
    <div class="col s12">
        <a name="general"><h3>General</h3></a>
        <h4>Personal Info and Status Bars</h4>
        <p>In the top right corner of the screen is your personal information. This shows your current
name, amount of cash, level, and number of crystals. To the right of your personal info is your
status bars. These show your current energy, will, brave, experience, and health.</p>
        <ol>
            <li>Energy is used for training and attacking.Refills 8% every 5 minutes, or 17% every 5 minutes for donators</li>
            <li>Will determines the effectiveness of your training</li>
            <li>Brave is used to do crimes, different crimes take more brave to do, these crimes are harder to succeed at so be careful not to try them to soon</li>
            <li>Experience shows how close you are to leveling up</li>
            <li>Health shows how much health you have remaining. You lose this if you're hit in a fight</li>
        </ol>
        <h4>Stats</h4>
        <p>There are 5 types of stats used on <?= $GAME_NAME ?>: Strength, Agility, Guard, Labor, and IQ.</p>
        <ol>
            <li>Strength determines how much damage you do in battle</li>
            <li>Agiligty is used to determine your hit rate in battle</li>
            <li>Guard reduces the amount of damage done to you when you are hit</li>
        </ol>
        <h4>Sidebar</h4>
        <p>The sidebar shows much of the things you are able to do in <?= $GAME_NAME ?>.</p>
        <ol>
            <li>The Home link will bring you to your homepage.</li>
            <li>Items will bring you to your item page.</li>
            <li>Explore brings up a list of places that you can go on <?= $GAME_NAME ?>.</li>
            <li>Events displays the number of new events, and when clicked tells you what they are.</li>
            <li>Mailbox will display any new messages you have received.</li>
            <li>Gym is where you go to train your fighting stats.</li>
            <li>Crimes will let you select which crime you want to do.</li>
            <li>Local School will let you take education classes.</li>
            <li>MonoPaper displays recent updates to the game.</li>
            <li>Forums will bring you to the official <?= $GAME_NAME ?> Forums.</li>
            <li>Search allows you to find other players by their name or their ID.</li>
            <li>Preferences will bring you the the Preferences page.</li>
            <li>Player Report is used to report players that have broken the rules of the game.</li>
            <li>My Profile shows you your profile.</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col s12">
        <a name="explore"><h3>Exploring</h3></a>
        <ol>
            <li>Shops: Here you can buy everything from med supplies, to weapons to make your enemy need meds.</li>
            <li>Item Market: You can go and see what people are selling here.</li>
            <li>Crystal Market: Come here to buy or sell crystals.</li>
            <li>Travel Agency: This will bring you to new towns with different equipment, keep in mind you can only fight someone in your town.</li>
            <li>Estate Agent:Go here to buy yourself a new house.</li>
            <li>City Bank: Here you can deposit your money. You must first open an account for 50K, and pay a fee for depositing.</li>
            <li>Federal Jail: Where all the suspected cheaters on the game go.</li>
            <li>Slot Machines: Go here to make your fortune, or lose your shirt.</li>
            <li>User List: Shows a list of all the players on the game.</li>
            <li><?= $GAME_NAME ?> Staff: A list of all the staff on <?= $GAME_NAME ?>.</li>
            <li>Hall of Fame: Shows the top players in various fields.</li>
            <li>Country Stats: A list of various statistics about the game.</li>
            <li>Users Online: Shows which players have acted last.</li>
            <li>Crystal temple: Trade your crystals for various things.</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col s12">
        <a name="stat"><h3>Training</h3></a>
        <h4>Gym</h4>
        <p>To use the gym, type in the number of times you want to train, select the stat to train and click ok. The next screen will tell
        you how much of that stat you gained, and what your total in that stat is.</p>
        <h4>Crimes</h4>
        <p>Go to the crime screen and select the crime you want to do. Remember that trying a crime that is to hard may land you in jail,
        and lose the experience you've worked so hard to get.</p>
        <h4>School</h4>
        <p>School offers courses that will raise your stats over a certain period of time</p>
        <h4>Attacking</h4>
        <p>Attacking will gain you experience when you win, but you lose experience if you lose. The amount of experience depends on the comparative
        strength of your enemy, if they are much weaker, you won't get much experience</p>
    </div>
</div>
<div class="row">
    <div class="col s12">
        <a name="fight"><h3>Attacking</h3></a>
        <p>
            Attacking is a good way to get experience, and exert your superiority over those weaker than 
            you. In order to attack you need 50% energy, and should have a weapon. 
            When you win a fight you will get a percentage of experience depending on how much 
            stronger you are compared to the person you are attacking. 
            Make sure that you really want to fight the person, because once you start you can't 
            stop until one of you loses. When you start a fight, you will have the option of using 
            any weapon that you currently have in your items page.
        </p>
    </div>
</div>
<div class="row">
    <div class="col s12">
        <a name="preferences"><h3>Preferences</h3></a>
        <h4>Sex Change</h4>
        <p>This will allow you to change from male to female and back for free, try finding that deal in the real world!</p>
        <h4>Password Change</h4>
        <p>The place to change your password, you should do this often to avoid having someone use your account if they crack your password</p>
        <h4>Name Change</h4>
        <p>Go here to change your name, remember that you're ID stays the same, so you can't use this to avoid consequences of your actions</p>
        <h4>Change Display Pic</h4>
        <p>Here you can change the display picture in your profile, it will automatically refit the picture to 150x150. Don't post anything offensive
        or you may be federal jailed.</p>
    </div>
</div>
<?php

$footer_component->render();