<?php

function print_message() {
    if ((isset($_SESSION['type_of_message'])) && (isset($_SESSION['message'])) && ($_SESSION['type_of_message'] != '') && ($_SESSION['message'] != '')) {
        echo "<center><div class=" . $_SESSION['type_of_message'] . ">";
        echo $_SESSION['message'];
        echo "</div></center>";
        unset($_SESSION['message']);
        unset($_SESSION['type_of_message']);
        return;
    }
}

function send_message($string, $type) {
    $_SESSION['message'] = $string;
    $_SESSION['type_of_message'] = $type;
}

?>