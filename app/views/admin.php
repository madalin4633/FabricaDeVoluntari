<!DOCTYPE html>
<html lang="ro">
<head>
	<title>Admin</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/public/styles/admin.css"/>
    <link rel="stylesheet" type="text/css" href="/public/styles/userActivity.css" />
    <link rel="stylesheet" type="text/css" href="/public/styles/collapsible.css" />
</head>


<body>
    
    <div class="wrapper">
        <div id="bar1" class="sidebar">
            <h2>Fabrica de Voluntari</h2>
            <ul>
                <li><a href="#" onclick="openCity(event, 'news_tab')">News</a></li>
                <li><a href="#" onclick="openCity(event, 'volunteer_tab')">Voluntari</a></li>
                <li><a href="#" onclick="openCity(event, 'association_tab')">Asociatii</a></li>
                <li><a href="#" onclick="openCity(event, 'logout')">Logout</a></li>
            </ul> 
            
        </div>

        <div class="main_content">
            <div id="news_tab" class="tab">
            </div>

            <div id="volunteer_tab" class="tab">
                <button type='button' class='btn' id='add-project' onclick="showAddTaskForm(0)">Add</button>
                <form class='project-form' id='add-task-0' method="POST" action="">
                    <input type="text" name="title" placeholder='Project Title'>
                    <textarea name="descr" placeholder='Description'></textarea>
                    <button name="add" type="submit" value="addProject">Add Project</button>
                </form>
                <br/>
                <br/>
                <br/>
            
                <button type='button' class='btn' id='add-project' onclick="showAddTaskForm(0)">Delete</button>
                <form class='project-form' id='add-task-0' method="POST" action="">
                    <input type="text" name="title" placeholder='Project Title'>
                    <textarea name="descr" placeholder='Description'></textarea>
                    <button name="add" type="submit" value="addProject">Add Project</button>
                </form>
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