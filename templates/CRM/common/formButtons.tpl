{*
 +--------------------------------------------------------------------+
 | CiviCRM version 5                                                  |
 +--------------------------------------------------------------------+
 | Copyright CiviCRM LLC (c) 2004-2019                                |
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
 +--------------------------------------------------------------------+
*}

{* Loops through $form.buttons.html array and assigns separate spans with classes to allow theming
   by button and name. crmBtnType grabs type keyword from button name (e.g. 'upload', 'next', 'back', 'cancel') so
   types of buttons can be styled differently via css. *}
{crmRegion name='form-buttons'}
  {if $linkButtons}
    {foreach from=$linkButtons item=linkButton}
      <a class="button" href="{crmURL p=$linkButton.url q=$linkButton.qs}" accesskey="{$linkButton.accessKey}"><span><i class="crm-i {$linkButton.icon}"></i> {$linkButton.name}</span></a>
    {/foreach}
  {/if}

  {foreach from=$form.buttons item=button key=key name=btns}
    {if $key|substring:0:4 EQ '_qf_'}
      {if $location}
        {assign var='html' value=$form.buttons.$key.html|crmReplace:id:"$key-$location"}
      {else}
        {assign var='html' value=$form.buttons.$key.html}
      {/if}
      {crmGetAttribute html=$html attr='type' assign='type'}
      {crmGetAttribute html=$html attr='name' assign='name'}
      {crmGetAttribute html=$html attr='value' assign='value'}
      {crmGetAttribute html=$html attr='disabled' assign='disabled'}
      {if $key|substr:-6 EQ 'cancel'}
        {capture assign=class}cancel{/capture}
        {capture assign=type}button{/capture}
      {/if}
      <button type="{$type}" name="{$name}" {$disabled} class="crm-button button {$class}">
        {crmGetAttribute html=$html attr='crm-icon' assign='icon'}
        {capture assign=iconPrefix}{$icon|truncate:3:"":true}{/capture}
        {if $icon && $iconPrefix eq 'fa-'}
          {assign var='buttonClass' value=' crm-i-button'}
          {capture assign=iconDisp}<i class="crm-i {$icon}"></i>{/capture}
        {elseif $icon}
          {assign var='buttonClass' value=' crm-icon-button'}
          {capture assign=iconDisp}<span class="crm-button-icon ui-icon-{$icon}"> </span>{/capture}
        {/if}
          {$iconDisp}
          {$value}
        </span>
      </button>
    {/if}
  {/foreach}
{/crmRegion}
