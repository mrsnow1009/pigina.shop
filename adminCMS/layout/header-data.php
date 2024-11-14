<?php 
	$db = new database();

	/* get ten cua nguoi quan tri */	
	$webmtId  = $Session->get("webmtId");
	$webmt_fullname = $db->getField(TBLWEBMASTER, "fullname", "ID", $webmtId);

?>