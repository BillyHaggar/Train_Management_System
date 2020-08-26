/*
 * A function that checks if a string includes
 * two digits for 24 hours, a colon, and then two digits for minutes
 * Valid string in this case:
 *  - 12:58
 */
CREATE OR REPLACE FUNCTION validate_hhmm(str IN VARCHAR) RETURN boolean 
AS
BEGIN
	RETURN REGEXP_LIKE(str, '^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$');
END;