<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\core\ac\bankReceipt;

/**
 * Description of BankReceiptValidator
 *
 * @author Kaustubh
 */

class BankReceiptValidator extends \app\core\ac\base\VoucherBaseValidator {
    
    public function validateBankReceiptEditForm() {
        // conduct default form validations
        $formView = \app\cwf\vsla\xml\CwfXmlLoader::loadFile($this->modulePath, $this->formName);
        $this->validateUsingForm($this->bo, $formView);
        
        // conduct business rule validations
        $this->validateBusinessRules();
    }
    
    protected function validateBusinessRules() {       
        parent::validateBusinessRules();
    }
}