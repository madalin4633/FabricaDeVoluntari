        SELECT task_id, vol_id, LEFT(tblVolunteers.nume,1) || LEFT(tblVolunteers.prenume,1) as initials, tblTasks.assoc_id, sum(hours_worked) as hours, profile_pic
        FROM tblTasks 
        LEFT JOIN tblActivity ON tblTasks.id=tblActivity.task_id
        INNER JOIN tblVolAssoc ON tblVolAssoc.id=tblActivity.volassoc_id AND tblVolAssoc.assoc_id=tblTasks.assoc_id
        INNER JOIN tblVolunteers ON tblVolAssoc.vol_id = tblVolunteers.id 
		WHERE task_id=7
        GROUP BY vol_id, task_id, profile_pic, tblTasks.assoc_id, tblVolunteers.nume, tblVolunteers.prenume
        ORDER BY task_id ASC

