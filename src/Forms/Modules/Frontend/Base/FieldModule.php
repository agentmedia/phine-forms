<?php

namespace Phine\Bundles\Forms\Modules\Frontend\Base;
use Phine\Bundles\Core\Logic\Module\FrontendModule;
use Phine\Bundles\Forms\Modules\Frontend\Form;

/**
 * The field module
 */
abstract class FieldModule extends FrontendModule
{   
    /**
     *
     * @var string
     */
    protected $checkFailed;
    
    /**
     * The field error messages
     * @var string[]
     */
    protected $errors;
    
    /**
     * The css classes
     * @var string
     */
    protected $classes;
    protected function RealizeField($fieldName)
    {
        $this->checkFailed = false;
        $this->errors = array();
        $this->classes = $this->CssClass();
        $form = Form::Current();
        if (!$form)
        {
            return;
        }
        $field = $form->GetElement($fieldName);
        if (!$field)
        {
            return;
        }
        $this->checkFailed = $field->CheckFailed();
        if (!$this->checkFailed)
        {
            return;
        }
        $this->classes = $this->classes ? $this->classes . ' error' : 'error';
        $validators = $field->GetValidators();
        foreach($validators as $validator)
        {
            $error = $validator->GetError();
            if ($error)
            {
                $this->errors[] = $error;
            }
        }
    }
}
