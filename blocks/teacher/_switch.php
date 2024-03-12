<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$output= array();
$output['config']=$config;
$sql = 'ORDER BY ';
switch(@$config['orderby'])
{
	case '2': $sql .= '`id` DESC';break;
	case '3': $sql .= '`id` ASC';break;
	default	: $sql .= 'RAND()';break;
}
$sql .= ' LIMIT '.@intval($config['limit']);
$q = "SELECT * FROM school_teacher ".$sql;
$r_list = $db->getAll($q);
if($db->Affected_rows())
{
	foreach((array)$r_list AS $data)
	{
		if (!empty($data['name'])) {	
			// pr($data, __FILE__.':'.__LINE__);
			$output['data'][]= array(
				'image'    => $data['image'],
				'name'    => $data['name'],
				'position' => $data['position']
			);
		}
}
}
include tpl(@$config['template'].'.html.php', 'default.html.php');