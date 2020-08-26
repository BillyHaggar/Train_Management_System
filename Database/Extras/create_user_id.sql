/* 
 * Create a sequence to generate unique user ID
 * starting from 1,000 and ending with 99,999.
 */
CREATE SEQUENCE user_ID_seq
START WITH 1000
INCREMENT BY 1
MAXVALUE 99999
CYCLE
NOCACHE;
