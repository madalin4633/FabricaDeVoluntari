-- https://www.enterprisedb.com/postgres-tutorials/everything-you-need-know-about-postgresql-triggers
-- https://www.the-art-of-web.com/sql/trigger-update-timestamp/

DROP TRIGGER IF EXISTS trigTasksU ON tblTasks CASCADE;
DROP FUNCTION IF EXISTS trTasksUp;

DROP TRIGGER IF EXISTS trigTasksI ON tblTasks CASCADE;
DROP FUNCTION IF EXISTS trTasksIn;

CREATE FUNCTION trTasksUp() RETURNS trigger 
LANGUAGE plpgsql
AS
$$
BEGIN
	NEW.updated_on := current_timestamp;
	
	RETURN NEW;
END;
$$;

CREATE TRIGGER trigTasksU BEFORE UPDATE
ON tblTasks
FOR EACH ROW
EXECUTE PROCEDURE trTasksUp();

CREATE FUNCTION trTasksIn() RETURNS trigger 
LANGUAGE plpgsql
AS
$$
BEGIN
	NEW.created_on := current_timestamp;
	NEW.updated_on := current_timestamp;
	
	RETURN NEW;
END;
$$;

CREATE TRIGGER trigTasksI BEFORE INSERT
ON tblTasks
FOR EACH ROW
EXECUTE PROCEDURE trTasksIn();