<?php
if (!pdo_fieldexists('lywywl_ztb_obj_soliciting', 'is_open_appad')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_soliciting') . " ADD COLUMN `is_open_appad` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if (!pdo_fieldexists('lywywl_ztb_obj_soliciting', 'appad_password')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_soliciting') . " ADD COLUMN `appad_password` varchar(50) NOT NULL DEFAULT '';");
}
if (!pdo_fieldexists('lywywl_ztb_obj_soliciting', 'appad_types')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_soliciting') . " ADD COLUMN `appad_types` varchar(10) NOT NULL;");
}

if (!pdo_fieldexists('lywywl_ztb_obj_9box', 'is_open_appad')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_9box') . " ADD COLUMN `is_open_appad` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if (!pdo_fieldexists('lywywl_ztb_obj_9box', 'appad_password')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_9box') . " ADD COLUMN `appad_password` varchar(50) NOT NULL DEFAULT '';");
}
if (!pdo_fieldexists('lywywl_ztb_obj_9box', 'appad_types')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_9box') . " ADD COLUMN `appad_types` varchar(10) NOT NULL;");
}

if (!pdo_fieldexists('lywywl_ztb_obj_bag', 'is_open_appad')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_bag') . " ADD COLUMN `is_open_appad` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if (!pdo_fieldexists('lywywl_ztb_obj_bag', 'appad_password')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_bag') . " ADD COLUMN `appad_password` varchar(50) NOT NULL DEFAULT '';");
}
if (!pdo_fieldexists('lywywl_ztb_obj_bag', 'appad_types')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_bag') . " ADD COLUMN `appad_types` varchar(10) NOT NULL;");
}

if (!pdo_fieldexists('lywywl_ztb_obj_collage', 'is_open_appad')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_collage') . " ADD COLUMN `is_open_appad` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if (!pdo_fieldexists('lywywl_ztb_obj_collage', 'appad_password')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_collage') . " ADD COLUMN `appad_password` varchar(50) NOT NULL DEFAULT '';");
}
if (!pdo_fieldexists('lywywl_ztb_obj_collage', 'appad_types')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_collage') . " ADD COLUMN `appad_types` varchar(10) NOT NULL;");
}

if (!pdo_fieldexists('lywywl_ztb_obj_cut', 'is_open_appad')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_cut') . " ADD COLUMN `is_open_appad` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if (!pdo_fieldexists('lywywl_ztb_obj_cut', 'appad_password')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_cut') . " ADD COLUMN `appad_password` varchar(50) NOT NULL DEFAULT '';");
}
if (!pdo_fieldexists('lywywl_ztb_obj_cut', 'appad_types')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_cut') . " ADD COLUMN `appad_types` varchar(10) NOT NULL;");
}

if (!pdo_fieldexists('lywywl_ztb_obj_eggs', 'is_open_appad')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_eggs') . " ADD COLUMN `is_open_appad` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if (!pdo_fieldexists('lywywl_ztb_obj_eggs', 'appad_password')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_eggs') . " ADD COLUMN `appad_password` varchar(50) NOT NULL DEFAULT '';");
}
if (!pdo_fieldexists('lywywl_ztb_obj_eggs', 'appad_types')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_eggs') . " ADD COLUMN `appad_types` varchar(10) NOT NULL;");
}

if (!pdo_fieldexists('lywywl_ztb_obj_enroll', 'is_open_appad')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_enroll') . " ADD COLUMN `is_open_appad` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if (!pdo_fieldexists('lywywl_ztb_obj_enroll', 'appad_password')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_enroll') . " ADD COLUMN `appad_password` varchar(50) NOT NULL DEFAULT '';");
}
if (!pdo_fieldexists('lywywl_ztb_obj_enroll', 'appad_types')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_enroll') . " ADD COLUMN `appad_types` varchar(10) NOT NULL;");
}

if (!pdo_fieldexists('lywywl_ztb_obj_fish', 'is_open_appad')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_fish') . " ADD COLUMN `is_open_appad` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if (!pdo_fieldexists('lywywl_ztb_obj_fish', 'appad_password')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_fish') . " ADD COLUMN `appad_password` varchar(50) NOT NULL DEFAULT '';");
}
if (!pdo_fieldexists('lywywl_ztb_obj_fish', 'appad_types')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_fish') . " ADD COLUMN `appad_types` varchar(10) NOT NULL;");
}

if (!pdo_fieldexists('lywywl_ztb_obj_ladder', 'is_open_appad')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_ladder') . " ADD COLUMN `is_open_appad` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if (!pdo_fieldexists('lywywl_ztb_obj_ladder', 'appad_password')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_ladder') . " ADD COLUMN `appad_password` varchar(50) NOT NULL DEFAULT '';");
}
if (!pdo_fieldexists('lywywl_ztb_obj_ladder', 'appad_types')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_ladder') . " ADD COLUMN `appad_types` varchar(10) NOT NULL;");
}

if (!pdo_fieldexists('lywywl_ztb_obj_opencard', 'is_open_appad')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_opencard') . " ADD COLUMN `is_open_appad` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if (!pdo_fieldexists('lywywl_ztb_obj_opencard', 'appad_password')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_opencard') . " ADD COLUMN `appad_password` varchar(50) NOT NULL DEFAULT '';");
}
if (!pdo_fieldexists('lywywl_ztb_obj_opencard', 'appad_types')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_opencard') . " ADD COLUMN `appad_types` varchar(10) NOT NULL;");
}

if (!pdo_fieldexists('lywywl_ztb_obj_poker', 'is_open_appad')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_poker') . " ADD COLUMN `is_open_appad` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if (!pdo_fieldexists('lywywl_ztb_obj_poker', 'appad_password')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_poker') . " ADD COLUMN `appad_password` varchar(50) NOT NULL DEFAULT '';");
}
if (!pdo_fieldexists('lywywl_ztb_obj_poker', 'appad_types')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_poker') . " ADD COLUMN `appad_types` varchar(10) NOT NULL;");
}

if (!pdo_fieldexists('lywywl_ztb_obj_praise', 'is_open_appad')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_praise') . " ADD COLUMN `is_open_appad` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if (!pdo_fieldexists('lywywl_ztb_obj_praise', 'appad_password')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_praise') . " ADD COLUMN `appad_password` varchar(50) NOT NULL DEFAULT '';");
}
if (!pdo_fieldexists('lywywl_ztb_obj_praise', 'appad_types')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_praise') . " ADD COLUMN `appad_types` varchar(10) NOT NULL;");
}

if (!pdo_fieldexists('lywywl_ztb_obj_scratch', 'is_open_appad')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_scratch') . " ADD COLUMN `is_open_appad` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if (!pdo_fieldexists('lywywl_ztb_obj_scratch', 'appad_password')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_scratch') . " ADD COLUMN `appad_password` varchar(50) NOT NULL DEFAULT '';");
}
if (!pdo_fieldexists('lywywl_ztb_obj_scratch', 'appad_types')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_scratch') . " ADD COLUMN `appad_types` varchar(10) NOT NULL;");
}

if (!pdo_fieldexists('lywywl_ztb_obj_shake', 'is_open_appad')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_shake') . " ADD COLUMN `is_open_appad` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if (!pdo_fieldexists('lywywl_ztb_obj_shake', 'appad_password')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_shake') . " ADD COLUMN `appad_password` varchar(50) NOT NULL DEFAULT '';");
}
if (!pdo_fieldexists('lywywl_ztb_obj_shake', 'appad_types')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_shake') . " ADD COLUMN `appad_types` varchar(10) NOT NULL;");
}

if (!pdo_fieldexists('lywywl_ztb_obj_survey', 'is_open_appad')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_survey') . " ADD COLUMN `is_open_appad` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if (!pdo_fieldexists('lywywl_ztb_obj_survey', 'appad_password')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_survey') . " ADD COLUMN `appad_password` varchar(50) NOT NULL DEFAULT '';");
}
if (!pdo_fieldexists('lywywl_ztb_obj_survey', 'appad_types')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_survey') . " ADD COLUMN `appad_types` varchar(10) NOT NULL;");
}

if (!pdo_fieldexists('lywywl_ztb_obj_tiger', 'is_open_appad')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_tiger') . " ADD COLUMN `is_open_appad` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if (!pdo_fieldexists('lywywl_ztb_obj_tiger', 'appad_password')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_tiger') . " ADD COLUMN `appad_password` varchar(50) NOT NULL DEFAULT '';");
}
if (!pdo_fieldexists('lywywl_ztb_obj_tiger', 'appad_types')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_tiger') . " ADD COLUMN `appad_types` varchar(10) NOT NULL;");
}

if (!pdo_fieldexists('lywywl_ztb_obj_union', 'is_open_appad')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_union') . " ADD COLUMN `is_open_appad` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if (!pdo_fieldexists('lywywl_ztb_obj_union', 'appad_password')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_union') . " ADD COLUMN `appad_password` varchar(50) NOT NULL DEFAULT '';");
}
if (!pdo_fieldexists('lywywl_ztb_obj_union', 'appad_types')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_union') . " ADD COLUMN `appad_types` varchar(10) NOT NULL;");
}

if (!pdo_fieldexists('lywywl_ztb_obj_vote', 'is_open_appad')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_vote') . " ADD COLUMN `is_open_appad` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if (!pdo_fieldexists('lywywl_ztb_obj_vote', 'appad_password')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_vote') . " ADD COLUMN `appad_password` varchar(50) NOT NULL DEFAULT '';");
}
if (!pdo_fieldexists('lywywl_ztb_obj_vote', 'appad_types')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_vote') . " ADD COLUMN `appad_types` varchar(10) NOT NULL;");
}

if (!pdo_fieldexists('lywywl_ztb_obj_wheel', 'is_open_appad')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_wheel') . " ADD COLUMN `is_open_appad` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if (!pdo_fieldexists('lywywl_ztb_obj_wheel', 'appad_password')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_wheel') . " ADD COLUMN `appad_password` varchar(50) NOT NULL DEFAULT '';");
}
if (!pdo_fieldexists('lywywl_ztb_obj_wheel', 'appad_types')) {
	pdo_query("ALTER TABLE " . tablename('lywywl_ztb_obj_wheel') . " ADD COLUMN `appad_types` varchar(10) NOT NULL;");
}
?>