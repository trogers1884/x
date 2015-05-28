PREPARE pst_updatesessionrcd (text) AS 
UPDATE session.session SET
    tslastaccessed = now()
WHERE sessionid = ($1); 

