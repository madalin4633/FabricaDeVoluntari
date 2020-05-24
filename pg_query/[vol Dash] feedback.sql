SELECT vol_id, tblVolAssoc.assoc_id, nume, logo
                , (AVG(harnic) 
                + AVG(comunicativ)
                + AVG(disponibil) 
                + AVG(punctual)
                + AVG(serios))/5 AS rating 
                FROM tblAssociations INNER JOIN tblVolAssoc ON tblAssociations.id = tblVolAssoc.assoc_id
                LEFT JOIN tblTasks ON tblTasks.assoc_id=tblVolAssoc.assoc_id
                LEFT JOIN tblFeedback ON tblFeedback.task_id=tblTasks.id AND tblFeedback.volassoc_id = tblVolAssoc.id
                WHERE tblVolAssoc.active=true
                GROUP BY vol_id, tblVolAssoc.assoc_id, nume, logo
				ORDER BY vol_id