<?php

namespace Phine\Bundles\Forms\Modules\Frontend;
use Phine\Bundles\Forms\Modules\Frontend\Base\FieldModule;
use App\Phine\Database\Forms\ContentRadio;
use Phine\Bundles\Forms\Logic\Tree\RadioListProvider;
use Phine\Bundles\Forms\Modules\Backend\RadioForm;

/**
 * Renders the radio content
 */
class Radio extends FieldModule
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
     * The pre-selected value
     * @var string
     */
    protected $value;
    
    
    /**
     * True if selected option value must not be empty
     * @var boolean
     */
    protected $required;
    /**
     * The options as associative value=>text array
     * @var array
     */
    protected $options;
    
    /**
     * The dom id
     * @var string
     */
    protected $id;
    
    
    /**
     * Initializes the radio content
     * @return boolean Returns false if processing shall continue
     */
    protected function Init()
    {
        $radio = ContentRadio::Schema()->ByContent($this->Content());
        $disableValidation = $radio->GetDisableFrontendValidation();
        $this->label = $radio->GetLabel();
        $this->name = $radio->GetName();
        $this->required = $disableValidation ? false: $radio->GetRequired();
        $this->value = $radio->GetValue();
        $this->id = $this->CssID() ? $this->CssID(): $this->name;
        $list = new RadioListProvider($radio);
        $this->options = $list->ToArray();
        $this->RealizeField($this->name);
        return parent::Init();
    }
    
    /**
     * The radio content has no freely adjustable child element
     * @return boolean Returns false
     */
    public function AllowChildren()
    {
        return false;
    }
    
    /**
     * The radio content template can be customized
     * @return boolean Returns true
     */
    public function AllowCustomTemplates()
    {
        return true;
    }
    
    /**
     * Gets the related backend form
     * @return RadioForm Gets the radio element settings form
     */
    public function ContentForm()
    {
        return new RadioForm();
    }
    
    public function BackendName()
    {
        $name = parent::BackendName();
        if (!$this->Content())
        {
            return $name;
        }
        $radio = ContentRadio::Schema()->ByContent($this->Content());
        $name .= ' : '. $radio->GetName();
        return $name;
    }
}

