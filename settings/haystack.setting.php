<?php
/*--------------------------------------------------------------------+
 | CiviCRM version 4.7                                                |
+--------------------------------------------------------------------+
 | Copyright CiviCRM LLC (c) 2004-2017                                |
+--------------------------------------------------------------------+
 | This file is a part of CiviCRM.                                    |
 |                                                                    |
 | CiviCRM is free software; you can copy, modify, and distribute it  |
 | under the terms of the GNU Affero General Public License           |
 | Version 3, 19 November 2007 and the CiviCRM Licensing Exception.   |
 |                                                                    |
 | CiviCRM is distributed in the hope that it will be useful, but     |
 | WITHOUT ANY WARRANTY; without even the implied warranty of         |
 | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.               |
 | See the GNU Affero General Public License for more details.        |
 |                                                                    |
 | You should have received a copy of the GNU Affero General Public   |
 | License and the CiviCRM Licensing Exception along                  |
 | with this program; if not, contact CiviCRM LLC                     |
 | at info[AT]civicrm[DOT]org. If you have questions about the        |
 | GNU Affero General Public License or the licensing of CiviCRM,     |
 | see the CiviCRM license FAQ at http://civicrm.org/licensing        |
 +-------------------------------------------------------------------*/

return [
  'haystack_responsive_datatables' => [
    'admin_group' => 'haystack_theme',
    'admin_grouptitle' => 'Theme Settings',
    'admin_groupdescription' => 'Select the theme components to use.',
    'group_name' => 'Haystack theme settings',
    'group' => 'haystack',
    'name' => 'haystack_responsive_datatables',
    'type' => 'Boolean',
    'html_type' => 'Checkbox',
    'default' => 1,
    'add' => '5.0',
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => 'Responsive datatables',
    'html_attributes' => [],
  ],
  'haystack_responsive_tables' => [
    'admin_group' => 'haystack_theme',
    'group_name' => 'Haystack theme settings',
    'group' => 'haystack',
    'name' => 'haystack_responsive_tables',
    'type' => 'Boolean',
    'html_type' => 'Checkbox',
    'default' => 1,
    'add' => '5.0',
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => 'Responsive tables',
    'html_attributes' => [],
  ],
  'haystack_disable_civicrm_core_css' => [
    'admin_group' => 'haystack_theme',
    'group_name' => 'Haystack theme settings',
    'group' => 'haystack',
    'name' => 'haystack_disable_civicrm_core_css',
    'type' => 'Boolean',
    'html_type' => 'Checkbox',
    'default' => 1,
    'add' => '5.0',
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => 'Disable CiviCRM core css (recommended)',
    'html_attributes' => [],
  ],
  'haystack_theme' => [
    'admin_group' => 'haystack_theme',
    'group_name' => 'Haystack theme settings',
    'group' => 'haystack',
    'name' => 'haystack_theme',
    'type' => 'String',
    'html_type' => 'Select',
    'default' => 'Haystack',
    'add' => '5.0',
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => 'Preferred theme',
    'html_attributes' => [
      'size' => 80,
    ],
  ],
  'haystack_theme_frontend' => [
    'admin_group' => 'haystack_theme',
    'group_name' => 'Haystack theme settings',
    'group' => 'haystack',
    'name' => 'haystack_theme_frontend',
    'type' => 'Integer',
    'html_type' => 'Select',
    'default' => 3,
    'add' => '5.0',
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => 'When should the CiviCRM frontend theme be loaded?',
    'html_attributes' => [
      'size' => 80,
    ],
  ],
];
