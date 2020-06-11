SELECT tblVolAssoc.vol_id, tblVolAssoc.assoc_id, nume
                , SUM(bonus) as bonus,
                SUM(hours_worked) AS hours_worked  
                FROM tblAssociations INNER JOIN tblVolAssoc ON tblAssociations.id = tblVolAssoc.assoc_id
                LEFT JOIN tblTasks ON tblTasks.assoc_id=tblVolAssoc.assoc_id
                LEFT JOIN tblActivity ON tblActivity.task_id=tblTasks.id AND tblActivity.volassoc_id = tblVolAssoc.id
                WHERE tblVolAssoc.active=true
                GROUP BY tblVolAssoc.vol_id, tblVolAssoc.assoc_id, nume
				ORDER BY tblVolAssoc.id
