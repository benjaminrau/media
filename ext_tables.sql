#
# Table structure for table 'sys_file_storage'
#
CREATE TABLE sys_file_storage (
	mount_point_file_type_1 int(11) unsigned DEFAULT '0' NOT NULL,
	mount_point_file_type_2 int(11) unsigned DEFAULT '0' NOT NULL,
	mount_point_file_type_3 int(11) unsigned DEFAULT '0' NOT NULL,
	mount_point_file_type_4 int(11) unsigned DEFAULT '0' NOT NULL,
	mount_point_file_type_5 int(11) unsigned DEFAULT '0' NOT NULL,
	mount_point_file_type_5 int(11) unsigned DEFAULT '0' NOT NULL,

	maximum_dimension_original_image varchar(24) DEFAULT '' NOT NULL,

	extension_allowed_file_type_1 varchar(255) DEFAULT '' NOT NULL,
	extension_allowed_file_type_2 varchar(255) DEFAULT '' NOT NULL,
	extension_allowed_file_type_3 varchar(255) DEFAULT '' NOT NULL,
	extension_allowed_file_type_4 varchar(255) DEFAULT '' NOT NULL,
	extension_allowed_file_type_5 varchar(255) DEFAULT '' NOT NULL,
);
