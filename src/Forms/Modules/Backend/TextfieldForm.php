<?php

namespace Phine\Bundles\Forms\Modules\Backend;
use Phine\Bundles\Core\Logic\Module\ContentForm;
use App\Phine\Database\Forms\ContentTextfield;
use Phine\Bundles\Forms\Modules\Frontend\Textfield;
use Phine\Framework\FormElements\Fields\Input;
use Phine\Bundles\Forms\Logic\Enums\TextfieldType;
use Phine\Framework\FormElements\Fields\Select;
use Phine\Framework\Validation\Integer;
use Phine\Framework\FormElements\Fields\Checkbox;

class TextfieldForm extends ContentForm
{
    /**
     * The textfield content
     * @var ContentTextfield
     */
    protected $textfield;
    
    /**
     * Gets the schema of the textfield database entity
     * @return \App\Phine\Database\Forms\ContentTextfieldSchema
     */
    protected function ElementSchema()
    {
        return ContentTextfield::Schema();
    }

    /**
     * The render module for the frontend
     * @return Textfield Returns the frontend module
     */
    protected function FrontendModule()
    {
        return new Textfield();
    }

    protected function InitForm()
    {
        $this->textfield = $this->LoadElement();
        $this->AddTypeField();
        $this->AddRequiredField();
        $this->AddNameField();
        $this->AddLabelField();
        $this->AddPatternField();
        $this->AddMaxLengthField();
        $this->AddValueField();
        
        $this->AddCssIDField();
        $this->AddCssClassField();
        $this->AddTemplateField();
        $this->AddSubmit();
    }
    
    private function AddRequiredField()
    {
        $field = new Checkbox('Required', '1', $this->textfield->GetRequired());
        $this->AddField($field);
    }
    
    /**
     * Adds the type field
     */
    private function AddTypeField()
    {
        $name = 'Type';
        $select = new Select($name, $this->textfield->GetType());
        $select->AddOption('', Trans('Core.PleaseSelect'));
        $values = TextfieldType::AllowedValues();
        foreach ($values as $value)
        {
            $select->AddOption($value, Trans('Forms.TextfieldType.' . ucfirst($value)));
        }
        $this->AddField($select);
        $this->SetRequired($name);
    }
    
    private function AddNameField()
    {
        $name = 'Name';
        $field = Input::Text($name, $this->textfield->GetName());
        $this->AddField($field);
        $this->SetRequired($name);
    }
    
    private function AddLabelField()
    {
        $name = 'Label';
        $field = Input::Text($name, $this->textfield->GetLabel());
        $this->AddField($field);
    }
    
    private function AddPatternField()
    {
        $name = 'Pattern';
        $field = Input::Text($name, $this->textfield->GetPattern());
        $this->AddField($field);
        $this->SetTransAttribute($name, 'placeholder');
    }
    
    private function AddMaxLengthField()
    {
        $name = 'MaxLength';
        $value = $this->textfield->GetMaxLength();
        
        $field = Input::Text($name, $value > 0 ? $value : '');
        $this->AddField($field);
        $this->AddValidator($name, Integer::Positive());
    }
    
    private function AddValueField()
    {
        $name = 'Value';
        $field = Input::Text($name, $this->textfield->GetValue());
        $this->AddField($field);
    }
    protected function SaveElement()
    {
        $this->textfield->SetLabel($this->Value('Label'));
        $this->textfield->SetName($this->Value('Name'));
        $this->textfield->SetPattern($this->Value('Pattern'));
        $this->textfield->SetType($this->Value('Type'));
        $this->textfield->SetMaxLength((int)$this->Value('MaxLength'));
        $this->textfield->SetValue($this->Value('Value'));
        $this->textfield->SetRequired((bool)$this->Value('Required'));
        return $this->textfield;
    }

}

