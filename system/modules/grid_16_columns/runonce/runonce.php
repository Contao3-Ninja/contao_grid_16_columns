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
 * Class GridRunonceJob
 *
 * @copyright  Glen Langer 2012..2014 <http://www.contao.glen-langer.de>
 * @author     Glen Langer (BugBuster)
 * @package    grid_16_columns
 * @license    LGPL
 */
class GridRunonceJob extends Controller
{
	public function __construct()
	{
	    parent::__construct();
	    $this->import('Database');
	}
	
	public function run()
	{
	    $objLayout = $this->Database->execute("SELECT id,name,framework FROM `tl_layout`");
	    #durch jedes Layout gehen
	    while ($objLayout->next())
	    {
	        $migration = false;
	        $new = array();
	        #alte durch neue Dateinamen ersetzen, sofern vorhanden
	        foreach ( deserialize($objLayout->framework) as $key => $css )
	        {
	            if ($css == 'responsive-1140-16-percent.css')
	            {
	                $new[] = 'grid-1140-16-percent.css';
	                $new[] = 'grid-1140-16-percent-responsive.css';
	                $migration = true;
	                continue;
	            }
	            if ($css == 'responsive-1120-16-pixel.css')
	            {
	                $new[] = 'grid-1120-16-pixel.css';
	                $new[] = 'grid-1120-16-pixel-responsive.css';
	                $migration = true;
	                continue;
	            }
	            $new[] = $css;
	        }
	        #Migration nötig? Dann zurück schreiben in DB
	        if ($migration === true) 
	        {
	            $this->Database->prepare("UPDATE `tl_layout` SET framework=? WHERE id=?")
	                           ->execute(serialize($new), $objLayout->id);
	            $strText = 'Layout "'.$objLayout->name.'" migrated';
	            $this->Database->prepare("INSERT INTO `tl_log` (tstamp, source, action, username, text, func, ip, browser) VALUES(?, ?, ?, ?, ?, ?, ?, ?)")
	                           ->execute(time(), 'BE', 'CONFIGURATION', '', specialchars($strText), 'Grid 16 Columns Modul Layout Migration', '127.0.0.1', 'NoBrowser');
	        }
	    }
		
	} //function run
} // class

$objGridRunonceJob = new GridRunonceJob();
$objGridRunonceJob->run();

