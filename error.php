<?php

$error = $_GET['error'];

header("location: index.php?error=$error");