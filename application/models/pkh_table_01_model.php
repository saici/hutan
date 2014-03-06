<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pkh_table_01_model extends CI_Model {
    function __construct() {
        parent::__construct();
		
        $this->field = array(
			'id', 'tanggal_kebakaran', 'lintang', 'bujur', 'lokasi', 'hutan_sm', 'hutan_ca', 'hutan_tn', 'hutan_thr', 'hutan_twa', 'hutan_tb', 'hutan_hl', 'hutan_hti',
			'hutan_ha', 'hutan_htr', 'hutan_terbakar', 'kerugian', 'luas_lain', 'update_time'
		);
    }
	
    function update($param) {
        $result = array();
       
        if (empty($param['id'])) {
            $insert_query  = GenerateInsertQuery($this->field, $param, PKH_TABLE_01);
            $insert_result = mysql_query($insert_query) or die(mysql_error());
           
            $result['id'] = mysql_insert_id();
            $result['status'] = '1';
            $result['message'] = 'Data berhasil disimpan.';
        } else {
            $update_query  = GenerateUpdateQuery($this->field, $param, PKH_TABLE_01);
            $update_result = mysql_query($update_query) or die(mysql_error());
           
            $result['id'] = $param['id'];
            $result['status'] = '1';
            $result['message'] = 'Data berhasil diperbaharui.';
        }
       
        return $result;
    }

    function get_by_id($param) {
        $array = array();
       
        if (isset($param['id'])) {
            $select_query  = "SELECT * FROM ".PKH_TABLE_01." WHERE id = '".$param['id']."' LIMIT 1";
        }
		
        $select_result = mysql_query($select_query) or die(mysql_error());
        if (false !== $row = mysql_fetch_assoc($select_result)) {
            $array = $this->sync($row);
        }
       
        return $array;
    }
	
    function get_array($param = array()) {
        $array = array();
		
		$string_jenis = (isset($param['jenis'])) ? "AND jenis = '".$param['jenis']."'" : '';
		$string_filter = GetStringFilter($param, @$param['column']);
		$string_sorting = GetStringSorting($param, @$param['column'], 'update_time ASC');
		$string_limit = GetStringLimit($param);
		
		$select_query = "
			SELECT SQL_CALC_FOUND_ROWS *
			FROM ".PKH_TABLE_01."
			WHERE 1 $string_jenis $string_filter
			ORDER BY $string_sorting
			LIMIT $string_limit
		";
        $select_result = mysql_query($select_query) or die(mysql_error());
		while ( $row = mysql_fetch_assoc( $select_result ) ) {
			$array[] = $this->sync($row);
		}
		
        return $array;
    }

    function get_count($param = array()) {
		$select_query = "SELECT FOUND_ROWS() TotalRecord";
		$select_result = mysql_query($select_query) or die(mysql_error());
		$row = mysql_fetch_assoc($select_result);
		$TotalRecord = $row['TotalRecord'];
		
		return $TotalRecord;
    }
	
    function delete($param) {
		$delete_query  = "DELETE FROM ".PKH_TABLE_01." WHERE id = '".$param['id']."' LIMIT 1";
		$delete_result = mysql_query($delete_query) or die(mysql_error());
		
		$result['status'] = '1';
		$result['message'] = 'Data berhasil dihapus.';

        return $result;
    }
	
	function sync($row) {
		$row = StripArray($row);
		
		$row['total_produksi'] = $row['hutan_hti'] + $row['hutan_ha'] + $row['hutan_htr'];
		$row['total_konservasi'] = $row['hutan_sm'] + $row['hutan_ca'] + $row['hutan_tn'] + $row['hutan_thr'] + $row['hutan_twa'] + $row['hutan_tb'];
		
		return $row;
	}
}