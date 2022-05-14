<?php
function phpAlert($msg, $page) {
    echo '<script type="text/javascript">alert("'.$msg.'");location="'.$page.'";</script>';
}
?>