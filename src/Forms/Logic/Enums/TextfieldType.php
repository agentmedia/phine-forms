<?php
namespace Phine\Bundles\Forms\Logic\Enums;
use Phine\Framework\System\Enum;

/**
 * Available text field type values
 */
class TextfieldType extends Enum
{
    /**
     * Text field type 'text'
     * @return TextfieldType
     */
    static function Text()
    {
        return new self('text');
    }
    
    /**
     * Text field type 'email'
     * @return TextfieldType
     */
    static function Email()
    {
        return new self('email');
    }
    
    /**
     * Text field type 'email'
     * @return TextfieldType
     */
    static function Url()
    {
        return new self('url');
    }
    
    /**
     * Text field type 'search'
     * @return TextfieldType
     */
    static function Search()
    {
        return new self('search');
    }
    
    
    /**
     * Text field type 'tel' for telephone
     * @return TextfieldType
     */
    static function Tel()
    {
        return new self('tel');
    }
}

