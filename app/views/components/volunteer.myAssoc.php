<?php 
// volunteer/dashboard Asociatiile Mele

    foreach($volunteer -> associations as $assoc) {
        echo  
        "<tr>
            <td  style='background: url(/public/images/logo/no-logo-png-4.png); background-size: cover; background-position: center; background-repeat: no-repeat;'>
                <div class='tooltip'><span class='tooltiptext'>" . $assoc['nume'] . "</span>
                <div class='asoc-logo' style='background: url(/public/images/logo/" . $assoc['logo'] . "); background-size: cover; background-position: center; background-repeat: no-repeat;'>
                </div>
            </td>
            <td>
                <div class='progress-asociatie'>
                    <div class='tooltip'><span class='tooltiptext'>Ore lucrate</span><img class='svg-white' alt='icon' src='/public/images/query_builder-24px.svg'>
                        <span class='ore-lucrate'>" . $assoc['hours_worked'] . "</span></div>
                    <div class='tooltip'><span class='tooltiptext'>Aprecieri</span><img class='svg-red' alt='icon' src='/public/images/favorite-24px.svg'>
                        <span class='aprecieri'>" . $assoc['bonus'] . "</span></div>
                    <div class='nowrap ";
                        if($assoc['rating']>0) 
                        echo "svg-yellow"; 
                    else 
                        echo "svg-grey";
                    echo " pack-tight'>
                        "; 
                        for ($i = 0; $i < 5; $i++) {
                            if (floor($assoc['rating']) > $i) 
                                echo "<img alt='icon' src='/public/images/star-24px.svg'>";
                            else if (ceil($assoc['rating']) > $i) 
                                echo "<img alt='icon' src='/public/images/star_half-24px.svg'>";
                            else
                                echo "<img alt='icon' src='/public/images/star_border-24px.svg'>"; 
                        }

                        echo "
                    </div>
                </div>
            </td>
        </tr>";
    }
?>
