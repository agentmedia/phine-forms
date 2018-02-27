<?php
namespace Phine\Bundles\Forms\Modules\Backend;
use Phine\Bundles\Core\Logic\Module\ContentForm;
use App\Phine\Database\Forms\ContentFieldset;
use Phine\Bundles\Forms\Modules\Frontend\Fieldset;
use Phine\Framework\FormElements\Fields\Input;

/**
 * The backend form for the fieldset module
 */
class FieldsetForm extends ContentForm
{
    /**
     * The currently edited fieldset
     * @var ContentFieldset
     */
    private $fieldset;
    /**
     * Provides the required element schema
     * @return \App\Phine\Database\Forms\ContentFieldsetSchema Returns the content fieldset schema
     */
    protected function ElementSchema()
    {
        return ContentFieldset::Schema();
    }
   
    /**
     * Gets the related frontend module
     * @return Fieldset Returns the fieldset frontend module
     */
    protected function FrontendModule()
    {
        return new Fieldset();
    }

    protected function InitForm()
    {
        $this->fieldset = $this->LoadElement();
        $this->AddLegendField();
        $this->AddCssClassField();
        $this->AddCssIDField();
        $this->AddTemplateField();
        $this->AddSubmit();
    }
    
    private function AddLegendField()
    {
        $name = 'Legend';
        $field = Input::Text($name, $this->fieldset->GetLegend());
        $this->AddField($field);
    }
    
    protected function SaveElement()
    {
        $this->fieldset->SetLegend($this->Value('Legend'));
        return $this->fieldset;
    }
}

