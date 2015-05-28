PREPARE pst_updateinstancercd ( text, text ) AS
UPDATE session.instance SET
    tslastaccessed = now()
    , timesaccessed = timesaccessed + 1
WHERE sessionid = ($1)
    AND instanceid = ($2)

