PREPARE pst_classcontainer (text) AS 
SELECT DISTINCT 
    classcontainerid  AS classcontainer 
FROM public.class 
WHERE classid = ($1);

-- EXECUTE pst_classcontainer ( 'PageTest.php');

