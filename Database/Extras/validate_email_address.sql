/*
 * A function that checks if an email address is valid.
 * Valid email addresses in this case:
 *  - Must have ataleast one character followed by an '@' symbol
 *  - Must have at least one character after the '@' symbol
 *  - Followed by at least one '.' and then another character.
 */
CREATE OR REPLACE FUNCTION validate_email_address(email_address IN VARCHAR) RETURN boolean 
AS
BEGIN
	RETURN REGEXP_LIKE(email_address, '^.+@.+\.+.+$');
END;