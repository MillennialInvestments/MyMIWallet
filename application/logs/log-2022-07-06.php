<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-07-06 15:43:07 --> Severity: Notice --> Undefined variable: getTotalPartnerAssets /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 257
ERROR - 2022-07-06 15:43:07 --> Severity: error --> Exception: Call to a member function result_array() on null /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 257
ERROR - 2022-07-06 15:59:52 --> Severity: error --> Exception: Call to a member function result_array() on null /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 258
ERROR - 2022-07-06 16:32:52 --> Severity: error --> Exception: Call to a member function result_array() on null /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 258
ERROR - 2022-07-06 16:36:54 --> Severity: error --> Exception: Unable to locate the model you have specified: Analytics_model /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/bonfire/ci3/core/Loader.php 319
ERROR - 2022-07-06 16:37:10 --> Severity: error --> Exception: Call to undefined method BF_Loader::analytics_model_get_approved_partner_assets() /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/modules/Management/views/Web_Design/Content_Creator.php 31
ERROR - 2022-07-06 16:49:26 --> Severity: error --> Exception: syntax error, unexpected 'foreach' (T_FOREACH) /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/modules/Management/views/Web_Design/Content_Creator.php 33
ERROR - 2022-07-06 17:02:33 --> Severity: Notice --> Undefined variable: parterAsset /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/models/Management/Analytical_model.php 170
ERROR - 2022-07-06 17:02:33 --> Severity: Notice --> Trying to access array offset on value of type null /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/models/Management/Analytical_model.php 170
ERROR - 2022-07-06 17:02:33 --> Severity: Notice --> Array to string conversion /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/bonfire/ci3/database/DB_query_builder.php 2262
ERROR - 2022-07-06 17:02:33 --> Query error: Unknown column 'Array' in 'where clause' - Invalid query: SELECT SUM(`amount`) AS `amount`, SUM(`fees`) AS `fees`
FROM `bf_exchanges_orders`
WHERE `id` = Array
AND `status` = 'Closed'
ERROR - 2022-07-06 17:20:18 --> Severity: error --> Exception: Call to a member function result_array() on array /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 258
ERROR - 2022-07-06 17:20:56 --> Severity: Notice --> Undefined property: CI::$CI /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/third_party/MX/Loader.php 321
ERROR - 2022-07-06 17:20:56 --> Severity: Notice --> Trying to get property 'analytical_model' of non-object /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/modules/Management/views/Web_Design/Content_Creator.php 30
ERROR - 2022-07-06 17:20:56 --> Severity: error --> Exception: Call to a member function get_total_partner_amounts() on null /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/modules/Management/views/Web_Design/Content_Creator.php 30
ERROR - 2022-07-06 17:21:14 --> Severity: Notice --> Array to string conversion /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/modules/Management/views/Web_Design/Content_Creator.php 31
ERROR - 2022-07-06 17:21:42 --> Severity: error --> Exception: Call to a member function result_array() on array /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/modules/Management/views/Web_Design/Content_Creator.php 31
ERROR - 2022-07-06 17:22:23 --> Severity: Notice --> Array to string conversion /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/modules/Management/views/Web_Design/Content_Creator.php 31
ERROR - 2022-07-06 17:22:47 --> Severity: error --> Exception: Call to a member function result_array() on array /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/modules/Management/views/Web_Design/Content_Creator.php 31
ERROR - 2022-07-06 17:23:00 --> Severity: error --> Exception: Call to a member function result_array() on array /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/modules/Management/views/Web_Design/Content_Creator.php 31
ERROR - 2022-07-06 17:24:43 --> Severity: error --> Exception: Call to a member function result_array() on array /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 258
ERROR - 2022-07-06 17:25:12 --> Severity: Notice --> Undefined index: fees /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 259
ERROR - 2022-07-06 17:25:12 --> Severity: Notice --> Undefined index: fees /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 261
ERROR - 2022-07-06 17:25:12 --> Severity: Notice --> Undefined index: amount /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 264
ERROR - 2022-07-06 17:25:12 --> Severity: Notice --> Undefined index: amount /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 266
ERROR - 2022-07-06 17:25:12 --> Severity: Notice --> Undefined index: fees /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 269
ERROR - 2022-07-06 17:25:12 --> Severity: Notice --> Undefined index: amount /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 270
ERROR - 2022-07-06 17:25:12 --> Severity: Notice --> Undefined variable: totalPartnerTransFees /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 279
ERROR - 2022-07-06 17:27:46 --> Severity: Notice --> Undefined index: fees /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 259
ERROR - 2022-07-06 17:27:46 --> Severity: Notice --> Undefined index: fees /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 261
ERROR - 2022-07-06 17:27:46 --> Severity: Notice --> Undefined index: amount /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 264
ERROR - 2022-07-06 17:27:46 --> Severity: Notice --> Undefined index: amount /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 266
ERROR - 2022-07-06 17:27:46 --> Severity: Notice --> Undefined index: fees /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 269
ERROR - 2022-07-06 17:27:46 --> Severity: Notice --> Undefined index: amount /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 270
ERROR - 2022-07-06 17:27:46 --> Severity: Notice --> Undefined variable: totalPartnerTransFees /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 279
ERROR - 2022-07-06 17:30:32 --> Severity: Notice --> Undefined index: fees /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 259
ERROR - 2022-07-06 17:30:32 --> Severity: Notice --> Undefined index: fees /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 261
ERROR - 2022-07-06 17:30:32 --> Severity: Notice --> Undefined index: amount /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 264
ERROR - 2022-07-06 17:30:32 --> Severity: Notice --> Undefined index: amount /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 266
ERROR - 2022-07-06 17:30:32 --> Severity: Notice --> Undefined index: fees /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 269
ERROR - 2022-07-06 17:30:32 --> Severity: Notice --> Undefined index: amount /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 270
ERROR - 2022-07-06 17:30:32 --> Severity: Notice --> Undefined variable: totalPartnerTransFees /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 279
ERROR - 2022-07-06 18:58:53 --> Severity: Notice --> Undefined index: fees /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 259
ERROR - 2022-07-06 18:58:53 --> Severity: Notice --> Undefined index: fees /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 261
ERROR - 2022-07-06 18:58:53 --> Severity: Notice --> Undefined index: amount /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 264
ERROR - 2022-07-06 18:58:53 --> Severity: Notice --> Undefined index: amount /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 266
ERROR - 2022-07-06 18:58:53 --> Severity: Notice --> Undefined index: fees /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 269
ERROR - 2022-07-06 18:58:53 --> Severity: Notice --> Undefined index: amount /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 270
ERROR - 2022-07-06 18:58:53 --> Severity: Notice --> Undefined variable: totalPartnerTransFees /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 279
ERROR - 2022-07-06 19:42:08 --> Severity: Notice --> Undefined index: fees /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 258
ERROR - 2022-07-06 19:42:08 --> Severity: Notice --> Undefined index: fees /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 260
ERROR - 2022-07-06 19:42:08 --> Severity: Notice --> Undefined index: amount /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 263
ERROR - 2022-07-06 19:42:08 --> Severity: Notice --> Undefined index: amount /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 265
ERROR - 2022-07-06 19:42:08 --> Severity: Notice --> Undefined index: fees /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 268
ERROR - 2022-07-06 19:42:08 --> Severity: Notice --> Undefined index: amount /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 269
ERROR - 2022-07-06 19:42:08 --> Severity: Notice --> Undefined variable: totalPartnerTransFees /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 291
ERROR - 2022-07-06 19:44:17 --> Severity: Notice --> Undefined index: getTotalPartnerAMounts /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/modules/Management/views/Partners/index.php 28
ERROR - 2022-07-06 19:52:21 --> Severity: error --> Exception: syntax error, unexpected ''partnerSupportPercentage'' (T_CONSTANT_ENCAPSED_STRING), expecting ')' /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 103
ERROR - 2022-07-06 19:52:44 --> Severity: Notice --> Undefined index: totalPartnerTransAmounts /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 51
ERROR - 2022-07-06 19:52:44 --> Severity: Notice --> Undefined index: targetPartnerTransAmount /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 51
ERROR - 2022-07-06 19:52:44 --> Severity: Warning --> Division by zero /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 51
ERROR - 2022-07-06 19:52:44 --> Severity: Notice --> Undefined variable: partnerTransationPercentage /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 102
ERROR - 2022-07-06 19:52:44 --> Severity: Notice --> Undefined index: targetPartnerTransactions /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 115
ERROR - 2022-07-06 19:52:44 --> Severity: Notice --> Undefined index: targetPartnerTransAmount /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 116
ERROR - 2022-07-06 19:52:44 --> Severity: Notice --> Undefined index: targetPartnerTransFees /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 117
ERROR - 2022-07-06 19:52:44 --> Severity: Notice --> Undefined variable: totalPartnerTransTotals /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/modules/Management/views/Partners/index.php 350
ERROR - 2022-07-06 19:52:44 --> Severity: Notice --> Undefined variable: targetUsers /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/modules/Management/views/Partners/index.php 351
ERROR - 2022-07-06 19:52:44 --> Severity: Notice --> Undefined variable: usersPercentage /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/modules/Management/views/Partners/index.php 351
ERROR - 2022-07-06 19:53:26 --> Severity: Notice --> Undefined index: targetPartnerTransAmount /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 51
ERROR - 2022-07-06 19:53:26 --> Severity: Warning --> A non-numeric value encountered /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 51
ERROR - 2022-07-06 19:53:26 --> Severity: Warning --> Division by zero /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 51
ERROR - 2022-07-06 19:53:26 --> Severity: Notice --> Undefined variable: partnerTransationPercentage /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 102
ERROR - 2022-07-06 19:53:26 --> Severity: Notice --> Undefined index: targetPartnerTransactions /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 115
ERROR - 2022-07-06 19:53:26 --> Severity: Notice --> Undefined index: targetPartnerTransAmount /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 116
ERROR - 2022-07-06 19:53:26 --> Severity: Notice --> Undefined index: targetPartnerTransFees /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 117
ERROR - 2022-07-06 19:53:26 --> Severity: Notice --> Undefined variable: totalPartnerTransTotals /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/modules/Management/views/Partners/index.php 350
ERROR - 2022-07-06 19:53:26 --> Severity: Notice --> Undefined variable: targetUsers /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/modules/Management/views/Partners/index.php 351
ERROR - 2022-07-06 19:53:26 --> Severity: Notice --> Undefined variable: usersPercentage /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/modules/Management/views/Partners/index.php 351
ERROR - 2022-07-06 19:54:29 --> Severity: Warning --> A non-numeric value encountered /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 51
ERROR - 2022-07-06 19:54:29 --> Severity: Notice --> Undefined variable: partnerTransationPercentage /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 102
ERROR - 2022-07-06 19:54:29 --> Severity: Notice --> Undefined variable: totalPartnerTransTotals /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/modules/Management/views/Partners/index.php 350
ERROR - 2022-07-06 19:54:29 --> Severity: Notice --> Undefined variable: targetUsers /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/modules/Management/views/Partners/index.php 351
ERROR - 2022-07-06 19:54:29 --> Severity: Notice --> Undefined variable: usersPercentage /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/modules/Management/views/Partners/index.php 351
ERROR - 2022-07-06 19:55:49 --> Severity: Notice --> Undefined variable: partnerTransactionPercentage /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 102
ERROR - 2022-07-06 19:55:49 --> Severity: Notice --> Undefined variable: totalPartnerTransTotals /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/modules/Management/views/Partners/index.php 350
ERROR - 2022-07-06 19:55:49 --> Severity: Notice --> Undefined variable: targetUsers /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/modules/Management/views/Partners/index.php 351
ERROR - 2022-07-06 19:55:49 --> Severity: Notice --> Undefined variable: usersPercentage /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/modules/Management/views/Partners/index.php 351
ERROR - 2022-07-06 19:56:28 --> Severity: Notice --> Undefined variable: totalPartnerTransTotals /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/modules/Management/views/Partners/index.php 350
ERROR - 2022-07-06 19:56:28 --> Severity: Notice --> Undefined variable: targetUsers /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/modules/Management/views/Partners/index.php 351
ERROR - 2022-07-06 19:56:28 --> Severity: Notice --> Undefined variable: usersPercentage /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/modules/Management/views/Partners/index.php 351
ERROR - 2022-07-06 19:57:49 --> Severity: Warning --> number_format() expects parameter 1 to be float, string given /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/modules/Management/views/Partners/index.php 351
ERROR - 2022-07-06 19:57:49 --> Severity: Notice --> Undefined variable: targetPartnerTransAmount /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/modules/Management/views/Partners/index.php 352
ERROR - 2022-07-06 19:57:49 --> Severity: Notice --> Undefined variable: usersPercentage /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/modules/Management/views/Partners/index.php 352
ERROR - 2022-07-06 20:03:11 --> Severity: Warning --> number_format() expects parameter 1 to be float, string given /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/modules/Management/views/Partners/index.php 351
ERROR - 2022-07-06 20:03:11 --> Severity: Notice --> Undefined variable: targetPartnerTransAmount /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/modules/Management/views/Partners/index.php 352
ERROR - 2022-07-06 20:03:11 --> Severity: Notice --> Undefined variable: usersPercentage /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/modules/Management/views/Partners/index.php 352
ERROR - 2022-07-06 20:39:23 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Connection refused /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/bonfire/ci3/database/drivers/mysqli/mysqli_driver.php 191
ERROR - 2022-07-06 20:39:23 --> Unable to connect to the database
ERROR - 2022-07-06 20:39:27 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Connection refused /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/bonfire/ci3/database/drivers/mysqli/mysqli_driver.php 191
ERROR - 2022-07-06 20:39:27 --> Unable to connect to the database
ERROR - 2022-07-06 20:39:30 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Connection refused /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/bonfire/ci3/database/drivers/mysqli/mysqli_driver.php 191
ERROR - 2022-07-06 20:39:30 --> Unable to connect to the database
ERROR - 2022-07-06 20:39:44 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Connection refused /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/bonfire/ci3/database/drivers/mysqli/mysqli_driver.php 191
ERROR - 2022-07-06 20:39:44 --> Unable to connect to the database
ERROR - 2022-07-06 20:40:31 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Connection refused /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/bonfire/ci3/database/drivers/mysqli/mysqli_driver.php 191
ERROR - 2022-07-06 20:40:31 --> Unable to connect to the database
ERROR - 2022-07-06 20:40:55 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Connection refused /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/bonfire/ci3/database/drivers/mysqli/mysqli_driver.php 191
ERROR - 2022-07-06 20:40:55 --> Unable to connect to the database
ERROR - 2022-07-06 20:41:01 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Connection refused /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/bonfire/ci3/database/drivers/mysqli/mysqli_driver.php 191
ERROR - 2022-07-06 20:41:01 --> Unable to connect to the database
ERROR - 2022-07-06 20:42:20 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Connection refused /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/bonfire/ci3/database/drivers/mysqli/mysqli_driver.php 191
ERROR - 2022-07-06 20:42:20 --> Unable to connect to the database
ERROR - 2022-07-06 20:42:21 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Connection refused /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/bonfire/ci3/database/drivers/mysqli/mysqli_driver.php 191
ERROR - 2022-07-06 20:42:21 --> Unable to connect to the database
ERROR - 2022-07-06 20:43:17 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Connection refused /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/bonfire/ci3/database/drivers/mysqli/mysqli_driver.php 191
ERROR - 2022-07-06 20:43:17 --> Unable to connect to the database
ERROR - 2022-07-06 20:43:18 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Connection refused /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/bonfire/ci3/database/drivers/mysqli/mysqli_driver.php 191
ERROR - 2022-07-06 20:43:18 --> Unable to connect to the database
ERROR - 2022-07-06 20:44:24 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Connection refused /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/bonfire/ci3/database/drivers/mysqli/mysqli_driver.php 191
ERROR - 2022-07-06 20:44:24 --> Unable to connect to the database
ERROR - 2022-07-06 20:45:01 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Connection refused /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/bonfire/ci3/database/drivers/mysqli/mysqli_driver.php 191
ERROR - 2022-07-06 20:45:01 --> Unable to connect to the database
ERROR - 2022-07-06 20:45:04 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Connection refused /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/bonfire/ci3/database/drivers/mysqli/mysqli_driver.php 191
ERROR - 2022-07-06 20:45:04 --> Unable to connect to the database
ERROR - 2022-07-06 20:51:35 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Operation timed out /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/bonfire/ci3/database/drivers/mysqli/mysqli_driver.php 191
ERROR - 2022-07-06 20:51:35 --> Unable to connect to the database
ERROR - 2022-07-06 20:54:46 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Operation timed out /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/bonfire/ci3/database/drivers/mysqli/mysqli_driver.php 191
ERROR - 2022-07-06 20:54:46 --> Unable to connect to the database
ERROR - 2022-07-06 21:04:52 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Operation timed out /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/bonfire/ci3/database/drivers/mysqli/mysqli_driver.php 191
ERROR - 2022-07-06 21:04:52 --> Unable to connect to the database
ERROR - 2022-07-06 21:36:08 --> Severity: Notice --> Undefined index: targetPartnerFeesAmount /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 52
ERROR - 2022-07-06 21:36:08 --> Severity: Warning --> Division by zero /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/libraries/MyMIAnalytics.php 52
ERROR - 2022-07-06 21:36:08 --> Severity: Warning --> number_format() expects parameter 1 to be float, string given /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/modules/Management/views/Partners/index.php 351
ERROR - 2022-07-06 21:36:08 --> Severity: Notice --> Undefined variable: targetPartnerTransFees /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/modules/Management/views/Partners/index.php 352
ERROR - 2022-07-06 21:36:08 --> Severity: Notice --> Undefined variable: targetPartnerTransFees /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/modules/Management/views/Partners/index.php 352
ERROR - 2022-07-06 21:48:35 --> Severity: Warning --> number_format() expects parameter 1 to be float, string given /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/modules/Management/views/Partners/index.php 351
ERROR - 2022-07-06 21:48:35 --> Severity: Notice --> Undefined variable: targetPartnerTransFees /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/modules/Management/views/Partners/index.php 352
ERROR - 2022-07-06 21:48:35 --> Severity: Notice --> Undefined variable: targetPartnerTransFees /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/modules/Management/views/Partners/index.php 352
ERROR - 2022-07-06 21:59:44 --> Severity: Warning --> number_format() expects parameter 1 to be float, string given /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/modules/Management/views/Partners/index.php 351
ERROR - 2022-07-06 21:59:44 --> Severity: Notice --> Undefined variable: targetPartnerTransFees /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/modules/Management/views/Partners/index.php 352
ERROR - 2022-07-06 21:59:44 --> Severity: Notice --> Undefined variable: targetPartnerTransFees /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/modules/Management/views/Partners/index.php 352
ERROR - 2022-07-06 22:00:11 --> Severity: Notice --> Undefined variable: targetPartnerTransFees /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/modules/Management/views/Partners/index.php 352
ERROR - 2022-07-06 22:00:11 --> Severity: Notice --> Undefined variable: targetPartnerTransFees /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/modules/Management/views/Partners/index.php 352
ERROR - 2022-07-06 22:42:33 --> Severity: Notice --> Undefined index: partnerTransAmountPercentage /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/modules/Management/views/Partners/index.php 27
ERROR - 2022-07-06 22:42:33 --> Severity: Notice --> Undefined index: partnerTransFeesPercentage /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/modules/Management/views/Partners/index.php 28
ERROR - 2022-07-06 22:43:14 --> Severity: Notice --> Undefined index: partnerTransAmountPercentage /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/modules/Management/views/Partners/index.php 27
ERROR - 2022-07-06 22:43:14 --> Severity: Notice --> Undefined index: partnerTransFeesPercentage /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/modules/Management/views/Partners/index.php 28
ERROR - 2022-07-06 22:45:28 --> Severity: Notice --> Undefined index: partnerTransAmountPercentage /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/modules/Management/views/Partners/index.php 27
ERROR - 2022-07-06 22:45:28 --> Severity: Notice --> Undefined index: partnerTransFeesPercentage /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/modules/Management/views/Partners/index.php 28
ERROR - 2022-07-06 23:45:25 --> Severity: error --> Exception: Object of class CI_DB_mysqli_result could not be converted to string /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.5/application/modules/Management/views/Web_Design/Content_Creator.php 31
