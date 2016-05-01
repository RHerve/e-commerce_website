<?PHP
session_start();
if(!isset($_SESSION["EmailUser"])){
	echo "no";
	exit;
}
session_destroy().
?>
