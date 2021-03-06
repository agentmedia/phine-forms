<?php
namespace Phine\Bundles\Forms\Modules\Frontend;
use Phine\Bundles\Core\Logic\Module\FrontendForm;

use App\Phine\Database\Forms\ContentTextfield;
use App\Phine\Database\Forms\ContentNumberfield;
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
use PHPMailer\PHPMailer\PHPMailer;

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
            
            case Numberfield::MyType():
                $this->HandleNumberfield(ContentNumberfield::Schema()->ByContent($content));
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
        
        $this->AddField($field, !$textfield->GetLabel(), $textfield->GetLabel());
        if ($textfield->GetRequired())
        {
            $this->SetRequired($name, self::TypeTranslationPrefix(Textfield::MyType()));
        }
        $this->AddTextfieldValidations($textfield);
    }
    
    private function HandleNumberfield(ContentNumberfield $numberfield)
    {
        $name = $numberfield->GetName();
        $field = Fields\Input::Text($name, $numberfield->GetValue());
        
        $this->AddField($field, !$numberfield->GetLabel(), $numberfield->GetLabel());
        if ($numberfield->GetRequired()) {
            $this->SetRequired($name, self::TypeTranslationPrefix(Numberfield::MyType()));
        }
        $min = $numberfield->GetMin();
        $max = $numberfield->GetMax();
        $field->AddValidator(new Validation\Number($min, $max, true, true, self::TypeTranslationPrefix(Numberfield::MyType())));
    }
    private function GetStringLengthValidation($minLength, $maxLength) {
        if (!$minLength && !$maxLength) {
            return null;
        }
        if (!$maxLength) {
            $maxLength = PHP_INT_MAX;
        }
        return new Validation\StringLength($minLength, $maxLength);
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
        }
        $strlenValidator = $this->GetStringLengthValidation($textfield->GetMinLength(), $textfield->GetMaxLength());
        if ($strlenValidator) {
            $validators[] = $strlenValidator;
        }
        if ($textfield->GetPattern())
        {
            $validators[] = new Validation\RegExp($textfield->GetPattern());
        }
        foreach ($validators as $validator)
        {
            $this->AddValidator($textfield->GetName(), $validator, self::TypeTranslationPrefix(Textfield::MyType()));
        }
    }
    
    /**
     * The short translation prefix without (Forms.Form.$type)
     * ret
     * @return string
     */
    private static function TypeTranslationPrefix($type) {
        return str_replace('-', '.', $type ) . '.';
    }
    
    
    private function HandleTextarea(ContentTextarea $textarea)
    {
        $name = $textarea->GetName();
        $field = new Fields\Textarea($name, $textarea->GetValue());
        $this->AddField($field, !$textarea->GetLabel(), $textarea->GetLabel());
        if ($textarea->GetRequired()) {
            $this->SetRequired($name, self::TypeTranslationPrefix(Textarea::MyType()));
        }
        if ($textarea->GetPattern()) {
            $this->AddValidator($name, new Validation\RegExp($textarea->GetPattern()), self::TypeTranslationPrefix(Textarea::MyType()));
        }
        $strlenValidation = $this->GetStringLengthValidation($textarea->GetMinLength(), $textarea->GetMaxLength());
        if ($strlenValidation) {
            $this->AddValidator($name, $strlenValidation, self::TypeTranslationPrefix(Textarea::MyType()));
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
            $this->SetRequired($select->GetName(), self::TypeTranslationPrefix(Select::MyType()));
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
            $this->SetRequired($checkbox->GetName(), self::TypeTranslationPrefix(Checkbox::MyType()));
        }
    }
    
    private function HandleRadio(ContentRadio $radio)
    {
        $list = new RadioListProvider($radio);
        $field = new Fields\Radio($radio->GetName(), $radio->GetValue(), $list->ToArray());
        
        $this->AddField($field, !$radio->GetLabel(), $radio->GetLabel());
        if ($radio->GetRequired())
        {
            $this->SetRequired($radio->GetName(), self::TypeTranslationPrefix(Radio::MyType()));
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
        $mailer = new PHPMailer();
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
    
    
    /**
     * Gets the actual value of a field
     * @param string $fieldName The name of the field
     * @return string Returns the value as submitted ot the default value
     */
    public function GetValue($fieldName, $defaultValue) {
        if ($this->IsTriggered()) {
            return $this->Value($fieldName);
        }
        return $defaultValue;
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

