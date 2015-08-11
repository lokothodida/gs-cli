<?php

$path = dirname(__FILE__) . '/../../';
$files = glob($path . '*/inc/common.php');

$load['plugin'] = true;

if (count($files)) {
  include($files[0]);
  echo json_encode(GSCli::exec($_GET['cmd'], $_GET['args']));
}
if (!cookie_check()) die('{ error: "Not permitted to access this api"}');