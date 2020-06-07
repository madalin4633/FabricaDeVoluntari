<?php

    require_once __DIR__ . "/../models/associationModel.php";
    $association = new AssociationModel();

    $invite_link = $association->get_invite_link($_SESSION['id']);

    $data['enable_style']='';
    $data['disable_style']='';
    $data['invitation_link']='';
    $data['copy_btn_style']='';
    if($invite_link){
        $data['enable_style'] = ' disabled = "true" ';
        $data['invitation_link'] = ' value = '.$invite_link;
    }
    else{
        $data['disable_style'] = ' disabled = "true"';
        $data['invitation_link'] = ' value = "disabled"';
        $data['copy_btn_style'] = ' disabled = "true" ';
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="Description" content="Associations' overview of tasks">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/public/styles/commons.css" />
    <link rel="stylesheet" type="text/css" href="/public/styles/tooltip.css" />
    <link rel="stylesheet" type="text/css" href="/public/styles/menu.css" />
    <link rel="stylesheet" type="text/css" href="/public/styles/recruitments.css" />
    <link rel="icon" href="/public/images/fdv_logo.png" />
    <title>Fabrica de Voluntari</title>
</head>

<body>
    <div class="vertical-split">

        <?php require_once __DIR__ . "/components/menu.php"?>

        <div class = "container_rec">

            <div class="content">
                <h3>Recruitments</h3>
                <input type="button" id="enable" class="btn" value="Enable" <?php echo $data['enable_style']?>>
                <input type="button" id="disable" class="btn" value="Disable" <?php echo $data['disable_style']?>>
                <input type="button" id="copy" class="btn" value="Copy link" <?php echo $data['copy_btn_style']?>>

                <input type="text" id="link_label" id="invite_link" <?php echo $data['invitation_link']?>>
                
                
            </div>
            
        
        </div>
		

    </div>

    <script type='text/javascript'>
        var assoc_id = "<?php echo $_SESSION['id'] ?>";
    </script>
    <script src="/public/javascript/menu.js"></script>
    <script src="/public/javascript/recruitments.js"></script>
    <script>
        initMenu();
    </script>
</body>

</html>