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
                <li><a href="#" onclick="openCity(event, 'news_tab')">News</a></li>
                <li><a href="#" onclick="openCity(event, 'volunteer_tab')">Postman</a></li>
                <li><a href="#" onclick="openCity(event, 'association_tab')">Statistici</a></li>
                <li><a href="/user/logout" onclick="openCity(event, 'logout')">Logout</a></li>
            </ul> 
            
        </div>

        <div class="main_content">
            <div id="news_tab" class="tab">
                <p>Test1</p>
            </div>

            <div id="volunteer_tab" class="tab">
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
                            <textarea type="text" class="form__input" id="input_payload" placeholder="Result"></textarea>
                        </div>

                        
                        
                    
                    
                    </div>

                </div>
            </div>

            <div id="association_tab" class="tab">
                <h3>Tokyo</h3>
                <p>Tokyo is the capital of Japan.</p>
            </div>
        </div>
    </div>
    
    <script src="/public/javascript/admin.js"></script>
</body>


</html>