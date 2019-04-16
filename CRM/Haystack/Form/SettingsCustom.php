<?php

use CRM_Smartdebit_ExtensionUtil as E;

/**
 * Form controller class
 *
 */
class CRM_Haystack_Form_SettingsCustom extends CRM_Haystack_Form_Settings {

  public static function addSelectElement(&$form, $name, $setting) {
    switch ($name) {
      case 'theme':
        $form->addSelect($name,
          array(
            'options' => ['Haystack' => 'Haystack - based on CiviCRM Admin Utilities', 'Shelford' => 'Shelford - targetted to match Joomla admin theme'],
            'label' => $setting['description'],
            'placeholder'  => NULL,
          )
        );
        break;
    }
  }

}
