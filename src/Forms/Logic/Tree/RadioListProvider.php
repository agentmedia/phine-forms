<?php

namespace Phine\Bundles\Forms\Logic\Tree;
use App\Phine\Database\Forms\RadioOption;
use App\Phine\Database\Forms\ContentRadio;
use Phine\Bundles\Core\Logic\Tree;
use App\Phine\Database\Access;
use Phine\Bundles\Core\Logic\Tree\TableObjectTreeProvider;

/**
 * The list provider for radio options
 */
class RadioListProvider extends TableObjectTreeProvider
{
    use Tree\ListProvider;
    /**
     * The collection of the radio button list
     * @var ContentRadio
     */
    private $radio;
    
    /**
     * Creates the radio list provider
     * @param ContentRadio $radio
     */
    function __construct(ContentRadio $radio)
    {
        $this->radio = $radio;
    }

    /**
     * Gets the next button
     * @param RadioOption $item
     */
    public function NextOf($item)
    {
        return RadioOption::Schema()->ByPrevious($item);
    }

    /**
     * Gets the previous option
     * @param RadioOption $item
     */
    public function PreviousOf($item)
    {
       return $item->GetPrevious();
    }

    /**
     * Sets the previous option
     * @param RadioOption $item
     * @param RadioOption $previous
     */
    public function SetPrevious($item, $previous)
    {
        $item->SetPrevious($previous);
    }

    /**
     * Returns the top most option
     * @return RadioOption
     */
    public function TopMost()
    {
        $sql = Access::SqlBuilder();
        $tblOption = RadioOption::Schema()->Table();
        $where = $sql->Equals($tblOption->Field('RadioField'), $sql->Value($this->radio->GetID()))
                ->And_($sql->IsNull($tblOption->Field('Previous')));
        
        return RadioOption::Schema()->First($where);
    }
    
     /**
     * Gets the radio options as array
     * @return array Returns the options as associative value=>text array
     */
    public function ToArray()
    {
        $result = array();
        $option = $this->TopMost();
        while ($option)
        {
            $result[$option->GetValue()] = $option->GetText();
            $option = $this->NextOf($option);
        }
        return $result;
    }
}

