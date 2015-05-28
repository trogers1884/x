PREPARE pst_instanceexists( text, text ) AS 
SELECT 
    COUNT(*) AS instance_exists
FROM session.instance 
WHERE sessionid = ($1) 
    AND instanceid = ($2);
-- EXECUTE pst_instanceexists ( 'ta4jqtlllol5hu6ebapq70l3u1','xx');

