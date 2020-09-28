//if timestamp given in table
SELECT
    a.*, b.*
FROM
    users a
LEFT JOIN
    (SELECT c.user_id, d.name, c.latitude,c.longitude
     FROM
         (SELECT
            id,
            MAX(time) time
         FROM
             user_location
         GROUP BY id
         ) c
     JOIN
         user_location d
         ON c.id = d.id AND d.time = c.time
     ) b
     ON a.id = b.id