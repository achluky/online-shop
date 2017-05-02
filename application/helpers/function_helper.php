<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('debug'))
{
	function debug($var)
	{
        echo "<pre/>";
        var_dump($var);
        die();
	}
}

if ( ! function_exists('getemail'))
{
	function getemail($id)
	{
	    /*$Ci =& get_instance();
	    $sql = "SELECT email FROM tbl_customers WHERE CustomerID = ".$id."";
	    $rst = $Ci->db->query($sql);
	    if ($rst->num_rows()>0) {	
		    $r   =$rst->row();
		    return $r->email;
		}else{
			return NULL;
		}*/
	}
}
