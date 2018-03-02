<?php
namespace Phine\Bundles\Forms\Modules\Frontend;
use Phine\Bundles\Forms\Modules\Frontend\Base\FieldModule;
use App\Phine\Database\Forms\ContentTextarea;
use Phine\Bundles\Forms\Modules\Backend\TextareaForm;


/**
 * A textarea in the frontend
 */
class Textarea extends FieldModule
{
    
    /**
     * Either the css id or the name
     * @var string
     */
    protected $id;
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
     * The default value
     * @var string
     */
    protected $value;
    
    /**
     * True if the field must not be empty
     * @var boolean
     */
    protected $required;
    
    /**
     * The minimum text length
     * @var int
     */
    protected $minLength;
    
    
    /**
     * The maximum length
     * @var int
     */
    protected $maxLength;
    
    /**
     * No child nodes allowed
     * @return boolean Returns false
     */
    public function AllowChildren()
    {
        return false;
    }
    
    
    /**
     * Custom templates allowes
     * @return boolean Returns true
     */
    public function AllowCustomTemplates()
    {
        return true;
    }
    
    protected function Init()
    {
        $textarea = ContentTextarea::Schema()->ByContent($this->Content());
        $this->label = $textarea->GetLabel();
        $this->name = $textarea->GetName();
        $this->value = $textarea->GetValue();
        $this->minLength = $textarea->GetMinLength();
        $this->maxLength = $textarea->GetMaxLength();
        $this->required = $textarea->GetRequired();
        $this->id = $this->CssID() ? $this->CssID() : $textarea->GetName();
        $this->RealizeField($this->name);
        return parent::Init();
    }
    
    /**
     * Returns the related backend form
     * @return TextareaForm Returns the form for the textarea settings
     */
    public function ContentForm()
    {
        return new TextareaForm();
    }
    
    public function BackendName()
    {
        $name = parent::BackendName();
        if (!$this->Content())
        {
            return $name;
        }
        $textarea = ContentTextarea::Schema()->ByContent($this->Content());
        $name .= ' : ' . $textarea->GetName();
        return $name;
    }
}
