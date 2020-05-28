select tblTasks.id as task_id, vol_id, tblTasks.assoc_id, title, descr, obs, sum(hours_worked) as hours_worked, sum(bonus) as bonus, due_date
from tbltasks LEFT JOIN tblActivity ON tblTasks.id=tblActivity.task_id
LEFT JOIN tblVolAssoc ON tblVolAssoc.id=tblActivity.volassoc_id
WHERE tblTasks.active=true and done=false
GROUP BY tblTasks.id, vol_id, tblTasks.assoc_id, title, descr, obs, due_date

