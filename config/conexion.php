<?php
/*
$server="localhost";
$s_mysql_user="serinfop_cepcl";
$s_mysql_password="cepcl.2013$";
$s_db="serinfop_cepcl03";
*/
$server="localhost";
$s_mysql_user="root";
$s_mysql_password="";
$s_db="tse";

$link = mysql_connect("$server","$s_mysql_user","$s_mysql_password");
mysql_select_db($s_db,$link);
?>