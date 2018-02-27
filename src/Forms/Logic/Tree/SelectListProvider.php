<?php

namespace Phine\Bundles\Forms\Logic\Tree;
use App\Phine\Database\Forms\SelectOption;
use App\Phine\Database\Forms\ContentSelect;
use Phine\Bundles\Core\Logic\Tree;
use App\Phine\Database\Access;
use Phine\Bundles\Core\Logic\Tree\TableObjectTreeProvider;
/**
 * The list provider for select options
 */
class SelectListProvider extends TableObjectTreeProvider
{
    use Tree\ListProvider;
    /**
     * The collection of the select option list
     * @var ContentSelect
     */
    private $select;
    
    /**
     * Creates the radio list provider
     * @param ContentSelect $select
     */
    function __construct(ContentSelect $select)
    {
        $this->select = $select;
    }

    /**
     * Gets the next option
     * @param SelectOption $item
     */
    public function NextOf($item)
    {
        return SelectOption::Schema()->ByPrevious($item);
    }

    /**
     * Gets the previous option
     * @param SelectOption $item
     */
    public function PreviousOf($item)
    {
       return $item->GetPrevious();
    }

    /**
     * Sets the previous option
     * @param SelectOption $item
     * @param SelectOption $previous
     */
    public function SetPrevious($item, $previous)
    {
        $item->SetPrevious($previous);
    }

    /**
     * Returns the top most option
     * @return SelectOption
     */
    public function TopMost()
    {
        $sql = Access::SqlBuilder();
        $tblOption = SelectOption::Schema()->Table();
        $where = $sql->Equals($tblOption->Field('SelectField'), $sql->Value($this->select->GetID()))
                ->And_($sql->IsNull($tblOption->Field('Previous')));
        
        return SelectOption::Schema()->First($where);
    }
    
    /**
     * Gets the select options as array
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

