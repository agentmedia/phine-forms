<?php
namespace Phine\Bundles\Forms\Modules\Backend;
use Phine\Bundles\Core\Logic\Module\ContentForm as ContentFormBase;
use Phine\Bundles\Forms\Modules\Frontend\Form;
use App\Phine\Database\Forms\ContentForm;
use Phine\Framework\FormElements\Fields\Select;
use Phine\Framework\FormElements\Fields\Input;
use Phine\Framework\Validation\PhpFilter;
use App\Phine\Database\Access;
use Phine\Bundles\Core\Snippets\FormParts\PageUrlSelector;
/**
 * The backend form for a form
 */
class FormForm extends ContentFormBase
{
    /**
     *
     * @var ContentForm
     */
    private $form;
    
    /**
     * The page url selector snipper
     * @var PageUrlSelector
     */
    protected $selector;
    protected function ElementSchema()
    {
        return ContentForm::Schema();
    }

    protected function FrontendModule()
    {
        return new Form();
    }

    protected function InitForm()
    {
        $this->form = $this->LoadElement();
       
        $this->AddMethodField();
        $this->AddSaveToField();
        $this->AddSendFromField();
        $this->AddSendToField();
        //TODO: RedirectUrl!;
        $this->AddPageSelector();
        $this->AddCssClassField();
        $this->AddCssIDField();
        $this->AddTemplateField();
        $this->AddSubmit();
    }
    
    private function AddPageSelector()
    {
        $name = 'RedirectUrl';
        $this->selector = new PageUrlSelector($name, Trans($this->Label($name)), $this->form->GetRedirectUrl());
        $this->Elements()->AddElement($name, $this->selector);
    }
    
    private function AddMethodField()
    {
        $name = 'Method';
        $value = $this->form->GetMethod();
        if (!$value)
        {
            $value = 'POST';
        }
        $select = new Select($name, $value);
        $select->AddOption('POST', Trans('Forms.FormForm.Method.Post'));
        $select->AddOption('GET', Trans('Forms.FormForm.Method.Get'));
        $this->AddField($select);
        $this->SetRequired($name);
    }
    
    private function AddSendFromField()
    {
        $name = 'SendFrom';
        $field = Input::Text($name, $this->form->GetSendFrom());
        $this->AddField($field);
        $this->AddValidator($name, PhpFilter::EMail());
        if ($this->Value('SendTo') || ($this->IsTriggered() && !$this->Value('SaveTo')))
        {
            $this->SetRequired($name);
        }
    }
    
    private function AddSendToField()
    {
        $name = 'SendTo';
        $field = Input::Text($name, $this->form->GetSendTo());
        $this->AddField($field);
        $this->AddValidator($name, PhpFilter::EMail());
        if ($this->Value('SendFrom') || ($this->IsTriggered() && !$this->Value('SaveTo')))
        {
            $this->SetRequired($name);
        }
    }
    
    private function AddSaveToField()
    {
        $name = 'SaveTo';
        $field = new Select($name, $this->form->GetSaveTo());
        $field->AddOption('', Trans('Forms.FormForm.SaveTo.None'));
        $tables = Access::Connection()->GetTables();
        foreach ($tables as $table)
        {
            $field->AddOption($table, $table);
        }
        $this->AddField($field);
        if (!$this->IsTriggered() && !$this->Value('SendFrom') && !$this->Value('SendTo') )
        {
            $this->SetRequired($name);
        }
    }

    /**
     * Attaches properties and returns the form content
     * @return ContentForm
     */
    protected function SaveElement()
    {
        $this->form->SetMethod($this->Value('Method'));
        $this->form->SetSaveTo($this->Value('SaveTo'));
        $this->form->SetSendFrom($this->Value('SendFrom'));
        $this->form->SetSendTo($this->Value('SendTo'));
        $this->form->SetRedirectUrl($this->selector->Save($this->form->GetRedirectUrl()));
        return $this->form;
    }
    
    
}
