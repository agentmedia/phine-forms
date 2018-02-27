<?php

namespace Phine\Bundles\Forms\Modules\Backend;
use Phine\Bundles\Core\Logic\Module\ContentForm;
use App\Phine\Database\Forms\ContentSubmit;
use Phine\Bundles\Forms\Modules\Frontend\Submit;
use Phine\Framework\FormElements\Fields;

/**
 * The form for the submit content element
 */
class SubmitForm extends ContentForm
{
    /**
     * The submit content
     * @var ContentSubmit
     */
    protected $submit;
    
    /**
     * Gets the schema of the submit database entity
     * @return \App\Phine\Database\Forms\ContentSubmitSchema
     */
    protected function ElementSchema()
    {
        return ContentSubmit::Schema();
    }

    /**
     * The rendering module for the frontend
     * @return Submit Returns the frontend module
     */
    protected function FrontendModule()
    {
        return new Submit();
    }
    
    /**
     * Initializes the form
     */
    protected function InitForm()
    {
        $this->submit = $this->LoadElement();
        
        $this->AddNameField();
        $this->AddValueField();
        
        $this->AddCssIDField();
        $this->AddCssClassField();
        $this->AddTemplateField();
        $this->AddSubmit();
    }
    
    /**
     * Adds the name field
     */
    private function AddNameField()
    {
        $name = 'Name';
        $field = Fields\Input::Text($name, $this->submit->GetName());
        $this->AddField($field);
        $this->SetRequired($name);
    }
    /**
     * Adds the value (means label for a submit button) field
     */
    private function AddValueField()
    {
        $name = 'Value';
        $field = Fields\Input::Text($name, $this->submit->GetValue());
        $this->AddField($field);
    }
    
    /**
     * Attaches properties to the checkbox element and returns it
     * @return ContentCheckbox Returns the checkbox content element with properties
     */
    protected function SaveElement()
    {
        $this->submit->SetName($this->Value('Name'));
        $this->submit->SetValue($this->Value('Value'));
        return $this->submit;
    }
}

