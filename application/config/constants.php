<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

define('SHA_SECRET',							'OraNgerti');

define('MODULE',								'module');
define('MODULE_TYPE',							'module_type');
define('ODTWA',									'odtwa');
define('USER',									'user');
define('USER_TYPE',								'user_type');

/*   USER TYPE   */
define('USER_TYPE_ADMINISTRATOR',				1);

/*   PPH   */
define('PPH_TABLE_01',							'pph_table_01');
define('PPH_TABLE_02',							'pph_table_02');
define('PPH_TABLE_03',							'pph_table_03');
define('PPH_TABLE_04',							'pph_table_04');
define('PPH_TABLE_05',							'pph_table_05');
define('PPH_TABLE_06',							'pph_table_06');
define('PPH_TABLE_07',							'pph_table_07');
define('PPH_TABLE_08',							'pph_table_08');
define('PPH_TABLE_09',							'pph_table_09');
define('PPH_TABLE_10',							'pph_table_10');
define('PPH_TABLE_11',							'pph_table_11');
define('PPH_TABLE_12',							'pph_table_12');
define('PPH_TABLE_13',							'pph_table_13');
define('PPH_TABLE_14',							'pph_table_14');
define('PPH_TABLE_15',							'pph_table_15');
define('PPH_TABLE_16',							'pph_table_16');

/*   PKH   */
define('PKH_TABLE_01',							'pkh_table_01');
define('PKH_TABLE_02',							'pkh_table_02');
define('PKH_TABLE_03',							'pkh_table_03');
define('PKH_TABLE_04',							'pkh_table_04');
define('PKH_TABLE_05',							'pkh_table_05');
define('PKH_TABLE_06',							'pkh_table_06');
define('PKH_TABLE_07',							'pkh_table_07');
define('PKH_TABLE_08',							'pkh_table_08');
define('PKH_TABLE_09',							'pkh_table_09');
define('PKH_TABLE_10',							'pkh_table_10');
define('PKH_TABLE_11',							'pkh_table_11');
define('PKH_TABLE_12',							'pkh_table_12');
define('PKH_TABLE_13',							'pkh_table_13');
define('PKH_TABLE_14',							'pkh_table_14');
define('PKH_TABLE_15',							'pkh_table_15');

define('KKH_TABLE_01',							'kkh_table_01');

/*   KKBHL   */
define('KKBHL_TABLE_01',						'kkbhl_table_01');
define('KKBHL_TABLE_02',						'kkbhl_table_02');
define('KKBHL_TABLE_03',						'kkbhl_table_03');
define('KKBHL_TABLE_04',						'kkbhl_table_04');
define('KKBHL_TABLE_05',						'kkbhl_table_05');
define('KKBHL_TABLE_06',						'kkbhl_table_06');
define('KKBHL_TABLE_07',						'kkbhl_table_07');
define('KKBHL_TABLE_08',						'kkbhl_table_08');
define('KKBHL_TABLE_09',						'kkbhl_table_09');
define('KKBHL_TABLE_10',						'kkbhl_table_10');
define('KKBHL_TABLE_11',						'kkbhl_table_11');
define('KKBHL_TABLE_12',						'kkbhl_table_12');

/*   KKBHL   */
define('SEKRETARIAT_TABLE_01',					'sekretariat_table_01');
define('SEKRETARIAT_TABLE_02',					'sekretariat_table_02');
define('SEKRETARIAT_TABLE_03',					'sekretariat_table_03');
define('SEKRETARIAT_TABLE_04',					'sekretariat_table_04');
define('SEKRETARIAT_TABLE_05',					'sekretariat_table_05');
define('SEKRETARIAT_TABLE_06',					'sekretariat_table_06');
define('SEKRETARIAT_TABLE_07',					'sekretariat_table_07');
define('SEKRETARIAT_TABLE_08',					'sekretariat_table_08');
define('SEKRETARIAT_TABLE_09',					'sekretariat_table_09');
define('SEKRETARIAT_TABLE_10',					'sekretariat_table_10');
define('SEKRETARIAT_TABLE_11',					'sekretariat_table_11');
define('SEKRETARIAT_TABLE_12',					'sekretariat_table_12');
define('SEKRETARIAT_TABLE_13',					'sekretariat_table_13');
define('SEKRETARIAT_TABLE_14',					'sekretariat_table_14');
define('SEKRETARIAT_TABLE_15',					'sekretariat_table_15');
define('SEKRETARIAT_TABLE_16',					'sekretariat_table_16');

/*   PJLKKHL   */
define('PJLKKHL_TABLE_01',						'pjlkkhl_table_01');
define('PJLKKHL_TABLE_02',						'pjlkkhl_table_02');
define('PJLKKHL_TABLE_03',						'pjlkkhl_table_03');
define('PJLKKHL_TABLE_04',						'pjlkkhl_table_04');
define('PJLKKHL_TABLE_05',						'pjlkkhl_table_05');
define('PJLKKHL_TABLE_06',						'pjlkkhl_table_06');
define('PJLKKHL_TABLE_07',						'pjlkkhl_table_07');
define('PJLKKHL_TABLE_08',						'pjlkkhl_table_08');
define('PJLKKHL_TABLE_09',						'pjlkkhl_table_09');
define('PJLKKHL_TABLE_10',						'pjlkkhl_table_10');
define('PJLKKHL_TABLE_11',						'pjlkkhl_table_11');
define('PJLKKHL_TABLE_12',						'pjlkkhl_table_12');
define('PJLKKHL_TABLE_13',						'pjlkkhl_table_13');
define('PJLKKHL_TABLE_14',						'pjlkkhl_table_14');
define('PJLKKHL_TABLE_15',						'pjlkkhl_table_15');
define('PJLKKHL_TABLE_16',						'pjlkkhl_table_16');