<nav class="menu">
    <img class="company-logo" alt="company logo" src="/public/images/fabrica_logo.png" >
    <button id="menu-icon">
        <img alt="menu icon" class="svg-white" src="/public/images/menu-24px.svg" >
    </button>
    <div class="vertical-menu">
        <!-- volunteer menu -->
        <?= $_SESSION['is_volunteer']?"<button type='button' class='menu-button' onclick='location.href=\"/volunteer/dashboard\"'>Dashboard </button>":'' ?>
        <?= $_SESSION['is_volunteer']?"<button type='button' class='menu-button' onclick='location.href=\"/volunteer/profile\"'>Profile </button>":'' ?>
        <?= $_SESSION['is_volunteer']?"<button type='button' class='menu-button' onclick='location.href=\"/volunteer/activity\"'>Activity</button>":'' ?>

        <!-- association menu -->
        <?= $_SESSION['is_association']?"<button type='button' class='menu-button' onclick='location.href=\"/association/profile\"'>Profile </button>":'' ?>
        <?= $_SESSION['is_association']?"<button type='button' class='menu-button' onclick='location.href=\"/association/activity\"'>Activity</button>":'' ?>
        <?= $_SESSION['is_association']?"<button type='button' class='menu-button' onclick='location.href=\"/association/reports\"'>Reports </button>":'' ?>

        <!-- common menu -->
        <button type="button" id="logout-btn" class="menu-button" onclick="location.href='/user/logout'">Logout </button>
    </div>

    <button type="button" class="messages-button">
        <img alt="mail icon" class="svg-white" src="/public/images/mail_outline-24px.svg" >
    </button>

    <div class='assoc-icon'
        style='background: url("/public/images/<?= $_SESSION['is_volunteer']?'profile-pics/'.$volunteer -> pic: 'logo/'.$association->pic ?>"); background-size: cover; background-position: center; background-repeat: no-repeat;'>
    </div>
</nav>
<div class="user-notifications">
    <?= $GLOBALS['user-notifications']->showNotifications(); ?>
</div>



