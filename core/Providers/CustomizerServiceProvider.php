<?php
/**
 * Customizer Service Provider
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.4.0
 */

declare(strict_types=1);

namespace Brocooly\Providers;

use Kirki\Panel;
use Kirki\Section;
use Kirki\Compatibility\Kirki;
use WPEmerge\ServiceProviders\ServiceProviderInterface;

class CustomizerServiceProvider implements ServiceProviderInterface
{
	public function register( $container )
	{

	}

	public function bootstrap( $container )
	{
		if ( ! class_exists( Kirki::class ) ) {
			return;
		}

		$this->registerCustomizerConfig();
		$this->registerCustomizerPanels();
		$this->registerCustomizerSections();
	}

	/**
	 * Register customizer config
	 *
	 * @return void
	 */
	private function registerCustomizerConfig()
	{
		Kirki::add_config( ...config( 'customizer.config', [] ) );
	}

	/**
	 * Register customizer panels
	 *
	 * @return void
	 */
	private function registerCustomizerPanels()
	{
		foreach ( config( 'customizer.panels', [] ) as $panel ) {
			$customizerPanel = new $panel();
			$panelArgs       = $customizerPanel->args();

			if ( is_string( $panelArgs ) ) {
				$panelArgs = [ 'title' => $panelArgs ];
			}

			new Panel( $customizerPanel::PANEL_ID, $panelArgs );
		}
	}

	/**
	 * Register customizer sections
	 *
	 * @return void
	 */
	private function registerCustomizerSections()
	{
		foreach ( config( 'customizer.sections', [] ) as $section ) {
			$customizerSection = new $section();
			$sectionArgs       = $customizerSection->args();

			if ( is_string( $sectionArgs ) ) {
				$sectionArgs = [ 'title' => $sectionArgs ];
			}

			new Section( $customizerSection::SECTION_ID, $sectionArgs );

			foreach ( $customizerSection->fields() as $option ) {
				$optionClass                  = $option['field'];
				$option['options']['section'] = $customizerSection::SECTION_ID;
				new $optionClass( $option['options'] );
			}
		}
	}
}
