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
        $form->addSelect($name,
          [
            'options' => ['Haystack' => 'Haystack - based on CiviCRM Admin Utilities', 'Shelford' => 'Shelford - targetted to match Joomla admin theme'],
            'label' => $setting['description'],
            'placeholder'  => NULL,
          ]
        );
        break;

      case 'theme_frontend':
        $form->addSelect($name,
          [
            'options' => [0 => 'Never', 1 => 'Only on Frontend (Public pages)', 2 => 'Only on Backend (Admin pages)', 3 => 'Always'],
            'label' => $setting['description'],
            'placeholder'  => NULL,
          ]
        );
        break;

    }
  }

}
