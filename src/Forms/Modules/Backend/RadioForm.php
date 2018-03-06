<?php

namespace Phine\Bundles\Forms\Modules\Backend;
use Phine\Bundles\Core\Logic\Module\ContentForm;
use App\Phine\Database\Forms\ContentRadio;
use App\Phine\Database\Forms\RadioOption;
use App\Phine\Database\Access;

use Phine\Bundles\Forms\Modules\Frontend\Radio;
use Phine\Framework\FormElements\Fields\Textarea;
use Phine\Framework\System\Str;
use Phine\Bundles\Forms\Logic\Tree\RadioListProvider;
use Phine\Framework\FormElements\Fields\Checkbox;
use Phine\Framework\FormElements\Fields\Input;

/**
 * The backend form for a radio box content element
 */
class RadioForm extends ContentForm
{
    /**
     * The currently edited radio content
     * @var ContentRadio
     */
    protected $radio;
    
    /**
     * Provides the correct content element schema
     * @return \App\Phine\Database\Forms\ContentRadioSchema Returns the content radio schema
     */
    protected function ElementSchema()
    {
        return ContentRadio::Schema();
    }

    /**
     * Gets the assosiated frontend module
     * @return Radio Returns the radio frontend module
     */
    protected function FrontendModule()
    {
        return new Radio();
    }
    
    /**
     * Initializes the form by adding all necessary elements
     */
    protected function InitForm()
    {
        $this->radio = $this->LoadElement();
        
        $this->AddNameField();
        $this->AddValueField();
        $this->AddLabelField();
        $this->AddOptionsField();
        
        $this->AddRequiredField();
        $this->AddDisableFrontendValidationField();
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
        $field = new Checkbox('Required', '1', $this->radio->GetRequired());
        $this->AddField($field);
    }
    
    /**
     * Adds the disable frontend validation flag field
     */
    private function AddDisableFrontendValidationField()
    {
        $field = new Checkbox('DisableFrontendValidation', '1', $this->radio->GetDisableFrontendValidation());
        $this->AddField($field);
    }
    /**
     * Adds the name field
     */
    private function AddNameField()
    {
        $name = 'Name';
        $field = Input::Text($name, $this->radio->GetName());
        $this->AddField($field);
        $this->SetRequired($name);
    }
    
    /**
     * Adds the label field
     */
    private function AddLabelField()
    {
        $name = 'Label';
        $field = Input::Text($name, $this->radio->GetLabel());
        $this->AddField($field);
    }
    
    /**
     * Adds the optional value field
     */
    private function AddValueField()
    {
        $name = 'Value';
        $field = Input::Text($name, $this->radio->GetValue());
        $this->AddField($field);
    }
    /**
     * Adds the options textarea
     */
    private function AddOptionsField()
    {
        $name = 'Options';
        $field = new Textarea($name, $this->OptionsString());
        $this->AddField($field);
        $this->SetTransAttribute($name, 'placeholder');
        $this->SetRequired($name);
    }
    
    /**
     * Gets the options as string for the textarea value
     * @return string The string representation of the options
     */
    private function OptionsString()
    {
        if (!$this->radio->Exists())
        {
            return '';
        }
        $list = new RadioListProvider($this->radio);
        $options = $list->ToArray();
        $lines = array();
        foreach ($options as $key=>$value)
        {
            $lines[] = $key . ':' . $value;
        }
        return join("\r\n", $lines);
    }
    
    /**
     * Stores the radio content's base properties
     * @return ContentRadio Returns the radio content element
     */
    protected function SaveElement()
    {
        $this->radio->SetLabel($this->Value('Label'));
        $this->radio->SetName($this->Value('Name'));
        $this->radio->SetValue($this->Value('Value'));
        $this->radio->SetRequired((bool)$this->Value('Required'));
        $this->radio->SetDisableFrontendValidation((bool)$this->Value('DisableFrontendValidation'));
        return $this->radio;
    }
    
    /**
     * Stores the radio options and calls parent AfterSave to redirect
     */
    protected function AfterSave()
    {
        $this->ClearOptions();
        $this->SaveOptions($this->FetchOptions());
        parent::AfterSave();
    }
    
    /**
     * Clears the options before saving new options
     */
    private function ClearOptions()
    {
        $sql = Access::SqlBuilder();
        $tblOptions = RadioOption::Schema()->Table();
        $where = $sql->Equals($tblOptions->Field('RadioField'), $sql->Value($this->radio->GetID()));
        RadioOption::Schema()->Delete($where);
    }
    
    /**
     * Saves the options array into the database
     * @param array $options The options
     */
    private function SaveOptions(array $options)
    {
        $prev = null;
        foreach ($options as $value=>$text)
        {
            $option = new RadioOption();
            $option->SetRadioField($this->radio);
            $option->SetPrevious($prev);
            $option->SetText($text);
            $option->SetValue($value);
            $option->Save();
            $prev = $option;
        }
    }
    /**
     * Fetches submitted options as array
     * @return array Returns the submitted options as value=>text array
     */
    private function FetchOptions()
    {
        $strOptions = $this->Value('Options');
        $lines = Str::SplitLines($strOptions);
        $result = array();
        foreach ($lines as $line)
        {
            $dpPos = strpos($line, ':');
            if ($dpPos !== false)
            {
                $value = trim(substr($line, 0, $dpPos));
                $text = trim(substr($line, $dpPos + 1));
            }
            else
            {
                $value = $line;
                $text = '';
            }
            $result[$value] = $text;
        }
        return $result;
    }
    protected function Wordings()
    {
        $wordings = array();
        $wordings[] = 'Validation.Required.Missing';
        return $wordings;
    }
}