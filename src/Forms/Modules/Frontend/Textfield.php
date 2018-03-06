<?php

namespace Phine\Bundles\Forms\Modules\Frontend;
use Phine\Bundles\Forms\Modules\Frontend\Base\FieldModule;
use App\Phine\Database\Forms\ContentTextfield;
use Phine\Bundles\Forms\Logic\Enums\TextfieldType;
use Phine\Bundles\Forms\Modules\Backend\TextfieldForm;


/**
 * The textfield renderer
 */
class Textfield extends FieldModule
{
    /**
     * The field label
     * @var string
     */
    protected $label;
    
    /**
     * The field name
     * @var string
     */
    protected $name;
    
    /**
     * The field value
     * @var string
     */
    protected $value;
    
    /**
     * The pattern attribute
     * @var string
     */
    protected $pattern;
    
    /**
     * The field type
     * @var TextfieldType
     */
    protected $type;
    
    /**
     * The dom id
     * @var string
     */
    protected $id;
   
   /**
     * The min field length
     * @var int
     */
    protected $minLength;
    
    /**
     * The max field length
     * @var int
     */
    protected $maxLength;
    
    /**
     * True if required
     * @var required
     */
    protected $required;
    
    
    /**
     * Children not allowed
     * @return boolean Returns false; no children allowed
     */
    public function AllowChildren()
    {
        return false;
    }
    
    /**
     * Custom templates allowed
     * @return boolean Returns true, custom templates allowed
     */
    public function AllowCustomTemplates()
    {
        return true;
    }
    
    /**
     * 
     * @return boolean
     */
    protected function Init()
    {
        $textfield = ContentTextfield::Schema()->ByContent($this->Content());
        $disableValidation = $textfield->GetDisableFrontendValidation();
        $this->label = $textfield->GetLabel();
        $this->name = $textfield->GetName();
        $this->pattern = $textfield->GetPattern();
        $this->type = $disableValidation ? TextfieldType::Text() : TextfieldType::ByValue($textfield->GetType());
        $this->minLength = $disableValidation ? 0 : (int)$textfield->GetMinLength();
        $this->maxLength = $disableValidation ? 0 : (int)$textfield->GetMaxLength();
        $this->required = $disableValidation ? false : $textfield->GetRequired();
        $this->value = $textfield->GetValue();
        $this->id = $this->CssID() ? $this->CssID() : $this->name;
        
        $this->RealizeField($this->name);
        return parent::Init();
    }
    
    /**
     * Gets the related backend form
     * @return TextfieldForm Returns the form for the textarea settings
     */
    public function ContentForm()
    {
        return new TextfieldForm();
    }
    
    public function BackendName()
    {
        $name = parent::BackendName();
        if (!$this->Content())
        {
            return $name;
        }
        $textfield = ContentTextfield::Schema()->ByContent($this->Content());
        $name .= ' : ' . $textfield->GetName();
        return $name;
    }
}