<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Plugin_Compass extends Plugin
{
	/**
	 * Compile
	 *
	 * Usage:
	 * {{ compass:compile file="" output="" }}
	 *
	 * @param	array
	 * @return	array
	 */
	function compile()
	{
		$this->load->library('compass');
		$this->load->library('asset');
		
		$file 		= $this->attribute('file', 'style.scss');
		$attributes	= $this->attributes();
		$module		= $this->attribute('module', '_theme_');
		$output 	= $this->attribute('output', 'style.css');
		$base		= $this->attribute('base', 'css');
		
		foreach (array('file', 'module', 'base', 'output') as $key)
		{
			if (isset($attributes[$key]))
			{
				unset($attributes[$key]);
			}
			else if ($key === 'file')
			{
				return '';
			}
		}
		
		try {
			
			$viewsPath = rtrim($this->load->get_var('template_views'), '/');
			$themePath = preg_replace('#(\/views(\/web|\/mobile)?)$#', '', $viewsPath).'/';
			
			$compass = new Compass;
			
			$compass->init(Asset::get_filepath_css($file, false), Asset::get_filepath_css($output, false));
			
			return link_tag(Asset::get_filepath_css($output, true), 'stylesheet');
			
		} catch (exception $ex) {
			exit('Compass fatal error:<br />'.$file.','.$module.','.$base.'<br />'.$ex->getMessage());
		}
	}
}
