/**
 * Generate a random password for 12 characters long.
 */
CREATE OR REPLACE FUNCTION generate_password RETURN VARCHAR
AS
BEGIN
	RETURN DBMS_RANDOM.STRING('X', 12);
END;