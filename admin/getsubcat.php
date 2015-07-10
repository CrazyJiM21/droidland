<?php
require __DIR__ . '/../functions/const.php';
require FUNCTIONS_ROOT . '/sql.php';
require MODELS_ROOT . '/Subcategories.php';

	$cat = $_GET['cat'];

	$subcats = Subcategories_getBySuperCat($cat);

	echo "<label>Subcategory:<br></label>";
	echo "<select size='1' name='sub_category'>";
	echo "<option selected disabled>Choose subcategory...</option>";
	foreach($subcats as $subcat) {
        echo '<option value="' . $subcat['title'] . '">' . $subcat['title'] . '</option>';
    }
	echo "</select>";
?>