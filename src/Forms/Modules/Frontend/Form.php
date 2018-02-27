<?php
namespace Phine\Bundles\Forms\Modules\Frontend;
use Phine\Bundles\Core\Logic\Module\FrontendForm;

use App\Phine\Database\Forms\ContentTextfield;
use App\Phine\Database\Forms\ContentTextarea;
use App\Phine\Database\Forms\ContentRadio;
use App\Phine\Database\Forms\ContentCheckbox;
use App\Phine\Database\Forms\ContentSubmit;
use App\Phine\Database\Forms\ContentSelect;
use App\Phine\Database\Forms\ContentForm;

use Phine\Framework\FormElements\Fields;
use Phine\Bundles\Forms\Logic\Enums\TextfieldType;
use Phine\Bundles\Forms\Logic\Tree\SelectListProvider;
use Phine\Bundles\Forms\Logic\Tree\RadioListProvider;
use Phine\Database\Access;
use Phine\Framework\Validation;
use Phine\Framework\System\Http\RequestMethod;
use Phine\Framework\Database\Sql\SetList;
use Phine\Bundles\Forms\Modules\Backend\FormForm;
use Phine\Framework\System\Http\Response;
use Phine\Bundles\Core\Logic\Routing\FrontendRouter;

class Form extends FrontendForm
{
    /**
     * The request method
     * @var RequestMethod
     */
    protected $method;
    /**
     * The form that is about to be rendered
     * @var Form
     */
    private static $current;
    
    /**
     *
     * @var ContentForm
     */
    private $form;
    /**
     * Gets the currently rendered form
     * @return Form
     */
    static function Current()
    {
        return self::$current;
    }
    
    /**
     * Initializes the form
     * @return bool
     */
    protected function Init()
    {
        self::$current = $this;
        $this->form = ContentForm::Schema()->ByContent($this->Content());
        $this->method = $this->Method();
        $this->FetchFields($this->item);
        return parent::Init();
    }
    
    protected function AfterGather()
    {
        self::$current = null;
        parent::AfterGather();
    }
    
    /**
     * Fetches all form field content elements and adds it to this form in an appropriate manner
     * @param mixed $parent
     */
    private function FetchFields($parent)
    {
        $child= $this->tree->FirstChildOf($parent);
        while ($child)
        {
            $this->HandleField($child);
            $this->FetchFields($child);
            $child = $this->tree->NextOf($child);   
        }
    }
    
    private function HandleField($item)
    {
        $content = $this->tree->ContentByItem($item);
        switch ($content->GetType())
        {
            case Textfield::MyType():
                $this->HandleTextfield(ContentTextfield::Schema()->ByContent($content));
                break;
            
            case Textarea::MyType():
                $this->HandleTextarea(ContentTextarea::Schema()->ByContent($content));
                break;
            
            case Checkbox::MyType():
                $this->HandleCheckbox(ContentCheckbox::Schema()->ByContent($content));
                break;
            
            case Select::MyType():
                $this->HandleSelect(ContentSelect::Schema()->ByContent($content));
                break;
            
            case Radio::MyType():
                $this->HandleRadio(ContentRadio::Schema()->ByContent($content));
                break;
            
            case Submit::MyType():
                $this->HandleSubmit(ContentSubmit::Schema()->ByContent($content));
                break;
        }
    }
    
    private function HandleTextfield(ContentTextfield $textfield)
    {
        $name = $textfield->GetName();
        $field = Fields\Input::Text($name, $textfield->GetValue());
        if ($textfield->GetMaxLength())
        {
            $field->SetHtmlAttribute('maxlength', $textfield->GetMaxLength());
        }
        $this->AddField($field, !$textfield->GetLabel(), $textfield->GetLabel());
        if ($textfield->GetRequired())
        {
            $this->SetRequired($name);
        }
        $this->AddTextfieldValidations($textfield);
    }
    
    private function AddTextfieldValidations(ContentTextfield $textfield)
    {
        $validators = array();
        switch($textfield->GetType())
        {
            case (string)TextfieldType::Email():
                $validators[] = Validation\PhpFilter::EMail();
                break;
            
            case (string)TextfieldType::Url():
                $validators[] = Validation\PhpFilter::Url();
                break;
            /*
             * Missing numeric validator; add to core
            case (string)TextfieldType::Numeric():
                $validators[] = Validation\
                break;
            */
        }
        if ($textfield->GetPattern())
        {
            $validators[] = new Validation\RegExp($textfield->GetPattern());
        }
        foreach ($validators as $validator)
        {
            $this->AddValidator($textfield->GetName(), $validator);
        }
    }
    
    
    private function HandleTextarea(ContentTextarea $textarea)
    {
        $field = new Fields\Textarea($textarea->GetName(), $textarea->GetValue());
        $this->AddField($field, !$textarea->GetLabel(), $textarea->GetLabel());
        if ($textarea->GetRequired())
        {
            $this->SetRequired($textarea->GetName());
        }
    }
    
    
    private function HandleSubmit(ContentSubmit $submit)
    {
        $this->AddSubmit($submit->GetName(), $submit->GetValue());
    }
    
    private function HandleSelect(ContentSelect $select)
    {
        $list = new SelectListProvider($select);
        $field = new Fields\Select($select->GetName(), $select->GetValue(), $list->ToArray());
        $this->AddField($field, false, $select->GetLabel());
        if ($select->GetRequired())
        {
            $this->SetRequired($select->GetName());
        }
       
    }
    
    private function HandleCheckbox(ContentCheckbox $checkbox)
    {
        $field = new Fields\Checkbox($checkbox->GetName(), $checkbox->GetCheckedValue());
        if ($checkbox->GetChecked())
        {
            $field->SetChecked();
        }
        $this->AddField($field, !$checkbox->GetLabel(), $checkbox->GetLabel());
        if ($checkbox->GetRequired())
        {
            $this->SetRequired($checkbox->GetName());
        }
    }
    
    private function HandleRadio(ContentRadio $radio)
    {
        $list = new RadioListProvider($radio);
        $field = new Fields\Radio($radio->GetName(), $radio->GetValue(), $list->ToArray());
        
        $this->AddField($field, !$radio->GetLabel(), $radio->GetLabel());
        if ($radio->GetRequired())
        {
            $this->SetRequired($radio->GetName());
        }
    }
    
    protected function OnSuccess()
    {
        $table = $this->form->GetSaveTo();
        if ($table)
        {
            $this->SaveToTable($table);
        }
        $email = $this->form->GetSendTo();
        if ($email)
        {
            $this->SendTo($email);
        }
        $redirectUrl = $this->form->GetRedirectUrl();
        if ($redirectUrl)
        {
            Response::Redirect(FrontendRouter::Url($redirectUrl));
            return true;
        }        
    }
    
    /**
     * Sends an email
     * @param string $email
     */
    private function SendTo($email)
    {
        $texts = array();
        $subject = Trans('Core.Forms.Form.DefaultSubject');
        $mailer = new \PHPMailer();
        $mailer->isHTML(false);
        $mailer->CharSet = 'UTF-8';
        $mailer->setFrom($this->form->GetSendFrom());
        foreach($this->Elements()->GetElements() as $element)
        {
            if ($element instanceof Fields\Submit)
            {
                continue;
            }
            $name = $element->GetName();
            if ($name == 'Subject')
            {
                $subject = $this->Value($name);
            }
            else if ($name == 'ReplyTo')
            {
                $mailer->addReplyTo($this->Value($name));
            }
            $texts[] = $name . ": " . $this->Value($name);
        }
        $message = join("\r\n", $texts);
        $mailer->Subject = $subject;
        $mailer->Body = $message;
        $mailer->addAddress($email);
        $mailer->send();
    }
    
    /**
     * Stores the results in a database table
     * @param string $table The table name
     */
    private function SaveToTable($table)
    {
        $sql = Access::SqlBuilder();
        $fields = array();
        $setList = null;
        foreach ($this->Elements()->GetElements() as $element)
        {
            $this->HandleElement($table, $element, $fields, $setList);
        }
        if ($setList)
        {
            Access::Connection()->ExecuteQuery($sql->Insert($sql->Table($table, $fields), $setList));
        }
    }
    
    private function HandleElement($table, Fields\FormField $element, array &$fields, SetList &$setList = null)
    {
        if ($element instanceof Fields\Submit)
        {
            return;
        }
        $name = $element->GetName();
        $fieldInfo = Access::Connection()->GetFieldInfo($table, $name);
        if (!$fieldInfo)
        {
            return; 
        }
        $fields[] = $name;
        if (!$setList)
        {
            $setList = Access::SqlBuilder()->SetList($name, $this->Value($name));
        }
        else
        {
            $setList->Add($name, $this->Value($name));
        }
    }
    
    public function ContentForm()
    {
        return new FormForm();
    }
    public function AllowChildren()
    {
        return true;
    }
    
    public function AllowCustomTemplates()
    {
        return true;
    }
    
    protected function Method()
    {
        return RequestMethod::ByValue($this->form->GetMethod());
    }
    
    public function BackendName()
    {
        $name = parent::BackendName();
        if ($this->CssID())
        {
            $name .= ' #' . $this->CssID();
        }
        else if ($this->CssClass())
        {
            $name .= ' .' . $this->CssClass();
        }
        return $name;
    }
}

