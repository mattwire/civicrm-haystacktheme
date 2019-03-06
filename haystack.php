<?php

require_once 'haystack.civix.php';
use CRM_Haystack_ExtensionUtil as E;
use \Civi\Core\Event\GenericHookEvent;

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function haystack_civicrm_config(&$config) {
  _haystack_civix_civicrm_config($config);

  // Add listeners for CiviCRM hooks that might need altering by other scripts
  Civi::service('dispatcher')->addListener('hook_civicrm_coreResourceList', 'haystack_symfony_civicrm_coreResourceList', -100);
  Civi::service('dispatcher')->addListener('hook_civicrm_alterContent', 'haystack_symfony_civicrm_alterContent', -100);
  //Civi::service('dispatcher')->addListener('hook_civicrm_buildForm', 'haystack_symfony_civicrm_buildForm', -100);
  //Civi::service('dispatcher')->addListener('hook_civicrm_pageRun', 'haystack_symfony_civicrm_pageRun', -100);

  /**
   * Dispatch an event to say that haystack is configured.
   *
   * @param string $hook_name The dispatched hook name.
   * @param object $hook_event The dispatched hook event object.
   */
  Civi::service('dispatcher')->dispatch('hook_haystack_civicrm_config', GenericHookEvent::create(array()));
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function haystack_civicrm_xmlMenu(&$files) {
  _haystack_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function haystack_civicrm_install() {
  _haystack_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postInstall
 */
function haystack_civicrm_postInstall() {
  _haystack_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function haystack_civicrm_uninstall() {
  _haystack_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function haystack_civicrm_enable() {
  _haystack_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function haystack_civicrm_disable() {
  _haystack_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function haystack_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _haystack_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function haystack_civicrm_managed(&$entities) {
  _haystack_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function haystack_civicrm_caseTypes(&$caseTypes) {
  _haystack_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_angularModules
 */
function haystack_civicrm_angularModules(&$angularModules) {
  _haystack_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function haystack_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _haystack_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *\
 * Declare entity types provided by this module.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_entityTypes
 */
function haystack_civicrm_entityTypes(&$entityTypes) {
  _haystack_civix_civicrm_entityTypes($entityTypes);
}

/**
 * Implements hook_civicrm_coreResourceList() via Symfony hook system.
 */
function haystack_symfony_civicrm_coreResourceList($event, $hook) {
  // Extract args for this hook
  list($items, $region) = $event->getHookValues();

  if ($region == 'html-header') {
    $main = new CRM_Haystack_Main();
    $main->resources_disable();
    $main->resources_enable($region);
  }
}

function haystack_symfony_civicrm_alterContent($event, $hook) {
  if ((boolean) CRM_Haystack_Settings::getValue('responsive_datatables')) {
    // Enable responsive datatables (we could do this in Civi core by adding responsive=true in jquery.crmAjaxTable.js)
    // Not all tables are datatables, this only works on the ones which are (add the responsive selector to them)
    $event->content = str_replace(['crm-ajax-table', 'class="selector', 'class="display"'], ['crm-ajax-table responsive', 'class="selector responsive', 'class="display responsive"'], $event->content);
  }
}

/**
 * Implements hook_civicrm_buildAsset().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_buildAsset
 */
function haystack_civicrm_buildAsset($asset, $params, &$mimetype, &$content) {
  if ($asset !== 'haystack-civicrm-shared.css') {
    return;
  }
  $raw = file_get_contents(Civi::resources()->getPath(E::LONG_NAME, "css/{$asset}"));
  $content = str_replace('../../../civicrm/civicrm/', Civi::resources()->getUrl('civicrm'), $raw);
  $mimetype = 'text/css';
}

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_navigationMenu
 *
 */
function haystack_civicrm_navigationMenu(&$menu) {
  $item[] = [
    'label' => E::ts('Haystack theme settings'),
    'name'  => 'Haystack theme settings',
    'url'   => 'civicrm/admin/haystack/settings',
    'permission' => 'administer CiviCRM',
    'operator'   => NULL,
    'separator'  => NULL,
  ];
  _haystack_civix_insert_navigation_menu($menu, 'Administer/Customize Data and Screens', $item[0]);

  _haystack_civix_navigationMenu($menu);
}
