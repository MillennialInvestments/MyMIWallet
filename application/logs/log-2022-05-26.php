<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-05-26 03:43:28 --> Severity: Notice --> Undefined index: current_value /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.4/application/modules/User/views/Wallets/Purchase_Coins_Transaction.php 20
ERROR - 2022-05-26 03:43:28 --> Query error: Incorrect integer value: '' for column 'user_id' at row 1 - Invalid query: INSERT INTO `bf_users_coin_purchases` (`unix_timestamp`, `month`, `day`, `year`, `time`, `beta`, `wallet_id`, `user_id`, `user_email`, `coin`, `initial_value`, `current_value`, `available_coins`, `new_availability`, `initial_coin_value`, `new_coin_value`, `amount`, `total`, `total_cost`, `total_fees`, `gas_fee`, `trans_fee`, `trans_percent`, `user_gas_fee`, `user_trans_fee`, `user_trans_percent`) VALUES (1653536608, '5', '26', '2022', '3:43:28', 'Yes', 'DFhiAqX1Ta7Cm4nbyB9QTYcEqJ2No1wLFu', '', 'admin@timothyburks.com', 'MyMIG', NULL, 50, '0', 50, '1', '1', '50', '50', '53.50', '3.50', '', '0.6', '1.058', '0', 0.6, '2.9000000000000057')
ERROR - 2022-05-26 20:44:39 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Network is unreachable /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.4/bonfire/ci3/database/drivers/mysqli/mysqli_driver.php 191
ERROR - 2022-05-26 20:44:39 --> Unable to connect to the database
ERROR - 2022-05-26 15:54:42 --> Severity: Warning --> mysqli::query(): (HY000/2006): MySQL server has gone away /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.4/bonfire/ci3/database/drivers/mysqli/mysqli_driver.php 289
ERROR - 2022-05-26 15:54:42 --> Query error: MySQL server has gone away - Invalid query: SELECT *
FROM `bf_investment_stock_listing`
ORDER BY `symbol`
ERROR - 2022-05-26 15:54:42 --> Query error: MySQL server has gone away - Invalid query: UPDATE `bf_ci3_sessions` SET `timestamp` = 1653598482, `data` = '__ci_last_regenerate|i:1653597920;requested_page|s:71:\"http://localhost/MillennialInvest/Site-v7/v1.4/public/index.php/Wallets\";previous_page|s:95:\"http://localhost/MillennialInvest/Site-v7/v1.4/public/index.php/Wallets/Link-Account/Broker/222\";user_id|s:1:\"2\";auth_custom|s:10:\"tburks2392\";user_token|s:40:\"53289e26f03752b83a65f7469ec42c715972bd2c\";identity|s:10:\"tburks2392\";role_id|s:1:\"1\";logged_in|b:1;allSessionData|a:12:{s:11:\"userAccount\";a:52:{s:4:\"cuID\";s:1:\"2\";s:6:\"cuRole\";s:1:\"1\";s:10:\"cuUserType\";s:4:\"Beta\";s:7:\"cuEmail\";s:22:\"admin@timothyburks.com\";s:10:\"cuUsername\";s:10:\"tburks2392\";s:13:\"cuDisplayName\";s:9:\"Tim Burks\";s:11:\"cuFirstName\";s:7:\"Timothy\";s:12:\"cuMiddleName\";s:1:\"H\";s:10:\"cuLastName\";s:5:\"Burks\";s:12:\"cuNameSuffix\";s:2:\"Jr\";s:5:\"cuKYC\";s:3:\"Yes\";s:7:\"cuPhone\";s:10:\"3185485805\";s:9:\"cuAddress\";s:16:\"2304 Ashland Ave\";s:6:\"cuCity\";s:12:\"Bossier City\";s:7:\"cuState\";s:2:\"LA\";s:9:\"cuCountry\";s:2:\"US\";s:9:\"cuZipCode\";s:5:\"71111\";s:10:\"cuWalletID\";s:34:\"DFhiAqX1Ta7Cm4nbyB9QTYcEqJ2No1wLFu\";s:8:\"walletID\";s:3:\"222\";s:13:\"cuWalletCount\";i:1;s:18:\"cuTotalWalletCount\";i:1;s:17:\"lastTradeActivity\";s:3:\"N/A\";s:15:\"depositActivity\";s:3:\"N/A\";s:16:\"withdrawActivity\";s:3:\"N/A\";s:11:\"walletTitle\";s:10:\"MyMI Funds\";s:12:\"walletBroker\";s:7:\"Default\";s:14:\"walletNickname\";s:10:\"MyMI Funds\";s:13:\"walletDefault\";s:3:\"Yes\";s:14:\"walletExchange\";s:3:\"Yes\";s:16:\"walletMarketPair\";s:3:\"USD\";s:12:\"walletMarket\";s:4:\"MYMI\";s:11:\"walletFunds\";i:200;s:19:\"walletInitialAmount\";i:0;s:12:\"walletAmount\";i:0;s:19:\"walletPercentChange\";d:0;s:11:\"walletGains\";s:4:\"0.00\";s:13:\"depositAmount\";s:3:\"200\";s:14:\"withdrawAmount\";N;s:19:\"walletDepositAmount\";i:0;s:20:\"walletWithdrawAmount\";i:0;s:13:\"MyMICoinValue\";s:11:\"0.000410689\";s:17:\"MyMICCurrentValue\";d:0;s:12:\"MyMICCoinSum\";d:0;s:14:\"coinsExchanged\";s:11:\"34096897.88\";s:13:\"MyMIGoldValue\";N;s:17:\"MyMIGCurrentValue\";d:0;s:12:\"MyMIGCoinSum\";d:0;s:10:\"getWallets\";O:19:\"CI_DB_mysqli_result\":8:{s:7:\"conn_id\";O:6:\"mysqli\":18:{s:13:\"affected_rows\";N;s:11:\"client_info\";N;s:14:\"client_version\";N;s:13:\"connect_errno\";N;s:13:\"connect_error\";N;s:5:\"errno\";N;s:5:\"error\";N;s:10:\"error_list\";N;s:11:\"field_count\";N;s:9:\"host_info\";N;s:4:\"info\";N;s:9:\"insert_id\";N;s:11:\"server_info\";N;s:14:\"server_version\";N;s:8:\"sqlstate\";N;s:16:\"protocol_version\";N;s:9:\"thread_id\";N;s:13:\"warning_count\";N;}s:9:\"result_id\";O:13:\"mysqli_result\":5:{s:13:\"current_field\";N;s:11:\"field_count\";N;s:7:\"lengths\";N;s:8:\"num_rows\";N;s:4:\"type\";N;}s:12:\"result_array\";a:0:{}s:13:\"result_object\";a:0:{}s:20:\"custom_result_object\";a:0:{}s:11:\"current_row\";i:0;s:8:\"num_rows\";N;s:8:\"row_data\";N;}s:15:\"assetTotalCount\";i:1;s:13:\"assetNetValue\";s:8:\"47299.24\";s:15:\"assetTotalGains\";s:9:\"22,299.24\";s:16:\"open_listing_app\";s:2:\"16\";}s:12:\"userCoinData\";a:10:{s:16:\"mymic_coin_value\";s:11:\"0.000410689\";s:10:\"totalValue\";s:5:\"$0.00\";s:7:\"coinSum\";d:0;s:14:\"coinsExchanged\";s:11:\"34096897.88\";s:14:\"myMICPerChange\";s:4:\"0.00\";s:20:\"myMICPerChangeOutput\";s:5:\"0.00%\";s:17:\"myMICInitialValue\";s:4:\"0.00\";s:17:\"myMICCurrentValue\";s:5:\"$0.00\";s:17:\"myMICDifferential\";s:4:\"0.00\";s:23:\"myMICDifferentialOutput\";s:4:\"0.00\";}s:12:\"userGoldData\";a:9:{s:10:\"coin_value\";i:1;s:10:\"totalValue\";s:4:\"0.00\";s:7:\"coinSum\";d:0;s:14:\"myMIGPerChange\";s:5:\"0.00%\";s:20:\"myMIGPerChangeOutput\";s:5:\"0.00%\";s:17:\"myMIGInitialValue\";s:4:\"0.00\";s:17:\"myMIGCurrentValue\";s:4:\"0.00\";s:17:\"myMIGDifferential\";s:4:\"0.00\";s:23:\"myMIGDifferentialOutput\";s:38:\"<span class=\"text-green\">+$0.00</span>\";}s:21:\"userDefaultWalletInfo\";a:25:{s:8:\"walletID\";s:3:\"222\";s:11:\"walletTitle\";s:10:\"MyMI Funds\";s:12:\"walletBroker\";s:7:\"Default\";s:14:\"walletNickname\";s:10:\"MyMI Funds\";s:13:\"walletDefault\";s:3:\"Yes\";s:14:\"walletExchange\";s:3:\"Yes\";s:16:\"walletMarketPair\";s:3:\"USD\";s:12:\"walletMarket\";s:4:\"MYMI\";s:19:\"walletInitialAmount\";i:0;s:12:\"walletAmount\";i:0;s:19:\"walletPercentChange\";d:0;s:11:\"walletGains\";s:4:\"0.00\";s:11:\"walletFunds\";i:200;s:13:\"depositAmount\";s:3:\"200\";s:14:\"withdrawAmount\";N;s:19:\"walletDepositAmount\";i:0;s:20:\"walletWithdrawAmount\";i:0;s:13:\"MyMICoinValue\";s:11:\"0.000410689\";s:17:\"MyMICCurrentValue\";d:0;s:12:\"MyMICCoinSum\";d:0;s:14:\"coinsExchanged\";s:11:\"34096897.88\";s:13:\"MyMIGoldValue\";N;s:17:\"MyMIGCurrentValue\";d:0;s:12:\"MyMIGCoinSum\";d:0;s:10:\"getWallets\";O:19:\"CI_DB_mysqli_result\":8:{s:7:\"conn_id\";r:60;s:9:\"result_id\";O:13:\"mysqli_result\":5:{s:13:\"current_field\";N;s:11:\"field_count\";N;s:7:\"lengths\";N;s:8:\"num_rows\";N;s:4:\"type\";N;}s:12:\"result_array\";a:0:{}s:13:\"result_object\";a:0:{}s:20:\"custom_result_object\";a:0:{}s:11:\"current_row\";i:0;s:8:\"num_rows\";N;s:8:\"row_data\";N;}}s:16:\"userLastActivity\";a:3:{s:17:\"lastTradeActivity\";s:21:\"2022/04/05 - 02:14:51\";s:15:\"depositActivity\";s:27:\"March 29th, 2022 - 01:33 PM\";s:16:\"withdrawActivity\";s:3:\"N/A\";}s:12:\"MyMICoinData\";a:9:{s:15:\"available_coins\";s:11:\"80903102.11\";s:13:\"current_value\";s:8:\"47299.24\";s:13:\"initial_value\";s:5:\"25000\";s:16:\"mymic_coin_value\";s:11:\"0.000410689\";s:16:\"minimum_purchase\";i:5;s:18:\"minimum_coin_value\";N;s:7:\"gas_fee\";s:8:\"0.014914\";s:13:\"trans_percent\";s:5:\"0.058\";s:9:\"trans_fee\";s:4:\"0.60\";}s:12:\"MyMIGoldData\";a:2:{i:0;a:6:{s:13:\"current_value\";s:8:\"47299.24\";s:13:\"initial_value\";s:5:\"33226\";s:16:\"mymig_coin_value\";s:11:\"0.000410689\";s:7:\"gas_fee\";s:8:\"0.007457\";s:13:\"trans_percent\";s:5:\"0.058\";s:9:\"trans_fee\";s:3:\"0.6\";}i:1;a:1:{s:15:\"available_coins\";N;}}s:17:\"myMIWalletSummary\";a:3:{s:9:\"walletSum\";s:7:\"$100.00\";s:10:\"totalValue\";N;s:17:\"myMIGCurrentValue\";d:0;}s:21:\"userWalletOpenSummary\";N;s:22:\"userWalletTotalSummary\";N;s:18:\"exchangeMarketData\";a:0:{}s:13:\"userLastOrder\";a:33:{s:7:\"orderID\";s:3:\"203\";s:14:\"unix_timestamp\";s:10:\"1650432692\";s:12:\"current_date\";s:19:\"2022-04-19 22:31:33\";s:5:\"month\";s:1:\"4\";s:3:\"day\";s:2:\"20\";s:4:\"year\";s:4:\"2022\";s:4:\"time\";s:7:\"5:31:32\";s:6:\"status\";s:10:\"Incomplete\";s:4:\"beta\";s:3:\"Yes\";s:9:\"wallet_id\";s:34:\"DFhiAqX1Ta7Cm4nbyB9QTYcEqJ2No1wLFu\";s:7:\"user_id\";s:1:\"2\";s:10:\"user_email\";s:22:\"admin@timothyburks.com\";s:6:\"reward\";s:2:\"No\";s:11:\"reward_type\";N;s:4:\"coin\";s:5:\"MyMIG\";s:13:\"initial_value\";N;s:13:\"current_value\";s:2:\"10\";s:15:\"available_coins\";s:1:\"0\";s:16:\"new_availability\";s:2:\"10\";s:19:\"minimum_coin_amount\";N;s:18:\"initial_coin_value\";s:1:\"1\";s:14:\"new_coin_value\";s:1:\"1\";s:6:\"amount\";s:2:\"10\";s:5:\"total\";s:2:\"10\";s:10:\"total_cost\";s:5:\"11.18\";s:10:\"total_fees\";s:4:\"1.18\";s:7:\"gas_fee\";s:0:\"\";s:9:\"trans_fee\";s:3:\"0.6\";s:13:\"trans_percent\";s:5:\"1.058\";s:12:\"user_gas_fee\";s:1:\"0\";s:14:\"user_trans_fee\";s:3:\"0.6\";s:18:\"user_trans_percent\";s:18:\"0.5800000000000001\";s:11:\"referral_id\";N;}}'
WHERE `id` = 'co862ro5p0t0aeg82748bdcj1em2hduo'
ERROR - 2022-05-26 15:54:42 --> Severity: Warning --> Unknown: Cannot call session save handler in a recursive manner Unknown 0
ERROR - 2022-05-26 15:54:42 --> Severity: Warning --> Unknown: Failed to write session data using user defined save handler. (session.save_path: ) Unknown 0
ERROR - 2022-05-26 15:54:42 --> Query error: MySQL server has gone away - Invalid query: SELECT RELEASE_LOCK('f3252da8e7f5793cc657aab32fed82ab') AS ci_session_lock
ERROR - 2022-05-26 15:54:42 --> Severity: Warning --> Cannot modify header information - headers already sent /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.4/bonfire/ci3/core/Common.php 529
ERROR - 2022-05-26 23:41:00 --> Severity: Notice --> Undefined index: current_value /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.4/application/modules/User/views/Wallets/Purchase_Coins_Transaction.php 20
ERROR - 2022-05-26 23:41:00 --> Severity: Notice --> Undefined index: redirect_url /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.4/application/modules/User/views/Wallets/Purchase_Coins_Transaction.php 36
ERROR - 2022-05-26 23:41:00 --> Query error: Incorrect integer value: '' for column 'user_id' at row 1 - Invalid query: INSERT INTO `bf_users_coin_purchases` (`unix_timestamp`, `month`, `day`, `year`, `time`, `beta`, `wallet_id`, `user_id`, `user_email`, `coin`, `initial_value`, `current_value`, `available_coins`, `new_availability`, `initial_coin_value`, `new_coin_value`, `amount`, `total`, `total_cost`, `total_fees`, `gas_fee`, `trans_fee`, `trans_percent`, `user_gas_fee`, `user_trans_fee`, `user_trans_percent`) VALUES (1653608460, '5', '26', '2022', '23:41:00', 'Yes', 'DFhiAqX1Ta7Cm4nbyB9QTYcEqJ2No1wLFu', '', 'admin@timothyburks.com', 'MyMIG', NULL, 50, '0', 50, '1', '1', '50', '50', '53.50', '3.50', '', '0.6', '1.058', '0', 0.6, '2.9000000000000057')
ERROR - 2022-05-26 23:45:28 --> Severity: Notice --> Undefined index: current_value /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.4/application/modules/User/views/Wallets/Purchase_Coins_Transaction.php 20
ERROR - 2022-05-26 23:45:28 --> Severity: Notice --> Undefined index: redirect_url /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.4/application/modules/User/views/Wallets/Purchase_Coins_Transaction.php 36
ERROR - 2022-05-26 23:45:28 --> Query error: Incorrect integer value: '' for column 'user_id' at row 1 - Invalid query: INSERT INTO `bf_users_coin_purchases` (`unix_timestamp`, `month`, `day`, `year`, `time`, `beta`, `wallet_id`, `user_id`, `user_email`, `coin`, `initial_value`, `current_value`, `available_coins`, `new_availability`, `initial_coin_value`, `new_coin_value`, `amount`, `total`, `total_cost`, `total_fees`, `gas_fee`, `trans_fee`, `trans_percent`, `user_gas_fee`, `user_trans_fee`, `user_trans_percent`, `redirect_url`) VALUES (1653608728, '5', '26', '2022', '23:45:28', 'Yes', 'DFhiAqX1Ta7Cm4nbyB9QTYcEqJ2No1wLFu', '', 'admin@timothyburks.com', 'MyMIG', NULL, 50, '0', 50, '1', '1', '50', '50', '53.50', '3.50', '', '0.6', '1.058', '0', 0.6, '2.9000000000000057', NULL)
ERROR - 2022-05-26 23:45:34 --> Severity: Notice --> Trying to access array offset on value of type null /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.4/application/modules/User/views/Wallets/Complete_Purchase.php 2
ERROR - 2022-05-26 23:45:34 --> Severity: Notice --> Trying to access array offset on value of type null /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.4/application/modules/User/views/Wallets/Complete_Purchase.php 3
ERROR - 2022-05-26 23:45:34 --> Severity: Notice --> Trying to access array offset on value of type null /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.4/application/modules/User/views/Wallets/Complete_Purchase.php 4
ERROR - 2022-05-26 23:45:34 --> Severity: Notice --> Trying to access array offset on value of type null /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.4/application/modules/User/views/Wallets/Complete_Purchase.php 5
ERROR - 2022-05-26 23:45:34 --> Severity: Notice --> Trying to access array offset on value of type null /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.4/application/modules/User/views/Wallets/Complete_Purchase.php 6
ERROR - 2022-05-26 23:45:34 --> Severity: Notice --> Trying to access array offset on value of type null /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.4/application/modules/User/views/Wallets/Complete_Purchase.php 7
ERROR - 2022-05-26 23:50:39 --> Severity: Notice --> Undefined index: redirect_url /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.4/application/modules/User/views/Wallets/Purchase_Coins_Transaction.php 36
ERROR - 2022-05-26 23:50:39 --> Query error: Incorrect integer value: '' for column 'user_id' at row 1 - Invalid query: INSERT INTO `bf_users_coin_purchases` (`unix_timestamp`, `month`, `day`, `year`, `time`, `beta`, `wallet_id`, `user_id`, `user_email`, `coin`, `initial_value`, `current_value`, `available_coins`, `new_availability`, `initial_coin_value`, `new_coin_value`, `amount`, `total`, `total_cost`, `total_fees`, `gas_fee`, `trans_fee`, `trans_percent`, `user_gas_fee`, `user_trans_fee`, `user_trans_percent`, `redirect_url`) VALUES (1653609039, '5', '26', '2022', '23:50:39', 'Yes', 'DFhiAqX1Ta7Cm4nbyB9QTYcEqJ2No1wLFu', '', 'admin@timothyburks.com', 'MyMIG', '0.00', 50, '0', 50, '1', '1', '50', '50', '53.50', '3.50', '', '0.6', '1.058', '0', 0.6, '2.9000000000000057', NULL)
ERROR - 2022-05-26 23:50:46 --> Severity: Notice --> Trying to access array offset on value of type null /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.4/application/modules/User/views/Wallets/Complete_Purchase.php 2
ERROR - 2022-05-26 23:50:46 --> Severity: Notice --> Trying to access array offset on value of type null /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.4/application/modules/User/views/Wallets/Complete_Purchase.php 3
ERROR - 2022-05-26 23:50:46 --> Severity: Notice --> Trying to access array offset on value of type null /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.4/application/modules/User/views/Wallets/Complete_Purchase.php 4
ERROR - 2022-05-26 23:50:46 --> Severity: Notice --> Trying to access array offset on value of type null /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.4/application/modules/User/views/Wallets/Complete_Purchase.php 5
ERROR - 2022-05-26 23:50:46 --> Severity: Notice --> Trying to access array offset on value of type null /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.4/application/modules/User/views/Wallets/Complete_Purchase.php 6
ERROR - 2022-05-26 23:50:46 --> Severity: Notice --> Trying to access array offset on value of type null /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.4/application/modules/User/views/Wallets/Complete_Purchase.php 7
ERROR - 2022-05-26 23:57:24 --> Severity: Notice --> Undefined index: redirect_url /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.4/application/modules/User/views/Wallets/Purchase_Coins_Transaction.php 36
ERROR - 2022-05-26 23:57:24 --> Severity: Notice --> Undefined variable: coin_value /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.4/application/modules/User/views/Wallets/Purchase_Coins_Transaction.php 85
ERROR - 2022-05-26 23:57:41 --> Severity: Notice --> Undefined index: redirect_url /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.4/application/modules/User/views/Wallets/Purchase_Coins_Transaction.php 36
ERROR - 2022-05-26 23:57:41 --> Severity: Notice --> Undefined variable: coin_value /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.4/application/modules/User/views/Wallets/Purchase_Coins_Transaction.php 85
ERROR - 2022-05-26 23:59:57 --> Severity: Notice --> Undefined variable: coin_value /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.4/application/modules/User/views/Wallets/Purchase_Coins_Transaction.php 85
