<section class="top-menu">
    <button type="button" class="menu-button" onclick="location.href='<?php echo $GLOBALS['URL_HOST'] . '/volunteer/dashboard'; ?>'">Dashboard </button>
    <button type="button" class="menu-button" onclick="location.href='<?php echo $GLOBALS['URL_HOST'] . '/volunteer/profile'; ?>'">Profile </button>

    <div class="crop" >
        <img alt="profile pic" src=<?= $GLOBALS['URL_HOST'] . "/public/images/". $volunteer -> pic; ?>>
    </div>
</section>



