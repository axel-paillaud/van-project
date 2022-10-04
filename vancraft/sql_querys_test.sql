SELECT post_id, title, content, images, views, votes, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss')
 AS frenchCreationDate, DATE_FORMAT(last_modification, '%d/%m/%Y à %Hh%imin%ss') AS frenchLastModification FROM posts ORDER BY votes DESC LIMIT 0, 15\G