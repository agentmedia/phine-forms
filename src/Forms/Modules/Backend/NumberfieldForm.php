<?php

namespace Phine\Bundles\Forms\Modules\Backend;
use Phine\Bundles\Core\Logic\Module\ContentForm;
use App\Phine\Database\Forms\ContentNumberfield;
use Phine\Bundles\Forms\Modules\Frontend\Numberfield;
use Phine\Framework\FormElements\Fields\Input;
use Phine\Framework\FormElements\Fields\Checkbox;
use Phine\Framework\Validation\Number;

class NumberfieldForm extends ContentForm
{
    /**
     * The numberfield content
     * @var ContentNumberfield
     */
    protected $numberfield;
    
    /**
     * Gets the schema of the numberfield database entity
     * @return \App\Phine\Database\Forms\ContentNumberfieldSchema
     */
    protected function ElementSchema()
    {
        return ContentNumberfield::Schema();
    }

    /**
     * The render module for the frontend
     * @return Numberfield Returns the frontend module
     */
    protected function FrontendModule()
    {
        return new Numberfield();
    }

    protected function InitForm()
    {
        $this->numberfield = $this->LoadElement();
        $this->AddRequiredField();
        $this->AddNameField();
        $this->AddLabelField();
        $this->AddMinField();
        $this->AddMaxField();
        $this->AddStepField();
        $this->AddValueField();
        
        $this->AddCssIDField();
        $this->AddCssClassField();
        $this->AddTemplateField();
        $this->AddSubmit();
    }
    
    private function AddRequiredField()
    {
        $field = new Checkbox('Required', '1', $this->numberfield->GetRequired());
        $this->AddField($field);
    }
    
  
    
    private function AddNameField()
    {
        $name = 'Name';
        $field = Input::Text($name, $this->numberfield->GetName());
        $this->AddField($field);
        $this->SetRequired($name);
    }
    
    private function AddLabelField()
    {
        $name = 'Label';
        $field = Input::Text($name, $this->numberfield->GetLabel());
        $this->AddField($field);
    }
    
    private function AddMaxField()
    {
        $name = 'Max';
        $value = $this->numberfield->GetMax();
        
        $field = Input::Text($name, (string)$value);
        $this->AddField($field);
        $this->AddValidator($name, Number::Any());
    }
    
    private function AddMinField()
    {
        $name = 'Min';
        $value = $this->numberfield->GetMin();
        
        $field = Input::Text($name, (string)$value);
        $this->AddField($field);
        $this->AddValidator($name, Number::Any());
    }
    
     private function AddStepField()
    {
        $name = 'Step';
        $value = $this->numberfield->GetStep();
        
        $field = Input::Text($name, $value > 0 ? $value : '');
        $this->AddField($field);   
        $this->AddValidator($name, Number::PositiveOrNull());
    }
    
    private function AddValueField()
    {
        $name = 'Value';
        $field = Input::Text($name, $this->numberfield->GetValue());
        $this->AddField($field);
    }
    protected function SaveElement()
    {
        $this->numberfield->SetLabel($this->Value('Label'));
        $this->numberfield->SetName($this->Value('Name'));
        
        $this->numberfield->SetMax($this->Value('Max') !== '' ? (float)$this->Value('Max') : NULL);
        $this->numberfield->SetMin($this->Value('Min') !== '' ? (float)$this->Value('Min') : NULL);
        $this->numberfield->SetStep((float)$this->Value('Step'));

        $this->numberfield->SetValue($this->Value('Value'));
        $this->numberfield->SetRequired((bool)$this->Value('Required'));
        return $this->numberfield;
    }

}

