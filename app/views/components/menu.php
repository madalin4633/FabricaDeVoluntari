<section class="top-menu">
    <img class="company-logo" alt="company logo" src=<?= $GLOBALS['URL_HOST'] . "/public/images/fabrica_logo.png"; ?>>
    <button type="button" class="menu-button" onclick="location.href='<?php echo $GLOBALS['URL_HOST'] . '/volunteer/dashboard'; ?>'">Dashboard </button>
    <button type="button" class="menu-button" onclick="location.href='<?php echo $GLOBALS['URL_HOST'] . '/volunteer/profile'; ?>'">Profile </button>

    <button class="messages-button">
        <img alt="mail icon" class="svg-white" src=<?= $GLOBALS['URL_HOST'] . "/public/images/mail_outline-24px.svg" ?>>
    </button>

    <div class="crop" >
        <img alt="profile pic" src=<?= $GLOBALS['URL_HOST'] . "/public/images/". $volunteer -> pic; ?>>
    </div>
</section>
<section class="user-notifications">
    <?= $GLOBALS['user-notifications']->showNotifications(); ?>
</section>



