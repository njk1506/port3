<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}

#myInput {
  background-position: 10px 12px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}

#myUL {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

#myUL li a {
  border: 1px solid #ddd;
  margin-top: -1px; /* Prevent double borders */
  background-color: #f6f6f6;
  padding: 12px;
  text-decoration: none;
  font-size: 18px;
  color: black;
  display: block
}

#myUL li a:hover:not(.header) {
  background-color: #eee;
}

.hidden {
	display: none;
}
</style>
 <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>

<h2>CVS</h2>
<a href="login.php" class="md-5"> Login!</a>
</br>

<input class="pt-2" type="text" id="myInput" onkeyup="filter()" placeholder="Search for names.." title="Type in a name">

<?php
	require_once ("connectdb.php");
	$db = new PDO("mysql:dbname=$db_name;host=$db_host", $username, $password); 
	$rows = $db->query("SELECT * FROM cvs");
?>
<ul id="myUL">
    <?php 
    foreach ($rows as $row) {
    $n = $row['id'];
    ?>
	<li><a href="javascript:display(<?=$n?>)"> <?=$row['name']?> </a></li>
    <p name="desc" class = "hidden" id = "<?=$n?>" >Name: <?=$row['name']?>
    </br>
    Email: <?=$row['email']?>
    </br>
    Main Language: <?=$row['keyprogramming']?>
    </br>
    Profile: <?=$row['profile']?>
    </br>
    Education: <?=$row['education']?>
    </br>
    Link: <?=$row['URLlinks']?>
    </p>
<?php
    }
?>
</ul>
<script>
function filter() {
    var f, input, ul, lists, a, i, txtValue;
    input = document.getElementById("myInput");
    f = input.value.toUpperCase();
    ul = document.getElementById("myUL");
    lists = ul.getElementsByTagName("li");
    for (i = 0; i < lists.length; i++) {
        a = lists[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(f) > -1) {
            lists[i].style.display = "";
        } else {
            lists[i].style.display = "none";
        }
    }
}

function display(id) {
var x = document.getElementById(id);
if (x.className === 'hidden'){
	x.classList.remove('hidden');
} else {
	x.classList.add('hidden');
}
}
</script>
</body>
</html>
