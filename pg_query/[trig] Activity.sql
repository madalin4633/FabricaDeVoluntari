-- https://www.enterprisedb.com/postgres-tutorials/everything-you-need-know-about-postgresql-triggers
-- https://www.the-art-of-web.com/sql/trigger-update-timestamp/

DROP TRIGGER IF EXISTS trigActivityU ON tblActivity CASCADE;
DROP FUNCTION IF EXISTS trActivityUp;

DROP TRIGGER IF EXISTS trigActivityI ON tblActivity CASCADE;
DROP FUNCTION IF EXISTS trActivityIn;

CREATE FUNCTION trActivityUp() RETURNS trigger 
LANGUAGE plpgsql
AS
$$
BEGIN
	NEW.updated_on := current_timestamp;
	
	RETURN NEW;
END;
$$;

CREATE TRIGGER trigActivityU BEFORE UPDATE
ON tblActivity
FOR EACH ROW
EXECUTE PROCEDURE trActivityUp();

CREATE FUNCTION trActivityIn() RETURNS trigger 
LANGUAGE plpgsql
AS
$$
BEGIN
	NEW.created_on := current_timestamp;
	NEW.updated_on := current_timestamp;
	
	RETURN NEW;
END;
$$;

CREATE TRIGGER trigActivityI BEFORE INSERT
ON tblActivity
FOR EACH ROW
EXECUTE PROCEDURE trActivityIn();