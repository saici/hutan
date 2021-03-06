<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class module_model extends CI_Model {
    function __construct() {
        parent::__construct();
		
        $this->field = array( 'id', 'content', 'sumber_dana', 'periode', 'urutan', 'alias', 'module_type_id' );
    }

    function update($param) {
        $result = array();
       
        if (empty($param['id'])) {
            $insert_query  = GenerateInsertQuery($this->field, $param, MODULE);
            $insert_result = mysql_query($insert_query) or die(mysql_error());
           
            $result['id'] = mysql_insert_id();
            $result['status'] = '1';
            $result['message'] = 'Data berhasil disimpan.';
        } else {
            $update_query  = GenerateUpdateQuery($this->field, $param, MODULE);
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
            $select_query  = "SELECT * FROM ".MODULE." WHERE id = '".$param['id']."' LIMIT 1";
        } else if (isset($param['alias']) && isset($param['module_type_alias'])) {
			$select_query = "
				SELECT SQL_CALC_FOUND_ROWS Module.*,
					ModuleType.name module_type_name, ModuleType.alias module_type_alias
				FROM ".MODULE." Module
				LEFT JOIN ".MODULE_TYPE." ModuleType ON ModuleType.id = Module.module_type_id
				WHERE Module.alias = '".$param['alias']."' AND ModuleType.alias = '".$param['module_type_alias']."'
			";
        }
		
        $select_result = mysql_query($select_query) or die(mysql_error());
        if (false !== $row = mysql_fetch_assoc($select_result)) {
            $array = $this->sync($row);
        }
       
        return $array;
    }
	
    function get_array($param = array()) {
        $array = array();
		
		$string_module_type = (isset($param['module_type_id'])) ? "AND ModuleType.id = '".$param['module_type_id']."'" : '';
		$string_filter = GetStringFilter($param, @$param['column']);
		$string_sorting = GetStringSorting($param, @$param['column'], 'urutan ASC');
		$string_limit = GetStringLimit($param);
		
		$select_query = "
			SELECT SQL_CALC_FOUND_ROWS Module.*,
				ModuleType.name module_type_name, ModuleType.alias module_type_alias
			FROM ".MODULE." Module
			LEFT JOIN ".MODULE_TYPE." ModuleType ON ModuleType.id = Module.module_type_id
			WHERE 1 $string_module_type $string_filter
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
		$delete_query  = "DELETE FROM ".MODULE." WHERE id = '".$param['id']."' LIMIT 1";
		$delete_result = mysql_query($delete_query) or die(mysql_error());
		
		$result['status'] = '1';
		$result['message'] = 'Data berhasil dihapus.';

        return $result;
    }
	
	function sync($row) {
		$row = StripArray($row);
		
		// module info
		if (!empty($row['alias']) && !empty($row['module_type_alias'])) {
			$row['model_name'] = $row['module_type_alias'].'_'.$row['alias'].'_model';
			$row['module_link'] = base_url($row['module_type_alias'].'/'.$row['alias']);
		} else {
			$row['model_name'] = '';
			$row['module_link'] = '#';
		}
		
		return $row;
	}
}