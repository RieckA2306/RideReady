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

// Checks if the Session ist already started
function check_if_session_started() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

function deny_allowance_for_direct_access() {
    if (!defined('ALLOW_HEADER_INCLUDE')) {
        die('Direct access to this file is not allowed.');
    }
}

function deny_allowance_for_direct_access_just_Admins() {
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'Admin') {
    die('Zugriff verweigert. Diese Seite ist nur für Administratoren.');
}
}

// Gets the Session Variables for Product Overview
function set_car_session($variablename, $databasevariablename) {
    global $auto; // Gets the variable from the global context

    if (isset($auto[$databasevariablename])) //Avoidance of undefined index
    {
        $variablename = $auto[$databasevariablename];
        $_SESSION[$databasevariablename] = $variablename;
    }
}

?>