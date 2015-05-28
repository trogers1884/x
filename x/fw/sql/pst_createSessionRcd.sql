PREPARE pst_createsessionrcd (text) AS 
INSERT INTO session.session (
    sessionid 
) VALUES ( ($1) );

 
