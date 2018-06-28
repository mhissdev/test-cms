<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Bootstrap_alerts.php
* Generates HTML for Bootstrap alerts
* mhisdev 28.06.06
*/

class Bootstrap_alerts{

    /**
    *   Generates HTML for Bootstrap alerts
    *   @param string $message - The alert message
    *   @param string $alertClass - ('success', 'danger', 'info' etc)
    *   @return string HTML for Bootsrap alert
    */
    public function alert($message, $alertClass = 'success')
    {
        // Build HYML string
        return '<div class="alert alert-' . $alertClass . '" role="alert">' . $message . '</div>';
    }


    /**
    *   Generates HTML to output validation errors
    *   @param string $listItems (eg. <li>My Validation Error</li>)
    *   @return string HTML for Bootsrap alert
    */
    public function validation($listItems)
    {
        // Build HYML string
        $str = '<p>Please fix the following errors:-</p>';
        $str .= '<ul>' . $listItems . '</ul>';
        return $this->alert($str, 'danger');
    }

}