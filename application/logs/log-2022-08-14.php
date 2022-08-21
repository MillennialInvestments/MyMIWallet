<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-08-14 03:39:10 --> Severity: error --> Exception: Call to undefined method CI_URI::current_url() /Library/WebServer/Documents/MyMIWallet/v7/v1.5/application/modules/User/controllers/Wallets.php 673
ERROR - 2022-08-14 03:46:08 --> Severity: Notice --> Undefined variable: cuID /Library/WebServer/Documents/MyMIWallet/v7/v1.5/application/modules/User/controllers/Wallets.php 682
ERROR - 2022-08-14 03:46:08 --> Severity: Notice --> Undefined variable: cuID /Library/WebServer/Documents/MyMIWallet/v7/v1.5/application/modules/User/controllers/Wallets.php 684
ERROR - 2022-08-14 03:46:08 --> Query error: Column 'created_by' cannot be null - Invalid query: INSERT INTO `bf_act_logger` (`created_by`, `beta`, `type`, `type_id`, `controller`, `method`, `url`, `full_url`, `token`, `comment`) VALUES (NULL, 'Yes', 'User: Bank Account', 0, 'Wallets', 'Create_Bank_Account', 'Wallets/Connect-Bank-Account', 'http://192.168.0.23/MyMIWallet/v7/v1.5/public/index.php/Wallets/Connect-Bank-Account', 0, 'User () added bank account successfully: Wallets/Connect-Bank-Account')
