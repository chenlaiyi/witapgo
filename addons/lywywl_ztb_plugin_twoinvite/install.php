<?php
if (!pdo_fieldexists('lywywl_ztb_obj_soliciting', 'or_open_rebate2')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_soliciting') . " ADD COLUMN `or_open_rebate2` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0';");
}
if (!pdo_fieldexists('lywywl_ztb_obj_union', 'or_open_rebate2')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_union') . " ADD COLUMN `or_open_rebate2` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0';");
}
if (!pdo_fieldexists('lywywl_ztb_obj_cut', 'or_open_rebate2')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_cut') . " ADD COLUMN `or_open_rebate2` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0';");
}
if (!pdo_fieldexists('lywywl_ztb_obj_enroll', 'or_open_rebate2')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_enroll') . " ADD COLUMN `or_open_rebate2` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0';");
}
if (!pdo_fieldexists('lywywl_ztb_obj_collage', 'or_open_rebate2')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_collage') . " ADD COLUMN `or_open_rebate2` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0';");
}
if (!pdo_fieldexists('lywywl_ztb_obj_ladder', 'or_open_rebate2')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_ladder') . " ADD COLUMN `or_open_rebate2` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0';");
}

if (!pdo_fieldexists('lywywl_ztb_obj_prize', 'or_rebate2')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_prize') . " ADD COLUMN `or_rebate2` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0';");
}
if (!pdo_fieldexists('lywywl_ztb_user_draw', 'or_rebate2')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_user_draw') . " ADD COLUMN `or_rebate2` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0';");
}
?>