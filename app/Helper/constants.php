<?php
define('DOCTOR_ROLE', 'doctor');
// constants.php

//define('STATUS_SCHEDULED',  0);
define('STATUS_CHECKED_IN',  0); //Accepted ny reception
define('STATUS_COMPLETED',  1); // Encounter Colsed
define('STATUS_IN_PROGRESS',  2); // Called by the doctor
define('STATUS_MISSED',  3); //Missed and closed
define('STATUS_RESCHEDULED',  4); //
define('STATUS_WAITING',  5); //Sent to labratory and waitin 
define('STATUS_ON_HOLD',  6);
define('STATUS_TEST_PENDING',  7); //accepted by lab and pending for result
define('STATUS_TEST_AVAILABLE',  8);
define('STATUS_TEST_REVIEWED',  9);
define('STATUS_FOLLOW_UP_SCHEDULED',  10);
define('STATUS_FOLLOW_UP_COMPLETED',  11);

// ... Add constants for other status values ...
