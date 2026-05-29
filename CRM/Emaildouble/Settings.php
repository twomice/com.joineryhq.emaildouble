<?php

/**
 * Settings-related utility methods.
 *
 */
class CRM_Emaildouble_Settings {

  public static function getUFGroupSettings($ufGroupId) {
    $settingName = "ufgroup_settings_{$ufGroupId}";
    $result = civicrm_api3('OptionValue', 'get', array(
      'sequential' => 1,
      'option_group_id' => "emaildouble",
      'name' => $settingName,
    ));
    $resultValue = CRM_Utils_Array::value(0, $result['values'], array());
    $settingJson = CRM_Utils_Array::value('value', $resultValue, '{}');
    return json_decode($settingJson, TRUE);
  }

  public static function saveAllUFGRoupSettings($ufGroupId, $settings) {
    $settingName = "ufgroup_settings_{$ufGroupId}";
    $result = civicrm_api3('OptionValue', 'get', array(
      'sequential' => 1,
      'option_group_id' => "emaildouble",
      'name' => $settingName,
    ));

    $createParams = array();

    if ($optionValueId = $result['id'] ?? NULL) {
      $createParams['id'] = $optionValueId;
    }
    else {
      $createParams['name'] = $settingName;
      $createParams['option_group_id'] = "emaildouble";
    }

    // Add uf_group_id to settings. Without this, optionValue.create api was failing
    // to save new settings with a message like "value already exists in the database"
    // if the values for this ufGroup are the same as for some other ufGroup. So by
    // adding uf_group_id, we make it unique to this ufGroup.
    $settings['uf_group_id'] = $ufGroupId;
    $createParams['value'] = json_encode($settings);

    try {
      civicrm_api3('optionValue', 'create', $createParams);
      return TRUE;
    }
    catch (CRM_Core_Exception $e) {
      return FALSE;
    }
  }

}
