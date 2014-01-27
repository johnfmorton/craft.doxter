<?php
namespace Craft;

/**
 * Doxter 0.4.0
 *
 * Doxter is a markdown parser designed to help you write better docs
 *
 * @author		Selvin Ortiz - http://twitter.com/selvinortiz
 * @package		Doxter
 * @category	Markdown
 * @copyright	2014 Selvin Ortiz
 * @license		[MIT]
 */

class DoxterPlugin extends BasePlugin
{
	protected $devMode = true;

	public function init()
	{
		require_once craft()->path->getPluginsPath().'doxter/library/vendor/autoload.php';
	}

	/**
	 * Gets the plugin name or alias given by end user
	 *
	 * @param	bool	$real	Whether the real name should be returned
	 * @return	string
	 */
	public function getName($real=false)
	{
		if ($real)
		{
			return 'Doxter';
		}

		$alias = $this->getSettings()->pluginAlias;

		return empty($alias) ? 'Doxter' : Craft::t($alias);
	}

	public function getVersion()
	{
		return '0.4.0';
	}

	public function getDeveloper()
	{
		return 'Selvin Ortiz';
	}

	public function getDeveloperUrl()
	{
		return 'http://twitter.com/selvinortiz';
	}

	public function getDevMode()
	{
		return $this->devMode;
	}

	public function hasCpSection()
	{
		return $this->getSettings()->enableCpTab;
	}

	public function defineSettings()
	{
		return array(
			'syntaxSnippet'		=> array(AttributeType::String, 'column'=>ColumnType::Text),
			'enableCpTab'		=> AttributeType::Bool,
			'pluginAlias'		=> AttributeType::String
		);
	}

	public function getSettingsHtml()
	{
		craft()->templates->includeCssResource('doxter/css/doxter.css');

		return craft()->templates->render(
			'doxter/_settings.html',
			array(
				'settings' => $this->getSettings()
			)
		);
	}

	public function addTwigExtension()
	{
		Craft::import('plugins.doxter.twigextensions.DoxterTwigExtension');

		return new DoxterTwigExtension();
	}
}
