<!DOCTYPE html>
<html lang="ro">
<head>
	<title>Admin</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/public/styles/admin.css"/>
</head>


<body>
    
    <div class="wrapper">
        <div id="bar1" class="sidebar">
            <h2>Fabrica de Voluntari</h2>
            <ul>
                <li><a href="#" onclick="change_tab(event, 'video_tab')">Video</a></li>
                <li><a href="#" onclick="change_tab(event, 'postman')">Postman</a></li>
                <li><a href="https://app.swaggerhub.com/apis/FabricaDeVoluntari/Fabrica-de-Voluntari/1.0.0">Swagger</a></li>
                <li><a href="/user/logout" onclick="change_tab(event, 'logout')">Logout</a></li>
            </ul> 
            
        </div>

        <div class="main_content">
            <div id="video_tab" class="tab">
                <div class = "container_rec">
                    <div class = "content">
                        <iframe width="1000" height="600"
                            src="https://www.youtube.com/embed/H5e6q84SbqY">
                        </iframe>
                    </div>
                </div>
                
            </div>

            <div id="postman" class="tab">
                <div class = "container_rec">

                    <div class="content">
                        <div class = "form__group">
                            <input type="text" class="form__input" id="input_route" placeholder="Route">
                        </div>
    
                        <div class = "form__group">
                            <textarea type="text" class="form__input" id="input_payload" placeholder="Payload"></textarea>
                        </div>

                        <div class="row">
                            <div class="form__group">
                                <SELECT class="form__input" name="status" id="method_selector">

                                    <OPTION Value="post">POST</OPTION>
                                    <OPTION Value="put">PUT</OPTION>
                                    <OPTION Value="get">GET</OPTION>
                                    <OPTION Value="delete">DELETE</OPTION>

                                </SELECT>
                            </div>

                            <input type="button" id="exec" class="btn" value="EXECUTE">
                        </div>
                    
                        <div class = "form__group">
                            <textarea type="text" class="form__input" id="output" placeholder="Result"></textarea>
                        </div>                   
                    
                    </div>

                </div>
            </div>
        </div>
    </div>
    
    <script src="/public/javascript/admin.js"></script>
</body>


</html>