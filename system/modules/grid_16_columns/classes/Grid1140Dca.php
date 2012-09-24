<?php

/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace BugBuster\Grid1140; 
 

class Grid1140Dca extends \BackendModule 
{
	 /**
    * Current object instance
    * @var object
    */
    protected static $instance = null;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->import('BackendUser', 'User');
        parent::__construct();
    }
    
    
    protected function compile()
    {
        
    } 
    
    /**
     * Return the current object instance (Singleton)
     * @return BotStatisticsHelper
     */
    public static function getInstance()
    {
        if (self::$instance == null)
        {
            self::$instance = new Grid1140Dca();
        }
    
        return self::$instance;
    } 
    
		public function LoadDataContainerGrid1140($strName)
		{
			if ($strName == 'tl_layout')
			{
				//add the new css files
				array_push($GLOBALS['TL_DCA']['tl_layout']['fields']['framework']['options'], 'responsive-1140-16-percent.css', 'responsive-1120-16-pixel.css');
			}
		}

}
