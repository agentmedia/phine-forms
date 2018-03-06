<?php

namespace Phine\Bundles\Forms\Modules\Backend;
use Phine\Bundles\Core\Logic\Module\ContentForm;
use App\Phine\Database\Forms\ContentSelect;
use App\Phine\Database\Forms\SelectOption;
use App\Phine\Database\Access;

use Phine\Bundles\Forms\Modules\Frontend\Select;
use Phine\Framework\FormElements\Fields\Textarea;
use Phine\Framework\System\Str;
use Phine\Bundles\Forms\Logic\Tree\SelectListProvider;
use Phine\Framework\FormElements\Fields\Checkbox;
use Phine\Framework\FormElements\Fields\Input;

/**
 * The backend form for a select box content element
 */
class SelectForm extends ContentForm
{
    /**
     * The currently edited select content
     * @var ContentSelect
     */
    protected $select;
    
    /**
     * Provides the correct content element schema
     * @return \App\Phine\Database\Forms\ContentSelectSchema Returns the content select schema
     */
    protected function ElementSchema()
    {
        return ContentSelect::Schema();
    }

    /**
     * Gets the assosiated frontend module
     * @return Select Returns the select frontend module
     */
    protected function FrontendModule()
    {
        return new Select();
    }
    
    /**
     * Initializes the form by adding all necessary elements
     */
    protected function InitForm()
    {
        $this->select  = $this->LoadElement();
        
        $this->AddNameField();
        $this->AddValueField();
        $this->AddLabelField();
        $this->AddOptionsField();
        
        $this->AddDisableFrontendValidationField();
        $this->AddRequiredField();
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
        $field = new Checkbox('Required', '1', $this->select->GetRequired());
        $this->AddField($field);
    }
    
    /**
     * Adds the disable frontend validation flag field
     */
    private function AddDisableFrontendValidationField()
    {
        $field = new Checkbox('DisableFrontendValidation', '1', $this->select->GetDisableFrontendValidation());
        $this->AddField($field);
    }
    
    /**
     * Adds the name field
     */
    private function AddNameField()
    {
        $name = 'Name';
        $field = Input::Text($name, $this->select->GetName());
        $this->AddField($field);
        $this->SetRequired($name);
    }
    
    /**
     * Adds the label field
     */
    private function AddLabelField()
    {
        $name = 'Label';
        $field = Input::Text($name, $this->select->GetLabel());
        $this->AddField($field);
    }
    
    /**
     * Adds the optional value field
     */
    private function AddValueField()
    {
        $name = 'Value';
        $field = Input::Text($name, $this->select->GetValue());
        $this->AddField($field);
    }
    /**
     * Adds the option textarea
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
        if (!$this->select->Exists())
        {
            return '';
        }
        $list = new SelectListProvider($this->select);
        $options = $list->ToArray();
        $lines = array();
        foreach ($options as $key=>$value)
        {
            $lines[] = $key . ':' . $value;
        }
        return join("\r\n", $lines);
    }
    
    /**
     * Stores the select content's base properties
     * @return ContentSelect Returns the select content element
     */
    protected function SaveElement()
    {
        $this->select->SetLabel($this->Value('Label'));
        $this->select->SetName($this->Value('Name'));
        $this->select->SetValue($this->Value('Value'));
        $this->select->SetDisableFrontendValidation((bool)$this->Value('DisableFrontendValidation'));
        $this->select->SetRequired((bool)$this->Value('Required'));
        return $this->select;
    }
    
    /**
     * Stores the select options and calls parent AfterSave to redirect
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
        $tblOptions = SelectOption::Schema()->Table();
        $where = $sql->Equals($tblOptions->Field('SelectField'), $sql->Value($this->select->GetID()));
        $opts = SelectOption::Schema()->Delete($where);
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
            $option = new SelectOption();
            $option->SetSelectField($this->select);
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

}

