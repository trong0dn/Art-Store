<?php

/**
 * Start new session if no session exists
 */
if (!isset($_SESSION) || !is_array($_SESSION)) {
    session_start();
}

?>