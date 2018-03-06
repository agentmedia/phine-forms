<?php

namespace Phine\Bundles\Forms\Modules\Frontend;
use Phine\Bundles\Forms\Modules\Frontend\Base\FieldModule;
use App\Phine\Database\Forms\ContentSelect;
use Phine\Bundles\Forms\Logic\Tree\SelectListProvider;
use Phine\Bundles\Forms\Modules\Backend\SelectForm;

/**
 * Renders the select content
 */
class Select extends FieldModule
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
     * Initializes the select content
     * @return boolean Returns false if processing shall continue
     */
    protected function Init()
    {
        $select = ContentSelect::Schema()->ByContent($this->Content());
        $this->label = $select->GetLabel();
        $this->name = $select->GetName();
        $this->required = $select->GetRequired();
        $this->value = $this->Value($this->name, $select->GetValue());
        $this->id = $this->CssID() ? $this->CssID(): $this->name;
        $list = new SelectListProvider($select);
        $this->options = $list->ToArray();
        $this->RealizeField($this->name);
        return parent::Init();
    }
    
    /**
     * The select content has no freely adjustable child element
     * @return boolean Returns false
     */
    public function AllowChildren()
    {
        return false;
    }
    
    /**
     * The select content template can be customized
     * @return boolean Returns true
     */
    public function AllowCustomTemplates()
    {
        return true;
    }
    
    /**
     * Gets the related backend form
     * @return SelectForm Returns the select form
     */
    public function ContentForm()
    {
        return new SelectForm();
    }
    
    /**
     * Gets the name for backend views
     * @return string Returns the backend name
     */
    public function BackendName()
    {
        $name = parent::BackendName();
        if (!$this->Content())
        {
            return $name;
        }
        $select = ContentSelect::Schema()->ByContent($this->Content());
        $name .= ' : ' . $select->GetName();
        return $name;
    }
}

