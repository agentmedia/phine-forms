<?php

namespace Phine\Bundles\Forms\Modules\Frontend;
use Phine\Bundles\Forms\Modules\Frontend\Base\FieldModule;
use App\Phine\Database\Forms\ContentCheckbox;
use Phine\Bundles\Forms\Modules\Backend\CheckboxForm;


/**
 * The checkbox renderer
 */
class Checkbox extends FieldModule
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
     * The checked value
     * @var string
     */
    protected $checkedValue;
    
    /**
     * True if checked
     * @var boolean
     */
    protected $checked;
    
    /**
     * True if required
     * @var boolean
     */
    protected $required;
    
    /**
     * The dom id
     * @var string
     */
    protected $id;
    
    
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
        $checkbox = ContentCheckbox::Schema()->ByContent($this->Content());
        $disableValidation = $checkbox->GetDisableFrontendValidation();
        $this->label = $checkbox->GetLabel();
        $this->name = $checkbox->GetName();
        $this->checkedValue = $checkbox->GetCheckedValue();
        $this->checked = $checkbox->GetChecked();
        $this->required = $disableValidation ? false: $checkbox->GetRequired();
        $this->id = $this->CssID() ? $this->CssID() : $checkbox->GetName();
        $this->RealizeField($this->name);
        return parent::Init();
    }
    
    
    /**
     * Gets the related backend form
     * @return CheckboxForm Returns the form for the checkbox settings
     */
    public function ContentForm()
    {
        return new CheckboxForm();
    }
    
    public function BackendName()
    {
        $name = parent::BackendName();
        if (!$this->Content())
        {
            return $name;
        }
        $checkbox = ContentCheckbox::Schema()->ByContent($this->Content());
        $name .= ' : ' . $checkbox->GetName();
        return $name;
    }
   
}