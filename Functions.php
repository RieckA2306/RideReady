<?php
// Creats the select dropdown menus for the Filters on the Productoverview
function renderFilterGroup($label, $name, $options, $selectedValue) {
    echo '<div class="filter-group">';
    echo "<label for='$name'>$label:</label>";
    echo "<select name='$name' id='$name' class='filter-group'>";
    echo "<option value=''>alle</option>";
    
    foreach ($options as $option) {
        $selected = ($option == $selectedValue) ? 'selected' : '';
        echo "<option value='$option' $selected>$option</option>";
    }
    
    echo "</select>";
    echo "</div>";
}

// Adds to the SQL-Query for the Filters on the Productoverview
function sqlfilters($label2, $name2, $listname, &$sql, &$params) {
    if (!empty($label2)) {
        $sql .= " AND $listname = :$name2";
        $params[":$name2"] = $label2;
    }
}
?>