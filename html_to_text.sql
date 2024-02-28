UPDATE commerces
SET info = regexp_replace(info, '<[^>]+>', '')
WHERE info IS NOT NULL;

/*Verificacion*/