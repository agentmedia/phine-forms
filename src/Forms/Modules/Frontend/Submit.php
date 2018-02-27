<?php

namespace Phine\Bundles\Forms\Modules\Frontend;
use Phine\Bundles\Core\Logic\Module\FrontendModule;
use App\Phine\Database\Forms\ContentSubmit;
use Phine\Bundles\Forms\Modules\Backend\SubmitForm;

/**
 * The submit button renderer
 */
class Submit extends FrontendModule
{
    
    /**
     * The field name
     * @var string
     */
    protected $name;
    
    /**
     * The value (displayed as label)
     * @var string
     */
    protected $value;
    
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
     * Initializes the submit element
     * @return boolean REturns false if render process shall continue
     */
    protected function Init()
    {
        $submit = ContentSubmit::Schema()->ByContent($this->Content());
        $this->value = $submit->GetValue();
        $this->name = $submit->GetName();
        $this->id = $this->CssID();
        $this->classes= $this->CssClass();
        return parent::Init();
    }
    
    /**
     * Gets the related backend form
     * @return SubmitForm Returns the backend form for a submit button
     */
    public function ContentForm()
    {
        return new SubmitForm();
    }
    
    public function BackendName()
    {
        $name = parent::BackendName();
        if (!$this->Content())
        {
            return $name;
        }
        $submit = ContentSubmit::Schema()->ByContent($this->Content());
        $name .= ' : ' . $submit->GetName();
        return $name;
    }
}

