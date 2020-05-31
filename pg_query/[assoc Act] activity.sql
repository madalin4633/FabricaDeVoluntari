select tblTasks.id as task_id, tblVolAssoc.assoc_id, tblAssociations.logo, title, descr, obs, sum(hours_worked) as hours_worked, sum(bonus) as bonus, DATE(due_date)
from tbltasks 
INNER JOIN tblActivity ON tblTasks.id=tblActivity.task_id
INNER JOIN tblVolAssoc ON tblVolAssoc.id=tblActivity.volassoc_id AND tblVolAssoc.assoc_id=tblTasks.assoc_id
INNER JOIN tblAssociations ON tblTasks.assoc_id=tblAssociations.id
WHERE tblTasks.active=true and done=false
GROUP BY tblTasks.id, tblVolAssoc.assoc_id, title, descr, obs, due_date, tblAssociations.logo

