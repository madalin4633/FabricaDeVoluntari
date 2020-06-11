-- https://www.enterprisedb.com/postgres-tutorials/everything-you-need-know-about-postgresql-triggers
-- https://www.the-art-of-web.com/sql/trigger-update-timestamp/

DROP TRIGGER IF EXISTS trigProjectsU ON tblProjects CASCADE;
DROP FUNCTION IF EXISTS trProjectsUp;

DROP TRIGGER IF EXISTS trigProjectsI ON tblProjects CASCADE;
DROP FUNCTION IF EXISTS trProjectsIn;

CREATE FUNCTION trProjectsUp() RETURNS trigger 
LANGUAGE plpgsql
AS
$$
BEGIN
	NEW.updated_on := current_timestamp;
	
	RETURN NEW;
END;
$$;

CREATE TRIGGER trigProjectsU BEFORE UPDATE
ON tblProjects
FOR EACH ROW
EXECUTE PROCEDURE trProjectsUp();

CREATE FUNCTION trProjectsIn() RETURNS trigger 
LANGUAGE plpgsql
AS
$$
BEGIN
	NEW.created_on := current_timestamp;
	NEW.updated_on := current_timestamp;
	
	RETURN NEW;
END;
$$;

CREATE TRIGGER trigProjectsI BEFORE INSERT
ON tblProjects
FOR EACH ROW
EXECUTE PROCEDURE trProjectsIn();