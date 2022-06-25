<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-06-05 22:45:41 --> Severity: Notice --> Undefined index: total_net_gains /Library/WebServer/Documents/MillennialInvest/Site-v7/v1.4/application/libraries/MyMIWallet.php 313
ERROR - 2022-06-05 22:45:41 --> Query error: Unknown column 'percent_change' in 'field list' - Invalid query: SELECT SUM(`percent_change`) AS `percent_change`
FROM `bf_users_trades`
WHERE `trading_account` = '643'
