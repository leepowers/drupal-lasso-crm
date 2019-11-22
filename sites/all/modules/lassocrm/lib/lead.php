<?php
/**
 * Lasso CRM lead
 */
class lassocrm_lead {

    protected $defaults = array (
        'firstName' => '',
        'lastName' => '',
        'clientId' => 0,
        'projectIds' => array(),
        'emails' => 
        array (
          /*array (
            'email' => '',
            'type' => 'Home',
            'primary' => true,
          ),*/
        ),
        'phones' => 
        array (
          /*array (
            'phone' => '',
            'type' => 'Mobile',
            'primary' => true,
          ),*/
        ),
        'notes' => array(),
        'nameTitle' => '',
        'company' => '',
        'rating' => '',
        'ratingId' => '',
        'rotationId' => '',
        'domainAccountId' => '',
        'guid' => '',
        'sourceType' => '',
        'secondarySourceType' => '',
        'followUpProcess' => '',
        'contactPreference' => '',
        'sendSalesRepAssignmentNotification' => false,
        'thankYouEmailTemplateId' => '',
        'addresses' => 
        array (
          /*array (
            'address' => '',
            'city' => '',
            'country' => '',
            'province' => '',
            'postalCode' => '',
            'type' => 'Home',
            'primary' => true,
          ),*/
        ),
        'questions' => 
        array (
          /*array (
            'id' => 0,
            'path' => '',
            'name' => '',
            'answers' => 
            array (
            ),
          ),
          array (
            'id' => 0,
            'path' => '',
            'name' => '',
            'answers' => 
            array (
              0 => 
              array (
                'id' => '',
                'text' => '',
              ),
            ),
          ),*/
        ),
    );

    public $data = array();

    public function __construct(array $data = null) {
        if (!empty($data)) {
            $this->data = array_merge($this->defaults, $data);
        }
    }

    public function toArray() {
        return $this->data;
    }
    
}