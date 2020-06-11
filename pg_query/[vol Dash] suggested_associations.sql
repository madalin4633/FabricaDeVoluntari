SELECT DISTINCT id, nume, logo 
            FROM tblAssociations 
            where id not in 
            (select distinct assoc_id from vvolunteerdashboard where vol_id = 11)