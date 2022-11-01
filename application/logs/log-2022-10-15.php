<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-10-15 01:51:22 --> Severity: Warning --> mysqli::real_connect(): Error while reading greeting packet. PID=71391 /Library/WebServer/Documents/MyMIWallet/v7/v1.5/bonfire/ci3/database/drivers/mysqli/mysqli_driver.php 191
ERROR - 2022-10-15 01:51:22 --> Severity: Warning --> mysqli::real_connect(): (HY000/2006): MySQL server has gone away /Library/WebServer/Documents/MyMIWallet/v7/v1.5/bonfire/ci3/database/drivers/mysqli/mysqli_driver.php 191
ERROR - 2022-10-15 01:51:22 --> Unable to connect to the database
ERROR - 2022-10-15 01:51:22 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /Library/WebServer/Documents/MyMIWallet/v7/v1.5/bonfire/ci3/core/Exceptions.php:279) /Library/WebServer/Documents/MyMIWallet/v7/v1.5/bonfire/ci3/core/Common.php 529
ERROR - 2022-10-15 04:14:59 --> Severity: error --> Exception: syntax error, unexpected ';' /Library/WebServer/Documents/MyMIWallet/v7/v1.5/application/modules/User/controllers/Budget.php 109
ERROR - 2022-10-15 12:18:48 --> Severity: error --> Exception: Call to undefined method Budget_model::get_recurring_accounts() /Library/WebServer/Documents/MyMIWallet/v7/v1.5/application/modules/User/views/Budget/index.php 251
ERROR - 2022-10-15 13:08:23 --> Severity: error --> Exception: Call to undefined method Budget_model::get_recurring_accounts() /Library/WebServer/Documents/MyMIWallet/v7/v1.5/application/modules/User/views/Budget/index.php 251
ERROR - 2022-10-15 13:19:42 --> Severity: Notice --> Undefined variable: getAccountInfo /Library/WebServer/Documents/MyMIWallet/v7/v1.5/application/models/User/Budget_model.php 153
ERROR - 2022-10-15 14:50:33 --> Severity: Compile Error --> Cannot redeclare Budget_model::get_income_account_summary() /Library/WebServer/Documents/MyMIWallet/v7/v1.5/application/models/User/Budget_model.php 216
ERROR - 2022-10-15 15:00:38 --> Severity: Notice --> Undefined variable: cuID /Library/WebServer/Documents/MyMIWallet/v7/v1.5/application/modules/User/views/Budget/index.php 4
ERROR - 2022-10-15 15:00:38 --> Query error: Unknown column 'deleted' in 'where clause' - Invalid query: SELECT SUM(`net_amount`) AS `net_amount`, `account_type`
FROM `bf_users_budgeting`
WHERE `status` = 1
AND `deleted` = 0
AND `created_by` IS NULL
AND `account_type` = 'Income'
ERROR - 2022-10-15 15:02:06 --> Query error: Unknown column 'deleted' in 'where clause' - Invalid query: SELECT SUM(`net_amount`) AS `net_amount`, `account_type`
FROM `bf_users_budgeting`
WHERE `status` = 1
AND `deleted` = 0
AND `created_by` = '436'
AND `account_type` = 'Income'
ERROR - 2022-10-15 15:16:25 --> Query error: Unknown column 'deleted' in 'where clause' - Invalid query: SELECT SUM(`net_amount`) AS `net_amount`, `account_type`
FROM `bf_users_budgeting`
WHERE `status` = 1
AND `deleted` = 0
AND `created_by` = '436'
AND `account_type` = 'Income'
ERROR - 2022-10-15 15:20:12 --> Query error: Unknown column 'deleted' in 'where clause' - Invalid query: SELECT SUM(`net_amount`) AS `net_amount`, `account_type`
FROM `bf_users_budgeting`
WHERE `status` = 1
AND `deleted` = 0
AND `created_by` = '436'
AND `account_type` = 'Income'
ERROR - 2022-10-15 15:21:35 --> Severity: error --> Exception: Call to a member function result_array() on null /Library/WebServer/Documents/MyMIWallet/v7/v1.5/application/modules/User/views/Budget/index.php 8
ERROR - 2022-10-15 16:30:15 --> Query error: Unknown column 'delete' in 'where clause' - Invalid query: SELECT *
FROM `bf_users_budgeting`
WHERE `status` = 1
AND `delete` = 0
ERROR - 2022-10-15 16:50:39 --> Severity: error --> Exception: Too few arguments to function Budget_model::get_last_recurring_account_info(), 0 passed in /Library/WebServer/Documents/MyMIWallet/v7/v1.5/application/modules/User/views/Budget/Recurring_Account_Schedule.php on line 39 and exactly 1 expected /Library/WebServer/Documents/MyMIWallet/v7/v1.5/application/models/User/Budget_model.php 158
ERROR - 2022-10-15 16:51:18 --> Severity: Notice --> Undefined variable: getAccountInfo /Library/WebServer/Documents/MyMIWallet/v7/v1.5/application/modules/User/views/Budget/Recurring_Account_Schedule.php 43
ERROR - 2022-10-15 16:51:18 --> Severity: error --> Exception: Call to a member function result_array() on null /Library/WebServer/Documents/MyMIWallet/v7/v1.5/application/modules/User/views/Budget/Recurring_Account_Schedule.php 43
ERROR - 2022-10-15 16:36:49 --> Severity: Notice --> Array to string conversion /Library/WebServer/Documents/MyMIWallet/v7/v1.5/application/modules/User/views/Budget/Add/user_fields.php 17
ERROR - 2022-10-15 16:37:21 --> Severity: Notice --> Array to string conversion /Library/WebServer/Documents/MyMIWallet/v7/v1.5/application/modules/User/views/Budget/Add/user_fields.php 17
ERROR - 2022-10-15 22:14:19 --> Severity: Warning --> Constants may only evaluate to scalar values, arrays or resources /Library/WebServer/Documents/MyMIWallet/v7/v1.5/public/themes/admin/data_distribution.php 86
ERROR - 2022-10-15 22:14:19 --> Severity: Warning --> Use of undefined constant allSessionDta - assumed 'allSessionDta' (this will throw an Error in a future version of PHP) /Library/WebServer/Documents/MyMIWallet/v7/v1.5/public/themes/admin/data_distribution.php 87
ERROR - 2022-10-15 22:14:19 --> Severity: Warning --> Illegal string offset '' /Library/WebServer/Documents/MyMIWallet/v7/v1.5/public/themes/admin/data_distribution.php 87
ERROR - 2022-10-15 17:14:19 --> Severity: Notice --> Array to string conversion /Library/WebServer/Documents/MyMIWallet/v7/v1.5/application/modules/User/views/Budget/Add/user_fields.php 17
ERROR - 2022-10-15 21:23:04 --> Severity: Notice --> Array to string conversion /Library/WebServer/Documents/MyMIWallet/v7/v1.5/application/modules/User/views/Budget/Add/user_fields.php 17
ERROR - 2022-10-15 21:27:59 --> Severity: Notice --> Array to string conversion /Library/WebServer/Documents/MyMIWallet/v7/v1.5/application/modules/User/views/Budget/Add/user_fields.php 17
