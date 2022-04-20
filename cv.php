<head>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<a href="index.php">Home</a>
</head>
<?php
	session_start();	

	if (!isset($_SESSION['username'])){
		header("Location: login.php");
		exit();
	}
	$username=$_SESSION['username'];
	echo "<h2> Welcome ".$_SESSION['username']."! </h2>";
	require_once ('connectdb.php');  
		$query="SELECT * FROM cvs WHERE name= '{$_SESSION['username']}' ";
		$rows =  $db->query($query);
?>	

<?php
if (isset($_POST['submitted'])){
 $profile = $_REQUEST['profile'];
 $education = $_REQUEST['education'];
 $link = $_REQUEST['link'];
 $lang = $_REQUEST['language'];
 $sql = "UPDATE cvs SET profile = '{$profile}', education = '{$education}', URLlinks = '{$link}', keyprogramming = '{$lang}' WHERE name= '{$_SESSION['username']}' ";
 $db->query($sql);
}
?>
<h2>Update CV</h2>
  <form method = "post" action="cv.php" id="a">
	<input type="submit" value="Update" /> 
	<input type="hidden" name="submitted" value="true"/>
  </form>  
	<h2>Profile</h2>
   <textarea rows="4" cols="50" name="profile" form="a"></textarea>
	<h2>Education</h2>
	<textarea rows="4" cols="50" name="education" form="a"></textarea>
<h2>Link</h2>
<textarea rows="4" cols="50" name="link" form="a"></textarea>
<h2>Key Programming Language</h2>
<textarea rows="1" cols="15" name="language" form="a"></textarea>
