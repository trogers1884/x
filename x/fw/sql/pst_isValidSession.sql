PREPARE pst_isvalidsession ( text ) AS 
SELECT 
    COUNT(sessionid) AS knt
FROM session.session 
WHERE sessionid = ($1);

-- EXECUTE pst_isvalidsession ('ta4jqtlllol5hu6ebapq70l3u1');


