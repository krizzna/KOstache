<?php defined('SYSPATH') or die('No direct script access.');

class Kohana_Mustache extends Phly\Mustache\Mustache {

	protected function fetchTemplate($template)
	{
		if ($this->templatePath->count())
		{
			return parent::fetchTemplate($template);
		}

		$file = Kohana::find_file('templates', $template, ltrim($this->getSuffix(), '.'));

		if ( ! $file)
		{
			throw new Kohana_Exception('Template file does not exist: :path', array(
				':path' => 'templates/'.$template.$this->getSuffix(),
			));
		}

		$file = file_get_contents($file);

		$this->cachedTemplates[$template] = $file;

		return $file;
	}

}
