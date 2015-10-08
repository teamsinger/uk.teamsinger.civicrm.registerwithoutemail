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
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *
 */
function registerwithoutemail_civicrm_preProcess($formName, &$form) {
//error_log("preProcess");
//error_log($formName);

}


/**
 * Implementation of hook_civicrm_postProcess
 */
function registerwithoutemail_civicrm_postProcess( $formName, &$form ) {
//error_log($formName);
  if ($formName == 'CRM_Event_Form_Registration_Confirm') {
    $params = $form->get('params');
//error_log(print_r($params, true));
    foreach($params AS &$param) {
//      error_log(print_r($param['email-Primary'], true));
      if (!isset($param['email-Primary'])) {
        $param['email-Primary'] =  time() . '_' . rand() . "@example.com";
      } else if (is_null($param['email-Primary'])) {
        $param['email-Primary'] = "isnull@example.com";
      } else if ($param['email-Primary'] == "") {
        $param['email-Primary'] = "isblank@example.com";
      }      
    }
//error_log(print_r($params, true));

    $form->set('params', $params);
  }
}
/**
 * Implementation of hook_civicrm_validateForm
 */
function registerwithoutemail_civicrm_validateForm( $formName, &$fields, &$files, &$form, &$errors ) {
error_log($formName);
  if ($formName == 'CRM_Event_Form_Registration_AdditionalParticipant') {
//error_log(print_r($fields, true));
    if (!isset($fields['email-Primary'])) {
      $fields['email-Primary'] =  time() . '_' . rand() . "@example.com";
    }

    $fields['first_name'] = "Overridden";
//error_log(print_r($fields, true));
    $params = $form->get('params');
//error_log(print_r($params, true));
    foreach($params AS &$param) {
//error_log('checking in validate');
      error_log(print_r($param['email-Primary'], true));
      if (!isset($param['email-Primary'])) {
        $param['email-Primary'] =  time() . '_' . rand() . "@example.com";
      } else if (is_null($param['email-Primary'])) {
        $param['email-Primary'] = "isnull@example.com";
      } else if ($param['email-Primary'] == "") {
        $param['email-Primary'] = "isblank@example.com";
      }      
    }
//error_log(print_r($params, true));

    $form->set('params', $params);

$data = &$form->controller->container();              
error_log(print_r($data['values'], true));
//$data['values']['Main'][$fieldName] = $newvalue;

    foreach($data['values'] AS $key => &$value) {
      if ($key == 'Participant_1') {
        if (!isset($value['email-Primary'])) {
          $value['email-Primary'] =  time() . '_' . rand() . "@example.com";
        }
      }
      if ($key == 'Participant_2') {
        if (!isset($value['email-Primary'])) {
          $value['email-Primary'] =  time() . '_' . rand() . "@example.com";
        }
      }
    }

  }
  return;
}
