<?php

call_user_func(create_function('$id', '
  include $id . "/index.php";
'), basename(__FILE__, '.php'));