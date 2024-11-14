<?php
class DATATABLE_SQL{
	static function order ( $request, $columns, $arr_q = array()) {
		$order = '';
		//print_r($columns);
		if ( isset($request['order']) && count($request['order']) ) {
			$orderBy = array();
			for ( $i=0, $ien=count($request['order']) ; $i<$ien ; $i++ ) {
				// Convert the column index into the column data property
				$columnIdx = intval($request['order'][$i]['column']);
				$requestColumn = $request['columns'][$columnIdx];
	
				if ( $requestColumn['orderable'] == 'true' ) {
					if (!in_array($columnIdx, $arr_q)) {
						$dtColumns = self::pluck( $columns, 'db' );
						$columnIdx = array_search( $requestColumn['data'], $dtColumns );
						$column = $columns[ $columnIdx ];
						
						$dir = $request['order'][$i]['dir'] === 'asc' ? 'asc' : 'desc';
		
						$orderBy[] = $column['db'].' '.$dir;
					}
				}
			}
			if (count($orderBy) > 0) $order = 'order by '.implode(', ', $orderBy);
		}
		return $order;
	}
	
	static function pluck ( $a, $prop ) {
		$out = array();
	
		for ( $i=0, $len=count($a) ; $i<$len ; $i++ ) {
			$out[] = $a[$i][$prop];
		}
		return $out;
	}

	static function limit ( $request) {
		$limit = '';
	
		if ( isset($request['start']) && $request['length'] != -1 ) {
			$limit = "limit ".intval($request['start']).", ".intval($request['length']);
		}
		return $limit;
	}
	
	static function filter ( $request, $columns, $arr_q = array()) {
		
		$globalSearch = array();
		$columnSearch = array();
		$dtColumns = self::pluck( $columns, 'db' );

		if ( isset($request['search']) && $request['search']['value'] != '' ) {
			$str = $request['search']['value'];
	
			for ( $i=0, $ien=count($request['columns']) ; $i<$ien ; $i++ ) {
				$requestColumn = $request['columns'][$i];
				$columnIdx = array_search( $requestColumn['data'], $dtColumns );
				$column = $columns[ $columnIdx ];
				
				if ( $requestColumn['searchable'] == 'true' ) {
						
					$binding ="'%".$str."%'";
					
					$arrCol=preg_split('/\./i', $column['db']);
					if(isset($arrCol[1])) $strcolum=$arrCol[0].".".$arrCol[1]."";
					else $strcolum="`".$arrCol[0]."`";
					
					
					$globalSearch[] = " ".$strcolum." like ".$binding;
				}
			}
		}
	
		// Individual column filtering
		for ( $i=0, $ien=count($request['columns']) ; $i<$ien ; $i++ ) {
			
			$requestColumn = $request['columns'][$i];
			$str = $requestColumn['search']['value'];

			if ( $requestColumn['searchable'] == 'true' && $str != '' ) {
				$columnIdx = array_search( $requestColumn['data'], $dtColumns );
				$column = $columns[ $columnIdx ];
		
				$arrCol=preg_split('/\./i', $column['db']);
				if(isset($arrCol[1])) $strcolum=$arrCol[0].".".$arrCol[1]."";
				else $strcolum="`".$arrCol[0]."`";

		
				if (in_array($i, $arr_q)) {
					$columnSearch[] = "  ".$strcolum." = ".$str;
				}else{
					$binding ="'%".$str."%'";
					$columnSearch[] = "  ".$strcolum." like ".$binding;
				}
			}
		}

		// Combine the filters into a single string
		$where = '';
	
		if ( count( $globalSearch ) ) {
			$where = '('.implode(' or ', $globalSearch).')';
		}
	
		if ( count( $columnSearch ) > 0 ) {
			$where = $where === '' ?
			implode(' and ', $columnSearch) :
			$where .' and '. implode(' and ', $columnSearch);
		}
	
		if ( $where !== '' ) {
			$where = ' and '.$where;
		}
		return $where;
	}
/////////////////////////////////////////
} // End Class 
?>