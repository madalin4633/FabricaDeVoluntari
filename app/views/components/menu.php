<nav class="menu">
    <img class="company-logo" alt="company logo" src="/public/images/fabrica_logo.png" >
    <button id="menu-icon">
        <img alt="menu icon" class="svg-white" src="/public/images/menu-24px.svg" >
    </button>
    <div class="vertical-menu">
        <button type="button" class="menu-button" onclick="location.href='/volunteer/dashboard'">Dashboard </button>
        <button type="button" class="menu-button" onclick="location.href='/volunteer/profile'">Profile </button>
        <button type="button" class="menu-button" onclick="location.href='/volunteer/activity'">Activity (vol) </button>
        <button type="button" class="menu-button" onclick="location.href='/association/reports'">Reports </button>
        <button type="button" id="logout-btn" class="menu-button" >Logout </button>
    </div>

    <button type="button" class="messages-button">
        <img alt="mail icon" class="svg-white" src="/public/images/mail_outline-24px.svg" >
    </button>

    <div class="crop" >
        <img alt="profile pic" src="/public/images/<?= $volunteer -> pic ?>" >
    </div>
</nav>
<div class="user-notifications">
    <?= $GLOBALS['user-notifications']->showNotifications(); ?>
</div>



