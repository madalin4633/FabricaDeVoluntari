<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="Description" content="Association's dashboard showing the volunteers enrolled">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/public/styles/commons.css" />
    <link rel="stylesheet" type="text/css" href="/public/styles/tooltip.css" />
    <link rel="stylesheet" type="text/css" href="/public/styles/userprofile.css" />
    <link rel="stylesheet" type="text/css" href="/public/styles/useractivity.css" />
    <link rel="stylesheet" type="text/css" href="/public/styles/collapsible.css" />
    <link rel="stylesheet" type="text/css" href="/public/styles/menu.css" />
    <link rel="icon" href="/public/images/fdv_logo.png" />
    <title>Fabrica de Voluntari</title>
    <script src="/public/javascript/collapsible.js" ></script>
    <script src="/public/javascript/menu.js" ></script>
</head>

<body>
    <div class="vertical-split">

        <?php require_once __DIR__ . "/components/menu.php"?>
           
        <form id='drive-form' method='POST'>
        <input id='drive-url-input'></input>
        <button id='drive-btn'>Edit Google Drive URL</button>
</form>

        <div class='myVolunteers'>
        <?php
        foreach ($association -> volunteers as $volunteer) {
            echo "<div class='volunteerDetails'>";
            if ($volunteer['profile_pic'] != null && file_exists(__DIR__ . "/../../public/images/profile-pics/" . $volunteer['profile_pic'])) {
                echo "<div class='assoc-icon'
            style='background: url(/public/images/profile-pics/" . $volunteer['profile_pic'] . "); 
            background-size: cover; background-position: center; background-repeat: no-repeat;'
            >
        ";
            } else {
                echo "<div class='assoc-icon'
            style='background-color: burlywood; background-size: cover; background-position: center; background-repeat: no-repeat;'
            >";  
            if($volunteer['initials']) 
            echo $volunteer['initials']; 
            else  
            echo "?" ;
            }
            
            echo "</div>
            <div class='progress-asociatie'>
            <div class='nume-voluntar'>". $volunteer['nume'] . "</div>
            <div class='vol-hours'>Hours: ". $volunteer['hours'] . "</div>";
            echo "<button type='button' class='gdrive" . (($volunteer['drive_url'] == null) ? " disabled'" : "'") . " onclick='showDriveForm(this, " . $volunteer['volassoc_id'] . ")'>Certifications</button>
            </div></div>";
        }

?>
    </div>

    <script src="/public/javascript/useractivity.js"></script>
    <script>
        initCollapsible();
        initMenu();
    </script>
</body>

</html>