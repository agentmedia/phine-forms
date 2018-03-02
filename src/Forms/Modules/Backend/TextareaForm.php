<?php

namespace Phine\Bundles\Forms\Modules\Backend;
use Phine\Bundles\Core\Logic\Module\ContentForm;
use App\Phine\Database\Forms\ContentTextarea;
use Phine\Bundles\Forms\Modules\Frontend\Textarea;
use Phine\Framework\FormElements\Fields;
use Phine\Framework\Validation\Integer;

/**
 * The form for the textarea content element
 */
class TextareaForm extends ContentForm
{
    /**
     * The currently edited textarea
     * @var ContentTextarea
     */
    protected $textarea;
    
    /**
     * Provides the correct content element schema
     * @return \App\Phine\Database\Forms\ContentTextareaSchema
     */
    protected function ElementSchema()
    {
        return ContentTextarea::Schema();
    }
    
    /**
     * Gets the associated frontend module
     * @return Textarea Returns the textarea frontend module
     */
    protected function FrontendModule()
    {
        return new Textarea();
    }

    /**
     * Initializes the form
     */
    protected function InitForm()
    {
        $this->textarea = $this->LoadElement();
        $this->AddNameField();
        $this->AddValueField();
        $this->AddLabelField();
        $this->AddRequiredField();
        $this->AddMinLengthField();
        $this->AddMaxLengthField();
        $this->AddPatternField();
        $this->AddTemplateField();
        $this->AddCssClassField();
        $this->AddCssIDField();
        $this->AddSubmit();
    }
    
    /**
     * Adds the required flag field
     */
    private function AddRequiredField()
    {
        $field = new Fields\Checkbox('Required', '1', $this->textarea->GetRequired());
        $this->AddField($field);
    }
    
    private function AddPatternField()
    {
        $name = 'Pattern';
        $field = Fields\Input::Text($name, $this->textarea->GetPattern());
        $this->AddField($field);
        $this->SetTransAttribute($name, 'placeholder');
    }
    
    private function AddMaxLengthField()
    {
        $name = 'MaxLength';
        $value = $this->textarea->GetMaxLength();
        
        $field = Fields\Input::Text($name, $value > 0 ? $value : '');
        $this->AddField($field);
        $this->AddValidator($name, Integer::Positive());
    }
    
    private function AddMinLengthField()
    {
        $name = 'MinLength';
        $value = $this->textarea->GetMinLength();
        
        $field = Fields\Input::Text($name, $value > 0 ? $value : '');
        $this->AddField($field);
        $this->AddValidator($name, Integer::Positive());
    }
    
    /**
     * Adds the name field
     */
    private function AddNameField()
    {
        $name = 'Name';
        $field = Fields\Input::Text($name, $this->textarea->GetName());
        $this->AddField($field);
        $this->SetRequired($name);
    }
    
    /**
     * Adds the label field
     */
    private function AddLabelField()
    {
        $name = 'Label';
        $field = Fields\Input::Text($name, $this->textarea->GetLabel());
        $this->AddField($field);
    }
    /**
     * Adds the value field
     */
    private function AddValueField()
    {
        $name = 'Value';
        $field = new Fields\Textarea($name, $this->textarea->GetValue());
        $this->AddField($field);
    }
    
    /**
     * Attaches the basic properties to the textarea element
     * @return ContentTextarea Returns the textarea content element
     */
    protected function SaveElement()
    {
        $this->textarea->SetLabel($this->Value('Label'));
        $this->textarea->SetName($this->Value('Name'));
        $this->textarea->SetValue($this->Value('Value'));
        $this->textarea->SetPattern($this->Value('Pattern'));
        $this->textarea->SetMinLength((int)$this->Value('MinLength'));
        $this->textarea->SetMaxLength((int)$this->Value('MaxLength'));
        $this->textarea->SetRequired((bool)$this->Value('Required'));
        return $this->textarea;
    }

}

