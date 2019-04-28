<?php

use CRM_Smartdebit_ExtensionUtil as E;

/**
 * Form controller class
 *
 */
class CRM_Haystack_Form_SettingsCustom extends CRM_Haystack_Form_Settings {

  /**
   * @param CRM_Core_Form $form
   * @param string $name
   * @param array $setting
   */
  public static function addSelectElement(&$form, $name, $setting) {
    switch ($name) {
      case 'theme':
        $form->add(
          'select',
          $name,
          $setting['description'],
          ['Haystack' => 'Haystack - based on CiviCRM Admin Utilities', 'Shelford' => 'Shelford - targetted to match Joomla admin theme']
        );
        break;

      case 'theme_frontend':
        $form->add(
          'select',
          $name,
          $setting['description'],
          [0 => 'Never', 1 => 'Only on Frontend (Public pages)', 2 => 'Only on Backend (Admin pages)', 3 => 'Always']
        );
        break;

    }
  }

}
