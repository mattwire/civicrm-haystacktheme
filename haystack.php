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
 *
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
function haystack_symfony_civicrm_coreResourceList( $event, $hook ) {
  // Extract args for this hook
  list($items, $region) = $event->getHookValues();

  if ($region == 'html-header') {
    CRM_Core_Resources::singleton()
      ->addStyleFile('haystack', 'css/civicrm-admin-utilities-admin.css', -50, 'html-header');
    // TODO: Add a setting to choose light/dark menu theme
    //CRM_Core_Resources::singleton()
    //  ->addStyleFile('haystack', 'css/civicrm-admin-utilities-kam.css', -50, 'html-header');
  }
  $main = new CRM_Haystack_Main();
  $main->resources_disable();
}
