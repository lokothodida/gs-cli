<?php

include 'inc/gscli.class.php';

$plugin = new GSCli(array(
  'id' => $id,  
));

call_user_func_array('register_plugin', array(
  'pluginid'    => $id,
  'title'       => $plugin->i18n('PLUGIN_TITLE'),
  'version'     => '0.1',
  'author'      => 'Lawrence Okoth-Odida',
  'website'     => 'http://github.com/lokothodida',
  'description' => $plugin->i18n('PLUGIN_DESCRIPTION'),
  'admintab'    => 'plugins',
  'adminpanel'  => array($plugin, 'adminpanel')
));

add_action('plugins-sidebar', 'createSideMenu', array(
  'pluginid' => $id,
  'label'    => $plugin->i18n('PLUGIN_SIDEBAR')
));

add_action('cli-register-commands', array($plugin, 'registerCommands'));

add_action('cli-add', array($plugin, 'registerCommands'));
add_action('cli-add', array($plugin, 'install'));

/*

*/

function cli_add($cmd, $fn) {
  return GSCli::add($cmd, $fn);
}

cli_add('install', array($plugin, 'install'));