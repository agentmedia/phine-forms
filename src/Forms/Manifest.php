<?php

namespace Phine\Bundles\Forms;
use Phine\Bundles\Core\Logic\Bundle\BundleManifest;
use Phine\Bundles\Core\Logic\Bundle\BundleManufacturer;
use Phine\Bundles\Core\Logic\Bundle\BundleDependency;

use Phine\Bundles\Core;
/**
 * The forms bundle manifest
 */
class Manifest extends BundleManifest
{
    private $core;
    
    /**
     * Creates the manifest
     */
    public function __construct()
    {
        $this->core = new Core\Manifest();
    }

    /**
     * The version
     * @return string Returns the bundle version
     */
    public function Version()
    {
        return '1.1.2';
    }
    
    /**
     * Loads extra code not available by autoload
     */
    protected function LoadBackendCode()
    {
        //nothing here, yet
    }
    
    /**
     * Gets the bundle manufacturer
     * @return BundleManufacturer Returns the manufacturer of the forms bundle
     */
    public function Manufacturer()
    {
        return $this->core->Manufacturer();
    }

    public function Dependencies()
    {
        return array(new BundleDependency('Core', '1.2.3', '1.2.4'), 
            new BundleDependency('BuiltIn', '1.0.2', '1.0.4'));
    }

    protected function LoadFrontendCode()
    {
        //Nothing here, yet
    }

}

