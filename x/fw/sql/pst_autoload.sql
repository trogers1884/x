PREPARE pst_autoload (text) AS 
SELECT DISTINCT 
    classcontainerid  AS classcontainer 
FROM public.class 
WHERE classid = ($1);

-- EXECUTE pst_autoload ( 'PageTest.php');

