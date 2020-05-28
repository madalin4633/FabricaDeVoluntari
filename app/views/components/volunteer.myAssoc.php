<?php 
// volunteer/dashboard Asociatiile Mele

    foreach($volunteer -> associations as $assoc) {
        echo  
        "<tr>
            <td  style='background: url(/public/images/logo/no-logo-png-4.png); background-size: cover; background-position: center; background-repeat: no-repeat;'>
                <div class='tooltip'><span class='tooltiptext'>" . $assoc['nume'] . "</span>
                <div class='asoc-logo' style='background: url(/public/images/logo/" . $assoc['logo'] . "); 
                background-size: cover; background-position: center; background-repeat: no-repeat;'
                onclick='location.href=\"/volunteer/activity/".$assoc['assoc_id']."\"'>
                </div></div>
            </td>
            <td>
                <div class='progress-asociatie'>
                    <div class='tooltip'><span class='tooltiptext'>Ore lucrate</span><img class='svg-white' alt='icon' src='/public/images/query_builder-24px.svg'>
                        <span class='ore-lucrate'>" . $assoc['hours_worked'] . "</span></div>
                    <div class='tooltip'><span class='tooltiptext'>Aprecieri</span><img class='svg-red' alt='icon' src='/public/images/favorite-24px.svg'>
                        <span class='aprecieri'>" . $assoc['bonus'] . "</span></div>";
                        showFeedbackStars($assoc['rating']);
                echo "</div>
            </td>
        </tr>";
    }
?>
