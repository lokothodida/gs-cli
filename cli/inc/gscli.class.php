<?php

class GSCli {
  private $params = array();
  private static $commands = array();

  public function __construct($params) {
    $this->params = $params;
  }

  public function i18n($hash) {
    return i18n_r($this->params['id'] . '/' . $hash);
  }

  public function adminpanel() {
    $adminurl = $GLOBALS['SITEURL'] . '/plugins/' . $this->params['id'] . '/';

    $js = array(
      'jquery.terminal' => $adminurl . 'js/jquery.terminal-0.8.8.min.js',
    );

    $css = array(
      'jquery.terminal' => $adminurl . 'css/jquery.terminal.css'
    );

    include GSPLUGINPATH . $this->params['id'] . '/adminpanel.php';
  }

  
  public function install() {
    $plugins = func_get_args();
    $msg = '';
    foreach ($plugins as $plugin) {
      $msg .= 'Installed ' . $plugin . "\n";
    }

    return array(
      'status' => true,
      'echo' => $msg,
    );
  }

  public static function add($cmd, $fn) {
    static::$commands[$cmd] = $fn;
  }

  public static function exec($cmd, $args) {
    if (isset(static::$commands[$cmd])) {
      return call_user_func_array(static::$commands[$cmd], $args);
    } else {
      return array();
    }
  }
}