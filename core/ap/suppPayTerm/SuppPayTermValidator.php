<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\core\ap\suppPayTerm;


/**
 * Description of SuppPayTermValidator
 *
 * @author Priyanka
 */
class SuppPayTermValidator extends \app\cwf\vsla\xmlbo\ValidatorBase {
    
    public function validateSuppPayTermEditForm() {
        // conduct default form validations
        $formView = \app\cwf\vsla\xml\CwfXmlLoader::loadFile($this->modulePath, $this->formName);
        $this->validateUsingForm($this->bo, $formView);
        
        // conduct business rule validations
        $this->validateBusinessRules();
        
    }
    
    private function validateBusinessRules() {

        // Validate Pay Days 
        If($this->bo->pay_days < 0){
            $this->bo->addBRule('Negative Pay Days not allowed.');
        }
        
        // Validate duplicate pay term
        $cmm = new \app\cwf\vsla\data\SqlCommand();
        $cmm->setCommandText('Select pay_term from ac.pay_term where pay_term = :ppay_term and pay_term_id != :ppay_term_id and for_supp = true');
        $cmm->addParam('ppay_term', $this->bo->pay_term);
        $cmm->addParam('ppay_term_id', $this->bo->pay_term_id);
        $result = \app\cwf\vsla\data\DataConnect::getData($cmm);
        if(count($result->Rows())>0) {
            $this->bo->addBRule('Pay Term already exists. Duplicate Pay Term not allowed.');
        }
    }
}
