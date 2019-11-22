<?php

/**
 * Integration API functions
 * 
 */
class lassocrm_api {

    static protected $instance = null;

    static public function get_instance() {
        if (is_null(self::$instance)) {
            self::$instance = new lassocrm_api;
        }
        return self::$instance;
    }

    static public function submit_lead(lassocrm_lead $lead, $debug = false) {
        self::get_instance()->send_request($lead->toArray(), $debug);
    }

    public function send_request(array $post_fields, $debug = false) {
        // Settings from DB
        $lassocrm_settings = variable_get('lassocrm_settings');
        // Post fields
        if (!isset($post_fields["projectIds"]) || empty($post_fields["projectIds"])) {
            $post_fields["projectIds"] = array();
            $post_fields["projectIds"][]= (int)$lassocrm_settings["project_id"];
        }
        if (!isset($post_fields["clientId"]) || empty($post_fields["clientId"])) {
            $post_fields["clientId"] = (int)$lassocrm_settings["client_id"];
        }
        // Website tracking
        $domain_account_id = isset($_COOKIE["lasso_crm_domain_account_id"]) ? $_COOKIE["lasso_crm_domain_account_id"] : "";
        $guid = isset($_COOKIE["lasso_crm_guid"]) ? $_COOKIE["lasso_crm_guid"] : "";
        if ($domain_account_id && $guid) {
            $post_fields["domainAccountId"] = $domain_account_id;
            $post_fields["guid"] = $guid;
        }
        // Headers
        $headers = array(
            'Content-Type: application/json',
            'X-Lasso-Auth: Token='. $lassocrm_settings["api_key"] . ',Version=1.0',
        );
        if ($debug) {
            lassocrm_dump("Headers: ", $headers);
        }
        $json_post = json_encode($post_fields);
        if ($debug) {
            lassocrm_dump("post fields:", $post_fields);
            lassocrm_dump("post fields JSON:", $json_post);
        }
        // Send to Lasso API
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_URL, $lassocrm_settings["api_url"]);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $json_post);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $curl_result = curl_exec($curl);
        $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($debug) {
            lassocrm_dump($curl_result);
            lassocrm_dump(curl_getinfo($curl));
            lassocrm_dump("HTTP response code: $http_status");
        }
    }


}