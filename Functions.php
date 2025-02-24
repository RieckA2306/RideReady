<?php
// Creation for the select dropdown menus
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
?>