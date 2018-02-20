<?php

require_once 'emaildouble.civix.php';
use CRM_Emaildouble_ExtensionUtil as E;

/**
 * Implements hook_civicrm_buildForm().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_buildForm
 */
function emaildouble_civicrm_buildForm($formName, &$form) {
  // By default, don't add emaildouble field.
  $isEmaildouble = FALSE;
  // Determine whether emaildboule field is needed, for event online registration,
  // contribution pages, and standalone forms.
  if ($formName == 'CRM_Event_Form_Registration_Register') {
    $eventId = $form->getVar('_eventId');
    $isEmaildouble = _emaildouble_is_entity_emaildouble('CiviEvent', $eventId);
  }
  elseif ($formName == 'CRM_Contribute_Form_Contribution_Main') {
    $pageId = $form->getVar('_id');
    $isEmaildouble = _emaildouble_is_entity_emaildouble('CiviContribute', $pageId);
  }
  elseif (
    $formName == 'CRM_Profile_Form_Edit'
  ) {
    $gid = $form->getVar('_gid');;
    $settings = CRM_Emaildouble_Settings::getUFGroupSettings($gid);
    if ($settings['is_emaildouble']) {
      $isEmaildouble = TRUE;
    }
  }
  // For the Profile edit settings form, add our custom configuration field.
  elseif ($formName == 'CRM_UF_Form_Group') {
    // Create new field.
    $form->addElement('checkbox', 'is_emaildouble', E::ts('Require double-entry of primary email address (if field exists)?'));

    // Assign bhfe fields to the template, so our new field has a place to live.
    $tpl = CRM_Core_Smarty::singleton();
    $bhfe = $tpl->get_template_vars('beginHookFormElements');
    if (!$bhfe) {
      $bhfe = array();
    }
    $bhfe[] = 'is_emaildouble';
    $form->assign('beginHookFormElements', $bhfe);

    // Add javascript that will relocate our field to a sensible place in the form.
    CRM_Core_Resources::singleton()->addScriptFile('com.joineryhq.emaildouble', 'js/CRM_UF_Form_Group.js');

    // Set defaults so our field has the right value.
    $gid = $form->getVar('_id');
    if ($gid) {
      $settings = CRM_Emaildouble_Settings::getUFGroupSettings($gid);
      $defaults = array(
        'is_emaildouble' => $settings['is_emaildouble'],
      );
      $form->setDefaults($defaults);
    }
  }

  // If we determined above to add the emaildouble field, add the javascript
  // that does so.
  if ($isEmaildouble) {
    CRM_Core_Resources::singleton()->addCoreResources();
    CRM_Core_Resources::singleton()->addScriptFile('com.joineryhq.emaildouble', 'js/CRM_Profile_Form_Edit.js');
  }
}

/**
 * Implements hook_civicrm_postProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postProcess
 */
function emaildouble_civicrm_postProcess($formName, &$form) {
  if ($formName == 'CRM_UF_Form_Group') {
    $gid = $form->getVar('_id');
    // Get existing settings and add in our is_emaildouble value. (Because
    // saveAllUFGRoupSettings() assumes we're passing all setting values.
    $settings = CRM_Emaildouble_Settings::getUFGroupSettings($gid);
    $settings['is_emaildouble'] = $form->_submitValues['is_emaildouble'];
    CRM_Emaildouble_Settings::saveAllUFGRoupSettings($gid, $settings);
  }
}

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function emaildouble_civicrm_config(&$config) {
  _emaildouble_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function emaildouble_civicrm_xmlMenu(&$files) {
  _emaildouble_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function emaildouble_civicrm_install() {
  _emaildouble_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postInstall
 */
function emaildouble_civicrm_postInstall() {
  _emaildouble_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function emaildouble_civicrm_uninstall() {
  _emaildouble_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function emaildouble_civicrm_enable() {
  _emaildouble_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function emaildouble_civicrm_disable() {
  _emaildouble_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function emaildouble_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _emaildouble_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function emaildouble_civicrm_managed(&$entities) {
  _emaildouble_civix_civicrm_managed($entities);
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
function emaildouble_civicrm_caseTypes(&$caseTypes) {
  _emaildouble_civix_civicrm_caseTypes($caseTypes);
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
function emaildouble_civicrm_angularModules(&$angularModules) {
  _emaildouble_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function emaildouble_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _emaildouble_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *
function emaildouble_civicrm_preProcess($formName, &$form) {

} // */

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_navigationMenu
 *
function emaildouble_civicrm_navigationMenu(&$menu) {
  _emaildouble_civix_insert_navigation_menu($menu, NULL, array(
    'label' => E::ts('The Page'),
    'name' => 'the_page',
    'url' => 'civicrm/the-page',
    'permission' => 'access CiviReport,access CiviContribute',
    'operator' => 'OR',
    'separator' => 0,
  ));
  _emaildouble_civix_navigationMenu($menu);
} // */

/**
 * Determine whether to add emaildouble field for a given UFJoin entity.
 *
 * @param String $module 'module' parameter from UFJoin.get API. Supported
 *  options are: CiviEvent, CiviContribute
 * @param Integer $entityId 'entity_id' parameter from UFJoin.get API.
 *
 * @return boolean TRUE if the UFJoin exists for this entity with a profile that
 *  has a "primary email" field. Otherwise FALSE.
 */
function _emaildouble_is_entity_emaildouble($module, $entityId) {

  if (CRM_Core_Session::singleton()->getLoggedInContactID()) {
    // Don't use emaildouble for logged in users.
    return FALSE;
  }
  // No entityId? Something's wrong. Return FALSE.
  if (!$entityId) {
    return FALSE;
  }

  // Module is not supported? Return FALSE.
  $validModules = array(
    'CiviEvent',
    'CiviContribute',
  );
  if (!in_array($module, $validModules)) {
    return FALSE;
  }

  // Default to FALSE.
  $isEmaildouble = FALSE;

  // Get all profiles (UFJoines for this entity).
  $params = array(
    'entity_id' => $entityId,
    'module' => $module,
  );
  $result = civicrm_api3('UFJoin', 'get', $params);
  $ufJoins = $result['values'];
  // Check if each profile is both: a) set for emaildouble AND b) has a Primary
  // Email field.
  foreach ($ufJoins as $value) {
    $ufGroupId = $value['uf_group_id'];
    $settings = CRM_Emaildouble_Settings::getUFGroupSettings($ufGroupId);
    if ($settings['is_emaildouble']) {
      // This profile is set for emaildouble. If it also has a primary email field,
      // then we'll treat it as emaildouble.
      $result = civicrm_api3('UFField', 'get', array(
        'uf_group_id' => $ufGroupId,
        'field_name' => "email",
        'location_type_id' => array('IS NULL' => 1),
      ));
      if ($result['count']) {
        $isEmaildouble = TRUE;
        break;
      }
    }
  }
  return $isEmaildouble;
}