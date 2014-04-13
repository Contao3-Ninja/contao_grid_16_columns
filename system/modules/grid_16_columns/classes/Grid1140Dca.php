<?php  

/**
 * Contao Open Source CMS, Copyright (C) 2005-2014 Leo Feyer
 *
 * @copyright  Glen Langer 2012..2014 <http://www.contao.glen-langer.de>
 * @author     Glen Langer (BugBuster)
 * @package    grid_16_columns
 * @license    LGPL
 * @filesource
 * @see        https://github.com/BugBuster1701/contao_grid_16_columns
 */


/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace BugBuster\Grid1140; 
 
/**
 * Class Grid1140Dca for Hook loadDataContainer
 * @author Data
 *
 */
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
     * @return Grid1140Dca
     */
    public static function getInstance()
    {
        if (self::$instance == null)
        {
            self::$instance = new Grid1140Dca();
        }
    
        return self::$instance;
    } 
    
    /**
     * Hook loadDataContainer
     * @param string $strName    dca
     */
    public function LoadDataContainerGrid1140($strName)
    {
    	if ($strName == 'tl_layout')
    	{
    		//add the new css files
    		array_push($GLOBALS['TL_DCA']['tl_layout']['fields']['framework']['options'], 'grid-1140-16-percent.css', 'grid-1140-16-percent-responsive.css', 'grid-1120-16-pixel.css', 'grid-1120-16-pixel-responsive.css');
    	}
        if ($strName == 'tl_page')
        {
            //Alias Name anzeigen in Seitenstruktur, just4fun
        	$GLOBALS['TL_DCA']['tl_page']['list']['label']['fields'] = array('title','alias');
            $GLOBALS['TL_DCA']['tl_page']['list']['label']['format'] = '%s <span style="color:#b3b3b3;padding-left:3px">[%s]</span>';
        }
    }

}
