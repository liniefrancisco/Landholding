<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-02-21 07:32:46 --> Severity: Notice --> Undefined variable: count_pending_ca C:\xampp2\htdocs\landholding\application\views\3A\home.php 94
ERROR - 2024-02-21 07:32:46 --> Severity: Notice --> Undefined variable: count_pending_full C:\xampp2\htdocs\landholding\application\views\3A\home.php 108
ERROR - 2024-02-21 07:33:21 --> Severity: Notice --> Undefined variable: count_pending_ca C:\xampp2\htdocs\landholding\application\views\3A\home.php 94
ERROR - 2024-02-21 07:33:21 --> Severity: Notice --> Undefined variable: count_pending_full C:\xampp2\htdocs\landholding\application\views\3A\home.php 108
ERROR - 2024-02-21 08:10:07 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '.*, `tbl_2`.*, `tbl_3`.*, `tbl_4`.*
FROM `land_info` as `tbl_1`
LEFT JOIN `lot_l' at line 1 - Invalid query: SELECT `tbl_1`.`is_no` as `land_is_no`, `tbl_1`.`prepared_by` as `prepared_by_info`, `tbl_1`.`approved_by` as `li_app`, `tbl_1`.`disapproved_by` as `li_disapp`, `tbl_1`.`date_dissap` as `dis_ap_date tbl_1`.*, `tbl_2`.*, `tbl_3`.*, `tbl_4`.*
FROM `land_info` as `tbl_1`
LEFT JOIN `lot_location` as `tbl_2` ON `tbl_1`.`is_no` = `tbl_2`.`is_no`
LEFT JOIN `owner_info` as `tbl_3` ON `tbl_1`.`is_no` = `tbl_3`.`is_no`
LEFT JOIN `uploaded_documents` as `tbl_4` ON `tbl_1`.`is_no` = `tbl_4`.`is_no`
WHERE `tbl_1`.`status` = 'Disapproved'
AND `tbl_1`.`tag` = 'New LAPF-ES'
ORDER BY `tbl_1`.`is_no` DESC
 LIMIT 10
ERROR - 2024-02-21 08:10:13 --> 404 Page Not Found: Assets/import
ERROR - 2024-02-21 08:10:15 --> 404 Page Not Found: Assets/import
ERROR - 2024-02-21 08:10:16 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '.*, `tbl_2`.*, `tbl_3`.*, `tbl_4`.*
FROM `land_info` as `tbl_1`
LEFT JOIN `lot_l' at line 1 - Invalid query: SELECT `tbl_1`.`is_no` as `land_is_no`, `tbl_1`.`prepared_by` as `prepared_by_info`, `tbl_1`.`approved_by` as `li_app`, `tbl_1`.`disapproved_by` as `li_disapp`, `tbl_1`.`date_dissap` as `dis_ap_date tbl_1`.*, `tbl_2`.*, `tbl_3`.*, `tbl_4`.*
FROM `land_info` as `tbl_1`
LEFT JOIN `lot_location` as `tbl_2` ON `tbl_1`.`is_no` = `tbl_2`.`is_no`
LEFT JOIN `owner_info` as `tbl_3` ON `tbl_1`.`is_no` = `tbl_3`.`is_no`
LEFT JOIN `uploaded_documents` as `tbl_4` ON `tbl_1`.`is_no` = `tbl_4`.`is_no`
WHERE `tbl_1`.`status` = 'Disapproved'
AND `tbl_1`.`tag` = 'New LAPF-ES'
ORDER BY `tbl_1`.`is_no` DESC
 LIMIT 10
ERROR - 2024-02-21 08:10:36 --> 404 Page Not Found: Assets/import
ERROR - 2024-02-21 08:10:36 --> Query error: Unknown column 'tbl_1.date_dissap' in 'field list' - Invalid query: SELECT `tbl_1`.`is_no` as `land_is_no`, `tbl_1`.`prepared_by` as `prepared_by_info`, `tbl_1`.`approved_by` as `li_app`, `tbl_1`.`disapproved_by` as `li_disapp`, `tbl_1`.`date_dissap` as `dis_ap_date`, `tbl_1`.*, `tbl_2`.*, `tbl_3`.*, `tbl_4`.*
FROM `land_info` as `tbl_1`
LEFT JOIN `lot_location` as `tbl_2` ON `tbl_1`.`is_no` = `tbl_2`.`is_no`
LEFT JOIN `owner_info` as `tbl_3` ON `tbl_1`.`is_no` = `tbl_3`.`is_no`
LEFT JOIN `uploaded_documents` as `tbl_4` ON `tbl_1`.`is_no` = `tbl_4`.`is_no`
WHERE `tbl_1`.`status` = 'Disapproved'
AND `tbl_1`.`tag` = 'New LAPF-ES'
ORDER BY `tbl_1`.`is_no` DESC
 LIMIT 10
ERROR - 2024-02-21 08:11:09 --> 404 Page Not Found: Assets/import
ERROR - 2024-02-21 08:11:09 --> Query error: Unknown column 'tbl_1.date_disaproved' in 'field list' - Invalid query: SELECT `tbl_1`.`is_no` as `land_is_no`, `tbl_1`.`prepared_by` as `prepared_by_info`, `tbl_1`.`approved_by` as `li_app`, `tbl_1`.`disapproved_by` as `li_disapp`, `tbl_1`.`date_disaproved` as `dis_ap_date`, `tbl_1`.*, `tbl_2`.*, `tbl_3`.*, `tbl_4`.*
FROM `land_info` as `tbl_1`
LEFT JOIN `lot_location` as `tbl_2` ON `tbl_1`.`is_no` = `tbl_2`.`is_no`
LEFT JOIN `owner_info` as `tbl_3` ON `tbl_1`.`is_no` = `tbl_3`.`is_no`
LEFT JOIN `uploaded_documents` as `tbl_4` ON `tbl_1`.`is_no` = `tbl_4`.`is_no`
WHERE `tbl_1`.`status` = 'Disapproved'
AND `tbl_1`.`tag` = 'New LAPF-ES'
ORDER BY `tbl_1`.`is_no` DESC
 LIMIT 10
ERROR - 2024-02-21 08:11:49 --> 404 Page Not Found: Assets/import
ERROR - 2024-02-21 08:11:53 --> 404 Page Not Found: Assets/import
ERROR - 2024-02-21 08:16:18 --> Severity: Notice --> Undefined variable: all_notifications C:\xampp2\htdocs\landholding\application\views\templates\bar.php 298
ERROR - 2024-02-21 08:16:18 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp2\htdocs\landholding\application\views\templates\bar.php 298
ERROR - 2024-02-21 08:16:18 --> Severity: Notice --> Undefined variable: all_notification_no C:\xampp2\htdocs\landholding\application\views\templates\bar.php 342
ERROR - 2024-02-21 08:16:29 --> 404 Page Not Found: Assets/import
ERROR - 2024-02-21 08:16:33 --> 404 Page Not Found: Assets/import
ERROR - 2024-02-21 08:20:17 --> 404 Page Not Found: Assets/import
