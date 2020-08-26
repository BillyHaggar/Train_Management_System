/*-----------------------Clear tables and sequences in order to run script again and create a clean database------------------*/
DROP TABLE booking;
DROP TABLE vehicle;
DROP TABLE job;
DROP TABLE user_account;
DROP TABLE journey;
DROP TABLE route;
DROP TABLE station;
DROP TABLE route_num;
DROP TABLE transaction_log;

DROP SEQUENCE seq_booking_id;
DROP SEQUENCE seq_job_id;
DROP SEQUENCE seq_user_id;
DROP SEQUENCE seq_journey_id;
DROP SEQUENCE seq_route_id;
DROP SEQUENCE seq_station_id;
DROP SEQUENCE seq_transaction_id;
/

/*------------------------------Create the tables in a somewhat organised fashion---------------------------------------------*/
/*---------------------------------Create station table, trigger and sequence-------------------------------------------------*/
CREATE TABLE station(
    station_id                 INT                   CONSTRAINT station_id_pk PRIMARY KEY,
    station_type               VARCHAR2(30), 
    station_name               VARCHAR2(40)          CONSTRAINT station_name_nn NOT NULL
                                                     CONSTRAINT station_name_un UNIQUE,
    s_address_line_1           VARCHAR2(20)          CONSTRAINT s_address_line_1_nn NOT NULL
                                                     CONSTRAINT s_address_line_1_chk CHECK (REGEXP_LIKE(s_address_line_1, '^[a-zA-z-#.\, 0-9-]+$')),
    s_address_line_2           VARCHAR2(20)          CONSTRAINT s_address_line_2_chk CHECK (REGEXP_LIKE(s_address_line_2, '^[a-zA-z-#.\, 0-9-]+$')),
    s_postcode                 VARCHAR2(10)          CONSTRAINT s_postcode_nn NOT NULL
                                                     CONSTRAINT s_postcode_chk CHECK (REGEXP_LIKE(s_postcode, '^[A-Za-z 0-9]+$'))
);

CREATE SEQUENCE seq_station_id
    NOCACHE
        START WITH 1
        INCREMENT BY 1
        MAXVALUE 9999
    CYCLE;

CREATE OR REPLACE TRIGGER trg_station
    BEFORE INSERT ON station
        FOR EACH ROW
            BEGIN  
                IF INSERTING THEN
                    SELECT seq_station_id.nextval
                    INTO :NEW.station_id
                    FROM sys.dual;
                END IF;
            END;
/

CREATE OR REPLACE TRIGGER trg_station_alerts
    BEFORE INSERT OR UPDATE ON station
        FOR EACH ROW
            BEGIN
              IF (:NEW.station_name IS NULL) THEN
                    RAISE_APPLICATION_ERROR(-20010, 'please give the station a name - EG: Plymouth - Workshop ');
              END IF;
              IF (:NEW.s_address_line_1 IS NULL) THEN
                    RAISE_APPLICATION_ERROR(-20010, 'please give the station a line of address - EG: 102 Main Road ');
              END IF;
              IF (:NEW.s_postcode IS NULL) THEN
                    RAISE_APPLICATION_ERROR(-20010, 'please give the station a postcode - EG: AB12 7PK ');
              END IF;
              IF NOT REGEXP_LIKE(:NEW.s_address_line_1, '^[a-zA-z-#.\, 0-9-]+$') THEN
                  RAISE_APPLICATION_ERROR(-20011, 'Please enter a valid address line 2 - EG: 102 Main Road');
              END IF;
              IF NOT REGEXP_LIKE(:NEW.s_address_line_2, '^[a-zA-z-#.\, 0-9-]+$') THEN
                  RAISE_APPLICATION_ERROR(-20011, 'Please enter a valid address line 2 - EG: 102 Main Road');
              END IF;
              IF NOT REGEXP_LIKE(:NEW.s_postcode, '^[A-Za-z 0-9]+$') THEN
                  RAISE_APPLICATION_ERROR(-20011, 'Postcode is not in correct format, Only use letters, a space and numbers');
              END IF;
            END;
/


/*-----------------------------------Create route_num table, trigger and sequence---------------------------------------------*/
CREATE TABLE route_num(
    route_id                   INT                   CONSTRAINT route_id_pk PRIMARY KEY,
    route_name                 VARCHAR2(100)         CONSTRAINT route_name_nn NOT NULL /* can be null as some routes may be the same point to point with different stops*/
);

CREATE SEQUENCE seq_route_id
    NOCACHE
        START WITH 1
        INCREMENT BY 1
        MAXVALUE 9999
    CYCLE;

CREATE OR REPLACE TRIGGER trg_route_num
    BEFORE INSERT ON route_num
        FOR EACH ROW
            BEGIN
                IF INSERTING THEN
                    SELECT seq_route_id.nextval
                    INTO :NEW.route_id
                    FROM sys.dual;
                END IF;
            END;
/

CREATE OR REPLACE TRIGGER trg_route_num_alerts
    BEFORE INSERT OR UPDATE ON route_num
        FOR EACH ROW
            BEGIN
              IF (:NEW.route_name IS NULL) THEN
                    RAISE_APPLICATION_ERROR(-20010, 'please give the route a name - EG: Plymouth - Exeter (Fast-track)');
              END IF;
            END;
/

/*--------------------------------------------Create route table--------------------------------------------------------------*/
CREATE TABLE route(
    route_id                   INT                   CONSTRAINT route_id_fk2 REFERENCES route_num(route_id),
    station_id                 INT                   CONSTRAINT station_id_fk REFERENCES station(station_id)
                                                     CONSTRAINT station_name_fk_nn NOT NULL,
    stop_number                INT                   CONSTRAINT stop_number_nn NOT NULL,
    
                                                     CONSTRAINT route_comp_key PRIMARY KEY (route_id, station_id)
);

CREATE OR REPLACE TRIGGER trg_route_alerts
    BEFORE INSERT OR UPDATE ON route
        FOR EACH ROW
            BEGIN
              IF (:NEW.station_id IS NULL) THEN
                    RAISE_APPLICATION_ERROR(-20012, 'Please assign a station to the route stop');
              END IF;
              IF (:NEW.stop_number IS NULL) THEN
                    RAISE_APPLICATION_ERROR(-20012, 'Please assign a stop number to the route station');
              END IF;
            END;
/



/*---------------------------------Create journey table, trigger and sequence-------------------------------------------------*/
CREATE TABLE journey(
    journey_id                 INT                   CONSTRAINT journey_id_pk PRIMARY KEY,
    route_id                   INT                   CONSTRAINT route_id_fk REFERENCES route_num(route_id)
                                                     CONSTRAINT route_id_fk_nn NOT NULL,
    begin_time                 DATE                  CONSTRAINT begin_time_nn NOT NULL,
    arrival_time               DATE                  CONSTRAINT arrival_time_nn NOT NULL,
    time_delay                 INT,
    delay_reason               VARCHAR2(100),
    cancelled_reason           VARCHAR2(100),
    base_price                 NUMBER(10,2)          CONSTRAINT base_price_nn NOT NULL,
    num_of_carriages           INT   
);

CREATE SEQUENCE seq_journey_id
    NOCACHE
        START WITH 1
        INCREMENT BY 1
        MAXVALUE 9999999999
    CYCLE;

CREATE OR REPLACE TRIGGER trg_journey
    BEFORE INSERT ON journey
        FOR EACH ROW
            BEGIN
                IF INSERTING THEN
                    SELECT seq_journey_id.nextval
                    INTO :NEW.journey_id
                    FROM sys.dual;
                END IF;
            END;
/

CREATE OR REPLACE TRIGGER trg_journey_alerts
    BEFORE INSERT OR UPDATE ON journey
        FOR EACH ROW
            BEGIN
              IF (:NEW.route_id IS NULL) THEN
                    RAISE_APPLICATION_ERROR(-20012, 'Please assign a route to the journey');
              END IF;
              IF (:NEW.begin_time IS NULL) THEN
                    RAISE_APPLICATION_ERROR(-20010, 'please give the journey a start time');
              END IF;
              IF (:NEW.arrival_time IS NULL) THEN
                    RAISE_APPLICATION_ERROR(-20010, 'please give the journey a arrival time');
              END IF;
              IF (:NEW.base_price IS NULL) THEN
                    RAISE_APPLICATION_ERROR(-20010, 'please give the journey a base price');
              END IF;
              IF (:NEW.begin_time > :NEW.arrival_time) THEN
                    RAISE_APPLICATION_ERROR(-20013, 'Arrival can not be before departure');
              END IF;
              IF (:NEW.num_of_carriages < 1) THEN
                    RAISE_APPLICATION_ERROR(-20013, 'You can not have less than 1 carriages on a journey');
              END IF;
            END;
/

/*---------------------------------Create vehicle table, trigger and sequence-------------------------------------------------*/
CREATE TABLE vehicle (
    vehicle_reg                VARCHAR2(10)          CONSTRAINT vehicle_reg_pk PRIMARY KEY,
    journey_id                 INT                   CONSTRAINT journey_id_fk REFERENCES journey(journey_id),
    p_capacity                 INT                   CONSTRAINT p_capacity_nn NOT NULL,
    stored_location            VARCHAR2(20),
    vehicle_type               VARCHAR2(20)          CONSTRAINT vehicle_type_nn NOT NULL   
);

CREATE OR REPLACE TRIGGER trg_vehicle_alerts
    BEFORE INSERT OR UPDATE ON vehicle
        FOR EACH ROW
            BEGIN
              IF (:NEW.p_capacity IS NULL) THEN
                    RAISE_APPLICATION_ERROR(-20012, 'Please give a passenger capacity for the vehicle');
              END IF;
              IF (:NEW.vehicle_type IS NULL) THEN
                    RAISE_APPLICATION_ERROR(-20012, 'Please assign the vehicle a type');
              END IF;
            END;
/

/*---------------------------------Create user_account table, trigger and sequence--------------------------------------------*/
CREATE TABLE user_account(
    user_id                    INT                    CONSTRAINT user_id_pf PRIMARY KEY,
    username                   VARCHAR2(30)           CONSTRAINT username_un UNIQUE,
    user_password              VARCHAR2(100)          CONSTRAINT user_password_nn NOT NULL
                                                      CONSTRAINT user_password_chk CHECK (REGEXP_LIKE(user_password, '^[A-Za-z0-9!@£$%^&*()_+=-]{6,}$')),
    user_rank                  VARCHAR2(30)           CONSTRAINT user_rank_nn NOT NULL,
    first_name                 VARCHAR2(15)           CONSTRAINT first_name_nn NOT NULL
                                                      CONSTRAINT first_name_chk CHECK (REGEXP_LIKE(first_name, '^[A-Z][A-Za-z -]+$')),
    last_name                  VARCHAR2(15)           CONSTRAINT last_name_nn NOT NULL
                                                      CONSTRAINT last_name_chk CHECK (REGEXP_LIKE(last_name, '^[A-Z][A-Za-z -]+$')),
    date_of_Birth              DATE                   CONSTRAINT date_of_birth_nn NOT NULL,
    u_address_line_1           VARCHAR2(20)           CONSTRAINT u_address_line_1_nn NOT NULL
                                                      CONSTRAINT u_address_line_1_chk CHECK (REGEXP_LIKE(u_address_line_1, '^[a-zA-z-#.\, 0-9-]+$')),
    u_address_line_2           VARCHAR2(20)           CONSTRAINT u_address_line_2_chk CHECK (REGEXP_LIKE(u_address_line_2, '^[a-zA-z-#.\, 0-9-]+$')),
    u_postcode                 VARCHAR2(10)           CONSTRAINT u_postcode_nn NOT NULL
                                                      CONSTRAINT u_postcode_chk CHECK (REGEXP_LIKE(u_postcode, '^[A-Za-z 0-9]+$')),
    u_town                     VARCHAR2(15),
    email                      VARCHAR2(100)          CONSTRAINT email_nn NOT NULL
                                                      CONSTRAINT email_chk CHECK (REGEXP_LIKE(email, '^[A-Za-z0-9._%+!$%&*+={|}~^`-]+@[A-Za-z0-9.-]+\.[A-Za-z0-9]+$')),
    contact_number             VARCHAR2(15)           CONSTRAINT contact_number_chk CHECK (REGEXP_LIKE(contact_number, '^[+ 0-9]{11,}$')),
    alternative_number         VARCHAR2(15)           CONSTRAINT alternative_number_chk CHECK (REGEXP_LIKE(alternative_number, '^[+ 0-9]{11,}$')),
    marketing_opt_in           VARCHAR2(1)            DEFAULT ON NULL 'F'
);

CREATE SEQUENCE seq_user_id
    NOCACHE
        START WITH 1
        INCREMENT BY 1
        MAXVALUE 9999
    CYCLE;

CREATE OR REPLACE TRIGGER trg_user_account
    BEFORE INSERT ON user_account
        FOR EACH ROW
            BEGIN
                IF INSERTING THEN
                    SELECT seq_user_id.nextval
                    INTO :NEW.user_id
                    FROM sys.dual;
                END IF;
                /*generate a username for the user account*/
                IF INSERTING THEN
                    :NEW.username := LOWER(TO_CHAR(SUBSTR((:NEW.first_name), 1, 1) || :NEW.last_name ||  :NEW.user_id)); 
                END IF;
            END;
/

CREATE OR REPLACE TRIGGER trg_user_account_alerts
    BEFORE INSERT OR UPDATE ON user_account
        FOR EACH ROW
            BEGIN
              IF (:NEW.username IS NULL) THEN
                    :NEW.username := LOWER(TO_CHAR(SUBSTR((:NEW.first_name), 1, 1) || :NEW.last_name ||  :NEW.user_id)); 
                END IF;
              IF (:NEW.user_rank IS NULL) THEN
                    RAISE_APPLICATION_ERROR(-20012, 'Please assign the user a rank/class EG  - ADMIN, DRIVER, CUSTOMER, STATION STAFF, OTHER - CLEANER');
              END IF;
              IF (:NEW.first_name IS NULL) THEN
                    RAISE_APPLICATION_ERROR(-20012, 'Please enter first name');
              END IF;
              IF (:NEW.last_name IS NULL) THEN
                    RAISE_APPLICATION_ERROR(-20012, 'Please enter last name');
              END IF;
              IF (:NEW.date_of_birth IS NULL) THEN
                    RAISE_APPLICATION_ERROR(-20012, 'Please enter date of birth');
              END IF;
              IF (:NEW.u_address_line_1 IS NULL) THEN
                    RAISE_APPLICATION_ERROR(-20012, 'Please enter address line 1');
              END IF;
              IF (:NEW.u_postcode IS NULL) THEN
                    RAISE_APPLICATION_ERROR(-20012, 'Please enter postcode');
              END IF;
              IF (:NEW.email IS NULL) THEN
                    RAISE_APPLICATION_ERROR(-20012, 'Please enter email');
              END IF;
              IF (:NEW.contact_number IS NULL) THEN
                    RAISE_APPLICATION_ERROR(-20012, 'Please enter contact number');
              END IF;
              IF NOT REGEXP_LIKE(:NEW.user_password, '^[A-Za-z0-9!@£$%^&*()_+=-]{6,}$') THEN
                  RAISE_APPLICATION_ERROR(-20011, 'A password must be minimum 6 charaters, only letters, numbers and the symbols !@£$%^&*()_+=- allowed');
              END IF;
              IF NOT REGEXP_LIKE(:NEW.first_name, '^[A-Z][A-Za-z -]+$') THEN
                  RAISE_APPLICATION_ERROR(-20011, 'Please enter a valid first name, including a capatialsed initial EG - Joe');
              END IF;
              IF NOT REGEXP_LIKE(:NEW.last_name, '^[A-Z][A-Za-z -]+$') THEN
                  RAISE_APPLICATION_ERROR(-20011, 'Please enter a valid last name, including a capatialsed initial EG - Bloggs');
              END IF;
              IF NOT REGEXP_LIKE(:NEW.u_address_line_1, '^[a-zA-z-#.\, 0-9-]+$') THEN
                  RAISE_APPLICATION_ERROR(-20011, 'Please enter a valid address line 1 - EG: 102 Main Road');
              END IF;
              IF NOT REGEXP_LIKE(:NEW.u_address_line_2, '^[a-zA-z-#.\, 0-9-]+$') THEN
                  RAISE_APPLICATION_ERROR(-20011, 'Please enter a valid address line 2 - EG: 102 Main Road');
              END IF;
              IF NOT REGEXP_LIKE(:NEW.u_postcode, '^[A-Za-z 0-9]+$') THEN
                  RAISE_APPLICATION_ERROR(-20011, 'Postcode is not in correct format, Only use letters, a space and numbers');
              END IF;
              IF NOT REGEXP_LIKE(:NEW.email, '^[A-Za-z0-9._%+!$%&*+={|}~^`-]+@[A-Za-z0-9.-]+\.[A-Za-z0-9]+$') THEN
                  RAISE_APPLICATION_ERROR(-20011, 'Please enter a valid email, EG - Joe@ThomCo.co.uk');
              END IF;
              IF NOT REGEXP_LIKE(:NEW.contact_number, '^[+ 0-9]{11,}$') THEN
                  RAISE_APPLICATION_ERROR(-20011, 'Please enter a valid contact number, EG - 07522 456456');
              END IF;
              IF NOT REGEXP_LIKE(:NEW.alternative_number, '^[+ 0-9]{11,}$') THEN
                  RAISE_APPLICATION_ERROR(-20011, 'Please enter a valid alternative number, EG - 07522 456456');
              END IF;
              IF (((TRUNC(:NEW.date_of_birth + NUMTOYMINTERVAL(10,'YEAR')) > (TRUNC(SYSDATE)))) OR
                 ((TRUNC(:NEW.date_of_birth + NUMTOYMINTERVAL(130,'YEAR')) < (TRUNC(SYSDATE))))) THEN   
                  RAISE_APPLICATION_ERROR(-20014, 'Please check details, for example you cant be an less than 13 years of old or older than 150');
              END IF;
              IF NOT ((:NEW.user_rank = 'ADMIN') OR  
                      (:NEW.user_rank = 'CUSTOMER') OR
                      (:NEW.user_rank = 'STATION STAFF') OR
                      (:NEW.user_rank = 'DRIVER') OR
                       (REGEXP_LIKE(:NEW.user_rank, '^OTHER - [A-Z]+$'))) THEN
                RAISE_APPLICATION_ERROR(-20014, 'Please enter a correct user rank, ADMIN, DRIVER, CUSTOMER, STATION STAFF, OTHER - CLEANER,
                                                 if using other start with OTHER - then add the rank temporary title (IN CAPS LOCK)');
              END IF;
            END;
/

/*---------------------------------Create job table, trigger and sequence--------    -----------------------------------------*/
CREATE TABLE job (
    job_id                     INT                   CONSTRAINT job_id_pk PRIMARY KEY,
    user_id                    INT                   CONSTRAINT user_id_fk2    REFERENCES user_account(user_id),
    job_description            VARCHAR2(150)         CONSTRAINT job_description_nn NOT NULL,
    journey_id                 INT                   CONSTRAINT journey_id_fk3 REFERENCES journey(journey_id),
    job_date                   DATE                  CONSTRAINT job_date_nn NOT NULL
    
);

CREATE SEQUENCE seq_job_id
    NOCACHE
        START WITH 1
        INCREMENT BY 1
        MAXVALUE 9999999999
    CYCLE;

CREATE OR REPLACE TRIGGER trg_job
    BEFORE INSERT ON job
        FOR EACH ROW
            BEGIN
                IF INSERTING THEN
                    SELECT seq_job_id.nextval
                    INTO :NEW.job_id
                    FROM sys.dual;
                END IF;
            END;
/

CREATE OR REPLACE TRIGGER trg_job_alerts
    BEFORE INSERT OR UPDATE ON job
        FOR EACH ROW
            BEGIN
              IF (:NEW.job_description IS NULL) THEN
                    RAISE_APPLICATION_ERROR(-20012, 'Please give a job a description');
              END IF;
              IF (:NEW.job_date IS NULL) THEN
                    RAISE_APPLICATION_ERROR(-20012, 'Please give the job a date/datetime');
              END IF;
            END;
/
/*---------------------------------Create booking table, trigger and sequence-------------------------------------------------*/
CREATE TABLE booking (
    booking_id                 INT                   CONSTRAINT booking_id_pk PRIMARY KEY,
    journey_id                 INT                   CONSTRAINT journey_id_fk2 REFERENCES journey(journey_id)
                                                     CONSTRAINT journey_id_fk2_nn NOT NULL,
    user_id                    INT                   CONSTRAINT user_id_fk    REFERENCES user_account(user_id)
                                                     CONSTRAINT user_id_fk_nn NOT NULL,
    booking_code               VARCHAR2(25)          CONSTRAINT booking_code_un UNIQUE  /*could later be used for QR codes and such*/
);

CREATE SEQUENCE seq_booking_id
    NOCACHE
        START WITH 1
        INCREMENT BY 1
        MAXVALUE 9999999999
    CYCLE;

CREATE OR REPLACE TRIGGER trg_booking
    BEFORE INSERT ON booking
        FOR EACH ROW
            BEGIN
                IF INSERTING THEN
                    SELECT seq_booking_id.nextval
                    INTO :NEW.booking_id
                    FROM sys.dual;
                END IF;
            END;
/

CREATE OR REPLACE TRIGGER trg_booking_alerts
    BEFORE INSERT OR UPDATE ON booking
        FOR EACH ROW
            BEGIN
              IF (:NEW.journey_id IS NULL) THEN
                    RAISE_APPLICATION_ERROR(-20012, 'Please assign a booking a journey');
              END IF;
              IF (:NEW.user_id IS NULL) THEN
                    RAISE_APPLICATION_ERROR(-20012, 'Please assign a user to the booking');
              END IF;
            END;
/

/*---------------------------------Create transaction_log table, trigger and sequence-----------------------------------------*/
CREATE TABLE transaction_log (
    transaction_id             INT                   CONSTRAINT transaction_id_pk PRIMARY KEY,
    card_last_digits           VARCHAR2(4)           CONSTRAINT card_last_digits_nn NOT NULL,
    time_of_transaction        DATE                  CONSTRAINT time_of_transaction_nn NOT NULL,
    transaction_cost           NUMBER(10,2)          CONSTRAINT transaction_cost_nn NOT NULL
);

CREATE SEQUENCE seq_transaction_id
    NOCACHE
        START WITH 1
        INCREMENT BY 1
        MAXVALUE 99999
    CYCLE;

CREATE OR REPLACE TRIGGER trg_transaction
    BEFORE INSERT ON transaction_log
        FOR EACH ROW
            BEGIN
                IF INSERTING THEN
                    SELECT seq_transaction_id.nextval
                    INTO :NEW.transaction_id
                    FROM sys.dual;
                END IF;
            END;
/

CREATE OR REPLACE TRIGGER trg_transaction_log_alerts
    BEFORE INSERT OR UPDATE ON transaction_log
        FOR EACH ROW
            BEGIN
              IF (:NEW.card_last_digits IS NULL) THEN
                    RAISE_APPLICATION_ERROR(-20012, 'The log requires the cards last 4 digits');
              END IF;
              IF (:NEW.time_of_transaction IS NULL) THEN
                    RAISE_APPLICATION_ERROR(-20012, 'The log requires a datetime stamp');
              END IF;
              IF (:NEW.transaction_cost IS NULL) THEN
                    RAISE_APPLICATION_ERROR(-20012, 'The log requires record of the cost of the transaction');
              END IF;
            END;
/

/*-----------------------------------------------Insert Test Data-------------------------------------------------------------*/

/*Station test data*/
INSERT ALL
 INTO station (station_type, station_name, s_address_line_1, s_address_line_2, s_postcode) VALUES ('Station Stop', 'Plymouth', '31 Mount Gould', 'Plymouth', 'PL4 9KL')
 INTO station (station_type, station_name, s_address_line_1, s_address_line_2, s_postcode) VALUES ('Vehicle Workshop', 'Plymouth (Workshop)', '31 Mount Gould', 'Plymouth', 'PL4 9KL')
 INTO station (station_type, station_name, s_address_line_1, s_postcode) VALUES ('Station Stop', 'Totnes', '56 Station Approach', 'TN4 8JN')
 INTO station (station_type, station_name, s_address_line_1, s_address_line_2, s_postcode) VALUES ('Station Stop', 'Newton Abbott', '1 Main Road', 'Newton Abbott', 'NA3 3VO')
 INTO station (station_type, station_name, s_address_line_1, s_address_line_2, s_postcode) VALUES ('Vehicle Storage', 'Plymouth (Vehicle Storage)', '31 Mount Gould', 'Plymouth', 'PL4 9KL')
 INTO station (station_type, station_name, s_address_line_1, s_address_line_2, s_postcode) VALUES ('Station Stop', 'Exeter', '23 High Street', 'Exeter, Devon', 'EX54 1DF')
SELECT 1 FROM DUAL;

/*route test data*/
INSERT ALL
 INTO route_num (route_name) VALUES ('Plymouth - Exeter')
 INTO route_num (route_name) VALUES ('Exeter - Plymouth')
 INTO route_num (route_name) VALUES ('Plymouth - Exeter (Fasttrack)')
SELECT 1 FROM DUAL;

INSERT ALL
 INTO route (route_id, station_id, stop_number) VALUES ('1','1','1')
 INTO route (route_id, station_id, stop_number) VALUES ('1','3','2')
 INTO route (route_id, station_id, stop_number) VALUES ('1','4','3')
 INTO route (route_id, station_id, stop_number) VALUES ('1','6','4')
 INTO route (route_id, station_id, stop_number) VALUES ('2','6','1')
 INTO route (route_id, station_id, stop_number) VALUES ('2','4','2')
 INTO route (route_id, station_id, stop_number) VALUES ('2','3','3')
 INTO route (route_id, station_id, stop_number) VALUES ('2','1','4')
 INTO route (route_id, station_id, stop_number) VALUES ('3','1','1')
 INTO route (route_id, station_id, stop_number) VALUES ('3','6','2')
SELECT 1 FROM DUAL;

/*journey test data*/
INSERT ALL
 INTO journey(route_id, begin_time, arrival_time, base_price, num_of_carriages) 
 VALUES ('1', (TO_DATE('2019/05/25 08:05:00', 'yyyy/mm/dd hh24:mi:ss')), (TO_DATE('2019/05/25 08:55:00', 'yyyy/mm/dd hh24:mi:ss')), '3.50', '1')
 INTO journey(route_id, begin_time, arrival_time, base_price, num_of_carriages) 
 VALUES ('1', (TO_DATE('2019/05/25 09:05:00', 'yyyy/mm/dd hh24:mi:ss')), (TO_DATE('2019/05/25 09:55:00', 'yyyy/mm/dd hh24:mi:ss')), '3.50', '1')
 INTO journey(route_id, begin_time, arrival_time, base_price, num_of_carriages) 
 VALUES ('1', (TO_DATE('2019/05/25 10:05:00', 'yyyy/mm/dd hh24:mi:ss')), (TO_DATE('2019/05/25 10:55:00', 'yyyy/mm/dd hh24:mi:ss')), '3.50', '1')
 INTO journey(route_id, begin_time, arrival_time, base_price, num_of_carriages) 
 VALUES ('1', (TO_DATE('2019/05/25 10:05:00', 'yyyy/mm/dd hh24:mi:ss')), (TO_DATE('2019/05/25 10:55:00', 'yyyy/mm/dd hh24:mi:ss')), '3.50', '1')
 INTO journey(route_id, begin_time, arrival_time, base_price, num_of_carriages) 
 VALUES ('2', (TO_DATE('2019/05/25 09:05:00', 'yyyy/mm/dd hh24:mi:ss')), (TO_DATE('2019/05/25 09:55:00', 'yyyy/mm/dd hh24:mi:ss')), '3.50', '1')
 INTO journey(route_id, begin_time, arrival_time, base_price, num_of_carriages) 
 VALUES ('2', (TO_DATE('2019/05/25 10:05:00', 'yyyy/mm/dd hh24:mi:ss')), (TO_DATE('2019/05/25 10:55:00', 'yyyy/mm/dd hh24:mi:ss')), '3.50', '1')
 INTO journey(route_id, begin_time, arrival_time, base_price, num_of_carriages) 
 VALUES ('2', (TO_DATE('2019/05/25 11:05:00', 'yyyy/mm/dd hh24:mi:ss')), (TO_DATE('2019/05/25 11:55:00', 'yyyy/mm/dd hh24:mi:ss')), '3.50', '1')
 INTO journey(route_id, begin_time, arrival_time, base_price, num_of_carriages) 
 VALUES ('3', (TO_DATE('2019/05/25 18:05:00', 'yyyy/mm/dd hh24:mi:ss')), (TO_DATE('2019/05/25 18:35:00', 'yyyy/mm/dd hh24:mi:ss')), '5.55', '2')
SELECT 1 FROM DUAL;

/*Vehicle test data*/
INSERT ALL
 INTO vehicle (vehicle_reg, journey_id, p_capacity, stored_location, vehicle_type) VALUES ('TR41N', '1', '50', 'Plymouth - Depot', 'Train - Engine')
 INTO vehicle (vehicle_reg, journey_id, p_capacity, stored_location, vehicle_type) VALUES ('TR42N', '2', '50', 'Plymouth - Depot', 'Train - Engine')
 INTO vehicle (vehicle_reg, p_capacity, stored_location, vehicle_type) VALUES ('TR43N',  '50', 'Plymouth - Depot', 'Train - Engine')
 INTO vehicle (vehicle_reg, journey_id, p_capacity, stored_location, vehicle_type) VALUES ('TR44N', '4', '50', 'Plymouth - Depot', 'Train - Engine')
 INTO vehicle (vehicle_reg, journey_id, p_capacity, stored_location, vehicle_type) VALUES ('TR45N', '5', '50', 'Plymouth - Depot', 'Train - Engine')
 INTO vehicle (vehicle_reg, journey_id, p_capacity, stored_location, vehicle_type) VALUES ('TR46N', '6', '50', 'Plymouth - Depot', 'Train - Engine')
 INTO vehicle (vehicle_reg, journey_id, p_capacity, stored_location, vehicle_type) VALUES ('TR47N', '6', '80', 'Plymouth - Depot', 'Train - Passenger')
SELECT 1 FROM DUAL;

/*Transaction_log test data*/
INSERT ALL
 INTO transaction_log(transaction_cost, card_last_digits, time_of_transaction) VALUES ('10.10', '6543', (TO_DATE('2019/02/13 21:54:54', 'yyyy/mm/dd hh24:mi:ss')))
 INTO transaction_log(transaction_cost, card_last_digits, time_of_transaction) VALUES ('3.50', '1234', (TO_DATE('2019/02/20 09:12:33', 'yyyy/mm/dd hh24:mi:ss')))
SELECT 1 FROM DUAL;

/*User test data*/
INSERT ALL
 INTO user_account(user_password, user_rank, first_name, last_name, date_of_birth, u_address_line_1, u_postcode, email, contact_number, marketing_opt_in)
 VALUES ('Password!', 'ADMIN', 'Admin', 'Istrator', (TO_DATE('1979/02/17', 'yyyy/mm/dd')), '1 Main Road', 'PL4 8LK' , 'Admin@Thomco.com' , '01702 123123', 'T')
 INTO user_account(user_password, user_rank, first_name, last_name, date_of_birth, u_address_line_1, u_postcode, email, contact_number)
 VALUES ('Password!', 'CUSTOMER', 'Cust', 'Omer', (TO_DATE('1998/06/10', 'yyyy/mm/dd')), '1 Other Road', 'PL3 9VO' , 'Customer@Gmail.com' , '01702 183753')
 INTO user_account(user_password, user_rank, first_name, last_name, date_of_birth, u_address_line_1, u_postcode, email, contact_number)
 VALUES ('Password!', 'CUSTOMER', 'John', 'Smith', (TO_DATE('1988/10/05', 'yyyy/mm/dd')), '32 Other Road', 'PL3 9VO' , 'JSmith@Gmail.com' , '01702 759273')
 INTO user_account(user_password, user_rank, first_name, last_name, date_of_birth, u_address_line_1, u_postcode, email, contact_number)
 VALUES ('Password!', 'DRIVER', 'Gregg', 'Innerman', (TO_DATE('1988/12/25', 'yyyy/mm/dd')), '32 Park Lane', 'EX13 1EF' , 'ginnerman88@Gmail.com' , '01702 321321')
 INTO user_account(user_password, user_rank, first_name, last_name, date_of_birth, u_address_line_1, u_postcode, email, contact_number, marketing_opt_in)
 VALUES ('Password!', 'STATION STAFF', 'Paul', 'Torneay', (TO_DATE('1988/12/25', 'yyyy/mm/dd')), '232 That Avenue', 'PL4 8BX' , 'Legitman@Gmail.com' , '01702 928572', 'T')
SELECT 1 FROM DUAL;

/*Booking Test Data*/
INSERT ALL
 INTO booking(journey_id, user_id, booking_code) VALUES ('1', '3', 'ghaRJGJSbakehr9873agh3uhk')
 INTO booking(journey_id, user_id, booking_code) VALUES ('8', '2', 'uhfjkakjgwkjgkjfgkj381gkv')
 INTO booking(journey_id, user_id, booking_code) VALUES ('8', '2', 'uhfjkakjgwkjg21244j381gkv')
SELECT 1 FROM DUAL;

/*job test data*/
INSERT ALL
 INTO job(job_id, user_id, job_description, journey_id, job_date) VALUES (1000, 4, 'Drive the train', 1, (TO_DATE('2019/05/25 08:55:00', 'yyyy/mm/dd hh24:mi:ss')))
 INTO job(job_id, user_id, job_description,  job_date) VALUES (1000, 5, 'Clean toilets at Plymouth station', (TO_DATE('2019/05/25 08:00:00', 'yyyy/mm/dd hh24:mi:ss')))
SELECT 1 FROM DUAL;
