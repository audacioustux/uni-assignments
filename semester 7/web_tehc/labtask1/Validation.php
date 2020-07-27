<?php

//Form Data will be sent here
//We are going to check or validate those data
//If there is/are any error(s), then we will save those error(s) in an 'errors' associative array
//We are going to return the 'errors' array to the page (login.php)
//Show appropriate error messages in right places

class Validation
{
    private $formData;
    private $errors = [];
    private $formFields = ['donor_first-name', 'donor_last-name', "donor_company", "donor_addr1", "donor_addr2", "donor_city", "donor_state", "donor_zip", "donor_country", "donor_phone", "donor_fax", "donor_email", "donor_donation-amount", "donor_is-recurr", "donor_recurr-amount", "donor_recurr-month", "h-and-m_as", "h-and-m_as", "h-and-m_name", "h-and-m_ack-to", "h-and-m_addr", "h-and-m_city", "h-and-m_state", "h-and-m_zip", "add-inf_name", "add-inf_will-mail", "add-inf_is-anon", "add-inf_dont_mail", "add-inf_comments", "add-inf_contact-by-mail", "add-inf_contact-by-pmail", "add-inf_contact-by-tele", "add-inf_contact-by-fax", "add-inf_receive-by-mail", "add-inf_receive-by-pmail", "is_inf_volunteer"];
    private $requiredFields = ['donor_first-name', 'donor_last-name', "donor_addr1", "donor_city", "donor_state", "donor_zip", "donor_country", "donor_email", "donor_donation-amount"];

    public function __construct($data)
    {
        $this->formData = $data; //$data = $_POST['u_name'] and $_POST['u_pwd']
    }

    public function validateForm()
    {
        //Validating all the form data
        // for ($i = 0; $i < count($this->formFields); $i++) {
        //     if (!array_key_exists($this->formFields[$i], $this->formData)) {
        //         trigger_error("'" . $this->formFields[$i] . "' field does not exist.");
        //         return;
        //     }
        // }

        $this->ValidateRequired();
        return $this->errors;
    }

    private function validateRequired()
    {
        for ($i = 0; $i < count($this->requiredFields); $i++) {
            $value = trim(htmlspecialchars($this->formData[$this->requiredFields[$i]]));
            if (empty($value)) {
                $this->generateErrors($this->requiredFields[$i], $this->requiredFields[$i] . " cannot be empty.");
            }
        }
    }

    private function generateErrors($k, $v)
    {
        $this->errors[$k] = $v;
    }
}
