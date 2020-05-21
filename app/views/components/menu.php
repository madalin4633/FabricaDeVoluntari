<div class="top-menu">
    <img class="company-logo" alt="company logo" src="/public/images/fabrica_logo.png" >
    <button type="button" class="menu-button" onclick="location.href='/volunteer/dashboard'">Dashboard </button>
    <button type="button" class="menu-button" onclick="location.href='/volunteer/profile'">Profile </button>
    <button type="button" class="menu-button" onclick="location.href='/association/reports'">Reports </button>

    <button class="messages-button">
        <img alt="mail icon" class="svg-white" src="/public/images/mail_outline-24px.svg" >
    </button>

    <div class="crop" >
        <img alt="profile pic" src="/public/images/<?= $volunteer -> pic ?>" >
    </div>
</div>
<div class="user-notifications">
    <?= $GLOBALS['user-notifications']->showNotifications(); ?>
</div>



