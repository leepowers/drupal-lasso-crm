<?php

/**
 * @file
 * Administrative page code for the Seahaven Lasso
 */

/**
 * Administrative settings.
 *
 * @return array
 */
function lassocrm_settings_form($form, &$form_state) {
  $lassocrm_settings = variable_get('lassocrm_settings');

  $form['lassocrm_settings'] = array(
    '#type'         => 'fieldset',
    '#title'        => t('Lasso API Settings'),
    '#description'  => t('Settings for integrating with the Lasso CRM API'),
  );

  $form['lassocrm_settings']['api_key'] = array(
    '#type'          => 'textarea',
    '#title'         => t('API Key'),
    '#default_value' => isset($lassocrm_settings['api_key']) ? $lassocrm_settings['api_key'] : '',
    '#description'   => t(''),
    '#rows'          => 10,
  );

  $form['lassocrm_settings']['api_url'] = array(
    '#type'          => 'textfield',
    '#title'         => t('API URL'),
    '#default_value' => isset($lassocrm_settings['api_url']) ? $lassocrm_settings['api_url'] : 'https://api.lassocrm.com/registrants',
    '#description'   => t(''),
  );

  $form['lassocrm_settings']['client_id'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Client ID'),
    '#default_value' => isset($lassocrm_settings['client_id']) ? $lassocrm_settings['client_id'] : '',
    '#description'   => t(''),
  );

  $form['lassocrm_settings']['project_id'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Project ID'),
    '#default_value' => isset($lassocrm_settings['project_id']) ? $lassocrm_settings['project_id'] : '',
    '#description'   => t(''),
  );

  $form['lassocrm_settings']['uid'] = array(
    '#type'          => 'textfield',
    '#title'         => t('UID'),
    '#default_value' => isset($lassocrm_settings['uid']) ? $lassocrm_settings['uid'] : '',
    '#description'   => t(''),
  );

  $form['submit'] = array(
    '#type'  => 'submit',
    '#value' => 'Save Lasso Settings',
  );

  return $form;
}

/**
 * Submit handler().
 */
function lassocrm_settings_form_submit($form, &$form_state) {
  $lassocrm_settings = array();
  $lassocrm_settings['api_key'] = $form_state['values']['api_key'];
  $lassocrm_settings['client_id'] = $form_state['values']['client_id'];
  $lassocrm_settings['project_id'] = $form_state['values']['project_id'];
  $lassocrm_settings['uid'] = $form_state['values']['uid'];
  $lassocrm_settings['api_url'] = $form_state['values']['api_url'];
  serialize($lassocrm_settings);
  variable_set('lassocrm_settings', $lassocrm_settings);
}
