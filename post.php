<?php include "inc/header.php"; ?>

<?php
$postid  = mysqli_real_escape_string($db->link,$_GET["id"]);
if (!isset($postid) || $postid == NULL) {
	header("location: 404.php");
}else {
	$id = $postid;
}
?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">

			<?php
			$query = "SELECT * FROM tbl_post WHERE id = $id";
			$post = $db->select($query);
			if ($post) {
				while ($result = $post->fetch_assoc()) {
			?>

				<h2><?php echo $result["title"]; ?></h2>
				<h4><?php echo $fm->formatDate($result["date"]); ?> <a href="#"><?php echo $result["author"]; ?></a></h4>
				<img src="admin/<?php echo $result['image']; ?>" />
				<?php echo $result["body"]; ?>


				<div class="relatedpost clear">
					<h2>Related articles</h2>
					<?php
					$catId = $result["cat"];
					$queryRelated = "SELECT * FROM tbl_post WHERE cat = '$catId' ORDER BY rand() LIMIT 6";
					$relatedPost = $db->select($queryRelated);
					if ($relatedPost) {
						while ($rresult = $relatedPost->fetch_array()) {	
					?>
					<a href="post.php?postid=<?php echo $rresult['id']; ?>"><img src="admin/<?php echo $rresult['image']; ?>" alt="post image"/></a>
					<?php } }else{ echo "No Related post available"; } ?>
				</div>

				<?php } }else{ header("location:404.php"); } ?>
	</div>
</div>

<?php include "inc/sidebar.php";?>
<?php include "inc/footer.php";?>
