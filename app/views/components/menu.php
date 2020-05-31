<nav class="menu">
    <img class="company-logo" alt="company logo" src="/public/images/fabrica_logo.png" >
    <button id="menu-icon">
        <img alt="menu icon" class="svg-white" src="/public/images/menu-24px.svg" >
    </button>
    <div class="vertical-menu">
        <!-- volunteer menu -->
        <?= $GLOBALS['vol_logged_in']?"<button type='button' class='menu-button' onclick='location.href=\"/volunteer/dashboard\"'>Dashboard </button>":'' ?>
        <?= $GLOBALS['vol_logged_in']?"<button type='button' class='menu-button' onclick='location.href=\"/volunteer/profile\"'>Profile </button>":'' ?>
        <?= $GLOBALS['vol_logged_in']?"<button type='button' class='menu-button' onclick='location.href=\"/volunteer/activity\"'>Activity</button>":'' ?>

        <!-- association menu -->
        <?= $GLOBALS['vol_logged_in']?'':"<button type='button' class='menu-button' onclick='location.href=\"/association/activity\"'>Activity</button>" ?>
        <?= $GLOBALS['vol_logged_in']?'':"<button type='button' class='menu-button' onclick='location.href=\"/association/reports\"'>Reports </button>" ?>

        <!-- common menu -->
        <button type="button" id="logout-btn" class="menu-button" >Logout </button>
    </div>

    <button type="button" class="messages-button">
        <img alt="mail icon" class="svg-white" src="/public/images/mail_outline-24px.svg" >
    </button>

    <div class='assoc-icon'
        style='background: url("/public/images/<?= $GLOBALS['vol_logged_in']?$volunteer -> pic:$association->pic ?>"); background-size: cover; background-position: center; background-repeat: no-repeat;'>
    </div>
</nav>
<div class="user-notifications">
    <?= $GLOBALS['user-notifications']->showNotifications(); ?>
</div>



