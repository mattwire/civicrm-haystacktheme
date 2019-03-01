<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 28-02-2019
 * Time: 19:32
 */

use CRM_Haystack_ExtensionUtil as E;

class CRM_Haystack_Main {

  /**
   * Disable CiviCRM resources from front-end.
   *
   */
  public function resources_disable() {

    // Only on back-end.
    //if ( is_admin() ) {

      // Maybe disable core stylesheet.
      /*if ( $this->setting_get( 'css_admin', '0' ) == '1' ) {

        // Disable core stylesheet.
        $this->resource_disable( 'civicrm', 'css/civicrm.css' );

        // Also disable Shoreditch if present.
        if ( $this->shoreditch_is_active() ) {
          $this->resource_disable( 'org.civicrm.shoreditch', 'css/custom-civicrm.css' );
        }

      }

      // Maybe disable custom stylesheet (not provided by Shoreditch).
      if ( $this->setting_get( 'css_custom_public', '0' ) == '1' ) {
        $this->custom_css_disable();
      }*/

      // Only on front-end.
    //} else {

      // Maybe disable core stylesheet.
      /*if ( $this->setting_get( 'css_default', '0' ) == '1' ) {
        $this->resource_disable( 'civicrm', 'css/civicrm.css' );
      }

      // Maybe disable navigation stylesheet (there's no menu on the front-end).
      if ( $this->setting_get( 'css_navigation', '0' ) == '1' ) {
        $this->resource_disable( 'civicrm', 'css/civicrmNavigation.css' );
      }*/

      // If Shoreditch present.
      if ( $this->shoreditch_is_active() ) {

        // Maybe disable Shoreditch stylesheet.
        //if ( $this->setting_get( 'css_shoreditch', '0' ) == '1' ) {
          $this->resource_disable( 'org.civicrm.shoreditch', 'css/custom-civicrm.css' );
        //}

        // Maybe disable Shoreditch Bootstrap stylesheet.
        //if ( $this->setting_get( 'css_bootstrap', '0' ) == '1' ) {
          $this->resource_disable( 'org.civicrm.shoreditch', 'css/bootstrap.css' );
        //}

      } else {

        // Maybe disable custom stylesheet (not provided by Shoreditch).
        //if ( $this->setting_get( 'css_custom', '0' ) == '1' ) {
          $this->custom_css_disable();
        //}

      }

    //}

  }

  /**
   * Enable CiviCRM theme resources
   *
   * @param $region
   */
  public function resources_enable($region) {
    if ($region == 'html-header') {
      switch (strtolower(CRM_Core_Config::singleton()->userFramework)) {
        case 'joomla':
          $css = 'joomla';
          break;
        case 'wordpress':
          $css = 'wordpress';
          break;
        case 'drupal':
          $css = 'drupal7';
          break;
        default:
          $css = 'drupal7';
      }
      if (file_exists(E::path('css/haystack-civicrm-' . $css . '-base.css'))) {
        CRM_Core_Resources::singleton()
          ->addStyleFile('haystack', 'css/haystack-civicrm-' . $css . '-base.css', -50, $region);
      }

      CRM_Core_Resources::singleton()
        ->addStyleFile('haystack', 'css/civicrm-admin-utilities-admin.css', -50, $region);
      // TODO: Add a setting to choose light/dark menu theme
      //CRM_Core_Resources::singleton()
      //  ->addStyleFile('haystack', 'css/civicrm-admin-utilities-kam.css', -50, 'html-header');
    }
  }

  /**
   * Disable a resource enqueued by CiviCRM.
   *
   *
   * @param str $extension The name of the extension e.g. 'org.civicrm.shoreditch'. Default is CiviCRM core.
   * @param str $file The relative path to the resource. Default is CiviCRM core stylesheet.
   */
  public function resource_disable($extension = 'civicrm', $file = 'css/civicrm.css') {

    // Get the resource URL.
    $url = $this->resource_get_url( $extension, $file );

    // Kick out if not enqueued.
    if ( $url === false ) return;

    // Set to disabled.
    CRM_Core_Region::instance('html-header')->update( $url, array( 'disabled' => FALSE ) );

  }

  /**
   * Get the URL of a resource if it is enqueued by CiviCRM.
   *
   * @param str $extension The name of the extension e.g. 'org.civicrm.shoreditch'. Default is CiviCRM core.
   * @param str $file The relative path to the resource. Default is CiviCRM core stylesheet.
   * @return bool|str $url The URL if the resource is enqueued, false otherwise.
   */
  public function resource_get_url( $extension = 'civicrm', $file = 'css/civicrm.css' ) {
    // Get registered URL.
    $url = CRM_Core_Resources::singleton()->getUrl( $extension, $file, TRUE );

    // Get registration data from region.
    $registration = CRM_Core_Region::instance( 'html-header' )->get( $url );

    // Bail if not registered.
    if ( empty( $registration ) ) return false;

    // Is enqueued.
    return $url;
  }

  /**
   * Disable any custom CSS file enqueued by CiviCRM.
   *
   */
  public function custom_css_disable() {

    // Get CiviCRM config.
    $config = CRM_Core_Config::singleton();

    // Bail if there's no custom CSS file.
    if ( empty( $config->customCSSURL ) ) return;

    // Get registered URL.
    $url = CRM_Core_Resources::singleton()->addCacheCode( $config->customCSSURL );

    // Get registration data from region.
    $registration = CRM_Core_Region::instance('html-header')->get( $url );

    // Bail if not registered.
    if ( empty ( $registration ) ) return;

    // Set to disabled.
    CRM_Core_Region::instance('html-header')->update( $url, array( 'disabled' => TRUE ) );
  }


  /**
   * Determine if the Shoreditch CSS file is being used.
   *
   * @return bool $shoreditch True if Shoreditch CSS file is used, false otherwise.
   */
  public function shoreditch_is_active() {

    // Assume not.
    $shoreditch = false;

    // Get the current Custom CSS URL.
    $config = CRM_Core_Config::singleton();

    // Has the Shoreditch CSS been activated?
    if ( strstr( $config->customCSSURL, 'org.civicrm.shoreditch' ) !== false ) {

      // Shoreditch CSS is active.
      $shoreditch = true;

    }

    return $shoreditch;
  }

}