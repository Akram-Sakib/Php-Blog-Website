<?php
include '../lib/Session.php';
Session::checkSession();
?>
<?php include "../config/config.php";?>
<?php include "../lib/Database.php";?>

	<?php
$db = new Database();
?>
<?php
if (!isset($_GET["delpage"]) || $_GET["delpage"] == null) {
    echo "<script>window.location = 'index.php';</script>";
    //header("Location: catlist.php");
} else {
    $pageid = $_GET["delpage"];

    $del_query = "DELETE FROM tbl_page WHERE id = $pageid";
    $delData = $db->delete($del_query);
    if ($delData) {
        echo "<script>alert('Page Deleted Successfully');</script>";
        echo "<script>window.location = 'index.php';</script>";
    } else {
        echo "<script>alert('Page Not Deleted');</script>";
        echo "<script>window.location = 'index.php';</script>";
    }
}
?>