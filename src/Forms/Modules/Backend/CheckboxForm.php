<?php

namespace Phine\Bundles\Forms\Modules\Backend;
use Phine\Bundles\Core\Logic\Module\ContentForm;
use App\Phine\Database\Forms\ContentCheckbox;
use Phine\Bundles\Forms\Modules\Frontend\Checkbox;
use Phine\Framework\FormElements\Fields;

/**
 * The form for the checkbox content element
 */
class CheckboxForm extends ContentForm
{
    /**
     * The checkbox content
     * @var ContentCheckbox
     */
    protected $checkbox;
    
    /**
     * Gets the schema of the checkbox database entity
     * @return \App\Phine\Database\Forms\ContentCheckboxSchema
     */
    protected function ElementSchema()
    {
        return ContentCheckbox::Schema();
    }

    /**
     * The render module for the frontend
     * @return Checkbox Returns the frontend module
     */
    protected function FrontendModule()
    {
        return new Checkbox();
    }
    
    /**
     * Initializes the form
     */
    protected function InitForm()
    {
        $this->checkbox = $this->LoadElement();
        $this->AddRequiredField();
        $this->AddNameField();
        $this->AddLabelField();
        $this->AddCheckedField();
        $this->AddCheckedValueField();
        $this->AddDisableFrontendValidationField();
        $this->AddCssIDField();
        $this->AddCssClassField();
        $this->AddTemplateField();
        $this->AddSubmit();
    }
    
    /**
     * Adds the required flag field
     */
    private function AddRequiredField()
    {
        $field = new Fields\Checkbox('Required', '1', $this->checkbox->GetRequired());
        $this->AddField($field);
    }
    
    /**
     * Adds the disable frontend validation flag field
     */
    private function AddDisableFrontendValidationField()
    {
        $field = new Fields\Checkbox('DisableFrontendValidation', '1', $this->checkbox->GetDisableFrontendValidation());
        $this->AddField($field);
    }
    
    /**
     * Adds the checked flag field
     */
    private function AddCheckedField()
    {
        $field = new Fields\Checkbox('Checked', '1', $this->checkbox->GetChecked());
        $this->AddField($field);
    }
    
    /**
     * Adds the name field
     */
    private function AddNameField()
    {
        $name = 'Name';
        $field = Fields\Input::Text($name, $this->checkbox->GetName());
        $this->AddField($field);
        $this->SetRequired($name);
    }
    /**
     * Adds the label field
     */
    private function AddLabelField()
    {
        $name = 'Label';
        $field = Fields\Input::Text($name, $this->checkbox->GetLabel());
        $this->AddField($field);
    }
    
    /**
     * Adds the checked value field
     */
    private function AddCheckedValueField()
    {
        $name = 'CheckedValue';
        $value = $this->checkbox->GetCheckedValue();  
        $field = Fields\Input::Text($name, $value ? $value : '1');
        $this->AddField($field);
        $this->SetRequired($name);
    }
    
    /**
     * Attaches properties to the checkbox element and returns it
     * @return ContentCheckbox Returns the checkbox content element with properties
     */
    protected function SaveElement()
    {
        $this->checkbox->SetLabel($this->Value('Label'));
        $this->checkbox->SetName($this->Value('Name'));
        $this->checkbox->SetChecked((bool)$this->Value('Checked'));
        $this->checkbox->SetCheckedValue($this->Value('CheckedValue'));
        $this->checkbox->SetRequired((bool)$this->Value('Required'));
        $this->checkbox->SetDisableFrontendValidation((bool)$this->Value('DisableFrontendValidation'));
        
        return $this->checkbox;
    }
    
    protected function Wordings()
    {
        $wordings = array();
        $wordings[] = 'Validation.Required.Missing';
        return $wordings;
    }

}

