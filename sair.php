<?php
session_start();

unset($_SESSION['sc_portal']);
header('Location: ./');
