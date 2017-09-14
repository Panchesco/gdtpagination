<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*	
Copyright (C) 2017 
Gdtpagination is open-sourced software licensed under the MIT license https://opensource.org/licenses/MIT
*/

/**
 * Gdtpagination Class
 *
 * @package     ExpressionEngine
 * @category	Plugin
 * @author	Richard Whitmer <richard@panchesco.com>
 * @copyright	Copyright (c) YYYY
 * @link	https://github.com/panchesco/gdtpagination
 */

class Gdtpagination {

    public $return_data;
    
     /**
      * Constructor
      *
      * @access	public
      * @return	void
      */
    
    function __construct()
    {
      $this->wrapper();
    }
    
    //-----------------------------------------------------------------------------
    
    /**
     * Render EE pagination object links in the template.
     * @access private
     * @return string
     */
    public function wrapper() 
    {
      
      ee()->load->library('pagination');
      
      $total_items = ee()->TMPL->fetch_param('total_items');
      $per_page = ee()->TMPL->fetch_param('per_page');
      $current_page = ee()->TMPL->fetch_param('current_page',0);
      $prefix = ee()->TMPL->fetch_param('prefix','P');
      $base_path =ee()->TMPL->fetch_param('base_path');
      
      $pagination = ee()->pagination->create();
      $pagination->prefix = $prefix;
      $pagination->basepath = '/' . trim($base_path,'/');

      ee()->TMPL->tagdata = $pagination->prepare(ee()->TMPL->tagdata);
      
      $pagination->build($total_items, $per_page);
      $this->return_data = $pagination->render($this->return_data);
      
      return $this->return_data;
    }

}
// END CLASS
// EOF
