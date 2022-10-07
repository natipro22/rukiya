<?php
namespace Config;

use CodeIgniter\Config\BaseConfig;

class Settings extends BaseConfig
{
    public $system_name;
    public $company;
    public $campus;
    public $address;
    public $website;
    public $pobox;
    public $sidenav;
    public $navbar;
    public $color;

    public function __construct() {
        
//        $settings = \App\Libraries\System::createSetting();
//        $setting = $settings->findColumn('SETTING_DESC');
//        
//        $this->system_name  = $setting[0];
//        $this->company      = $setting[1];
//        $this->campus       = $setting[2];
//        $this->address      = $setting[3];
//        $this->website      = $setting[4];
//        $this->pobox        = $setting[5];
//        $this->sidenav      = $setting[6];
//        
//        
        
    }
}
