SELECT task_id, vol_id, sum(hours_worked) as hours, profile_pic
FROM tblTasks 
LEFT JOIN tblActivity ON tblTasks.id=tblActivity.task_id
INNER JOIN tblVolAssoc ON tblVolAssoc.id=tblActivity.volassoc_id
INNER JOIN tblVolunteers ON tblVolAssoc.vol_id = tblVolunteers.id
GROUP BY vol_id, task_id, profile_pic
ORDER BY task_id