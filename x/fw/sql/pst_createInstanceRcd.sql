PREPARE pst_createinstancercd ( text, text ) AS
INSERT INTO session.instance (
    sessionid 
    , instanceid
) VALUES (
    ($1), ($2)
)
