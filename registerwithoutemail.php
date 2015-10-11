<?php

require_once 'registerwithoutemail.civix.php';

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function registerwithoutemail_civicrm_config(&$config) {
  _registerwithoutemail_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @param $files array(string)
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function registerwithoutemail_civicrm_xmlMenu(&$files) {
  _registerwithoutemail_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function registerwithoutemail_civicrm_install() {
  _registerwithoutemail_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function registerwithoutemail_civicrm_uninstall() {
  _registerwithoutemail_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function registerwithoutemail_civicrm_enable() {
  _registerwithoutemail_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function registerwithoutemail_civicrm_disable() {
  _registerwithoutemail_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @param $op string, the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of pending up upgrade tasks
 *
 * @return mixed
 *   Based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *                for 'enqueue', returns void
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function registerwithoutemail_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _registerwithoutemail_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function registerwithoutemail_civicrm_managed(&$entities) {
  _registerwithoutemail_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function registerwithoutemail_civicrm_caseTypes(&$caseTypes) {
  _registerwithoutemail_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function registerwithoutemail_civicrm_angularModules(&$angularModules) {
_registerwithoutemail_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function registerwithoutemail_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _registerwithoutemail_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implementation of hook_civicrm_validateForm
 */
function registerwithoutemail_civicrm_validateForm( $formName, &$fields, &$files, &$form, &$errors ) {
  if ($formName == 'CRM_Event_Form_Registration_AdditionalParticipant') {
    if (!isset($fields['email-Primary'])) {
      $fields['email-Primary'] =  time() . '_' . rand() . "@example.com";
    }

    $fields['first_name'] = "Overridden";

    $params = $form->get('params');

    foreach($params AS &$param) {
      if (!isset($param['email-Primary'])) {
        $param['email-Primary'] =  time() . '_' . rand() . "@example.com";
      } else if (is_null($param['email-Primary'])) {
        $param['email-Primary'] = "isnull@example.com";
      } else if ($param['email-Primary'] == "") {
        $param['email-Primary'] = "isblank@example.com";
      }      
    }

    $form->set('params', $params);

    $data = &$form->controller->container();              

    $additional_participants = $data['values']['Register']['additional_participants'];

    for ($i = 1; $i <= $data['values']['Register']['additional_participants']; $i++) {
      if (!isset($data['values']['Participant_'.$i]['email-Primary'])) {
        $data['values']['Participant_'.$i]['email-Primary'] = time() . '_' . rand() . "@example.com";
      }
    }
  }
  return;
}
