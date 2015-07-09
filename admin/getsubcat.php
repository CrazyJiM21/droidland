<?php
	$cat = $_GET['cat'];

	include ("bd.php");
	$sql="SELECT * FROM sub_category WHERE super_cat = '".$cat."'";
	$result = mysql_query($sql, $db);

	echo "<label>Subcategory:<br></label>";
	echo "<select size='1' name='sub_category'>";
	echo "<option selected disabled>Choose subcategory...</option>";
	while($row = mysql_fetch_array($result)) {
		printf("
                 <option value='%s'>%s</option>
                 ", $row['title'], $row['title']);
	}
	echo "</select>";
	mysql_close($db);
?>