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
if (!isset($_GET["sliderid"]) || $_GET["sliderid"] == null) {
    echo "<script>window.location = 'sliderlist.php';</script>";
    //header("Location: catlist.php");
} else {
    $sliderid = $_GET["sliderid"];

    $query = "SELECT * FROM tbl_slider WHERE id = '$sliderid' ";
    $getData = $db->select($query);

    if ($getData) {
        while ($delimg = $getData->fetch_array()) {
            $del_link = $delimg['image'];
            unlink($del_link);
        }
    }

    $del_query = "DELETE FROM tbl_slider WHERE id = $sliderid";
    $delData = $db->delete($del_query);
    if ($delData) {
        echo "<script>alert('Slider Deleted Successfully');</script>";
        echo "<script>window.location = 'sliderlist.php';</script>";
    } else {
        echo "<script>alert('Slider Not Deleted');</script>";
        echo "<script>window.location = 'sliderlist.php';</script>";
    }
}
?>