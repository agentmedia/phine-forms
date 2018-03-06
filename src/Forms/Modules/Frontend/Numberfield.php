<?php

namespace Phine\Bundles\Forms\Modules\Frontend;
use Phine\Bundles\Forms\Modules\Frontend\Base\FieldModule;
use App\Phine\Database\Forms\ContentNumberfield;
use Phine\Bundles\Forms\Modules\Backend\NumberfieldForm;

/**
 * The numberfield renderer
 */
class Numberfield extends FieldModule
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
     * The dom id
     * @var string
     */
    protected $id;
   
   /**
     * The min field value
     * @var int
     */
    protected $min;
    
    /**
     * The max field value
     * @var float
     */
    protected $max;
    
    /**
     * The max field value
     * @var float
     */
    protected $step;
    
    
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
        $numberfield = ContentNumberfield::Schema()->ByContent($this->Content());
        $disableValidation = $numberfield->GetDisableFrontendValidation();
        $this->label = $numberfield->GetLabel();
        $this->name = $numberfield->GetName();
        $this->min = $disableValidation ? null : $numberfield->GetMin();
        $this->max = $disableValidation ? null : $numberfield->GetMax();
        $this->step = $disableValidation ? 0 : $numberfield->GetStep();
        $this->required = $disableValidation ? false : $numberfield->GetRequired();
        $this->value = $numberfield->GetValue();
        $this->id = $this->CssID() ? $this->CssID() : $this->name;
        
        $this->RealizeField($this->name);
        return parent::Init();
    }
    
    /**
     * Gets the related backend form
     * @return NumberfieldForm Returns the form for the number field settings
     */
    public function ContentForm()
    {
        return new NumberfieldForm();
    }
    
    public function BackendName()
    {
        $name = parent::BackendName();
        if (!$this->Content())
        {
            return $name;
        }
        $numberfield = ContentNumberfield::Schema()->ByContent($this->Content());
        $name .= ' : ' . $numberfield->GetName();
        return $name;
    }
   
}