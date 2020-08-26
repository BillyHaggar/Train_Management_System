
/* 
 * Generate the users unique record number on insert.
 * The user id contains the users initials
 * of their first and second name, followed by a number.
 * There may be duplicates when there is more than
 * 8,999 students in the system. Use a while loop to make sure
 * that the record number is 100% unique.
 */
CREATE OR REPLACE TRIGGER user_id_trigger
BEFORE INSERT ON USER_ACCOUNT FOR EACH ROW
DECLARE 
    uniqueRows int := 1;
    uniqueID VARCHAR(255) := '';
BEGIN
    WHILE (uniqueRows > 0) LOOP
        uniqueID := SUBSTR(:NEW.first_name, 1, 1) || SUBSTR(:NEW.last_name, 1, 1) || '-' || user_id_seq.NEXTVAL;
        SELECT COUNT(*) INTO uniqueRows FROM students where user_id = uniqueID;
        IF uniqueRows = 0 THEN
            :NEW.user_id := uniqueID;
        END IF;
    END LOOP;
END;

/* 
 * Call the generate_password function 
 * to generate a random password for the student on insert.
 */
CREATE OR REPLACE TRIGGER generate_password_trigger
BEFORE INSERT ON USER_ACCOUNTS FOR EACH ROW
BEGIN
	:NEW.password := generate_password();
END;

/* 
 * Call the validate_email_address function 
 * for the users email address when
 * inserting or updating it. Throw an error
 * if the email address is invalid.
 */
CREATE OR REPLACE TRIGGER user_email_trigger
BEFORE INSERT OR UPDATE of email ON user_accounts FOR EACH ROW
BEGIN
    IF validate_email_address(:NEW.email) = FALSE THEN
        raise_application_error(-20101, 'ERROR: "' || :NEW.email || '" is an invalid email address.'); 
    END IF;
END;
