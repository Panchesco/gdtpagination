<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
	
Copyright (C) 2017 

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
I BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER
IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

/**
 * Gdtpagination Class
 *
 * @package     ExpressionEngine
 * @category		Plugin
 * @author		  Richard Whitmer <richard@panchesco.com>
 * @copyright		Copyright (c) YYYY
 * @link			  https://github.com/panchesco/gdtpagination
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
