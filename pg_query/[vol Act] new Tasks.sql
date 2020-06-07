            select tblTasks.id as task_id, max_volunteers, tblTasks.assoc_id, title, obs, logo as assoclogo,due_date
            from tblTasks 
            LEFT JOIN  tblAssociations ON tblTasks.assoc_id=tblAssociations.id 
            WHERE tblTasks.active=true and done=false

