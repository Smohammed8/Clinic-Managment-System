<?php
define('DOCTOR_ROLE', 'doctor');
// constants.php
//define('STATUS_SCHEDULED',  0);
define('STATUS_CHECKED_IN',  1); //Accepted ny receptionTESTESTEST
define('STATUS_IN_PROGRESS',  2); // Called by the doctor
define('STATUS_COMPLETED',  3); // Encounter Colsed
define('STATUS_MISSED',  4); //Missed and closed


define('STATUS_RESCHEDULED',  5); //
define('STATUS_WAITING',  6); //Sent to labratory and waitin 
define('STATUS_ON_HOLD',  7);
define('STATUS_TEST_PENDING',  8); //accepted by lab and pending for result
define('STATUS_TEST_AVAILABLE',  9);
define('STATUS_TEST_REVIEWED',  10);
define('STATUS_FOLLOW_UP_SCHEDULED',  12);
define('STATUS_FOLLOW_UP_COMPLETED',  13);



// 1 Checking  2 Called by doctor, acppeted, 3 closed