<?php

namespace Phine\Bundles\Forms\Modules\Frontend;
use Phine\Bundles\Core\Logic\Module\FrontendModule;
use App\Phine\Database\Forms\ContentFieldset;
use Phine\Bundles\Forms\Modules\Backend\FieldsetForm;

/**
 * The fieldset content module
 */
class Fieldset extends FrontendModule
{
    /**
     * The fieldset legend
     * @var string
     */
    protected $legend;
    
    /**
     * The fieldset dom id
     * @var string
     */
    protected $id;
    
    
    /**
     * The fieldset css classes
     * @var string
     */
    protected $classes;
    
    /**
     * Child elements can be added
     * @return boolean Returns true so child elements can be added
     */
    public function AllowChildren()
    {
        return true;
    }
    
    /**
     * Template customizing allowed
     * @return boolean Returns true so templates can be customized
     */
    public function AllowCustomTemplates()
    {
        return true;
    }
    /**
     * Initialzes the fieldset module
     * @return boolean Returns true if processing shall continue
     */
    protected function Init()
    {
        $fieldset = ContentFieldset::Schema()->ByContent($this->Content());
        $this->id = $this->CssID();
        $this->classes = $this->CssClass();
        $this->legend = $fieldset->GetLegend();
        return parent::Init();
    }
    
    public function ContentForm()
    {
        return new FieldsetForm();
    }
    
    function BackendName()
    {
        $name = parent::BackendName();
        if (!$this->Content())
        {
            return $name;
        }
        $fieldset = ContentFieldset::Schema()->ByContent($this->Content());
        return $name . ' : ' . $fieldset->GetLegend();
    }

}

