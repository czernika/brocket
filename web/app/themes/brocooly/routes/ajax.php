<?php
/**
 * Ajax routes
 * Same logic as for regular routes
 *
 * ! You should almost always avoid using \App::route()->all()
 * when defining admin or ajax routes otherwise you will take over all custom admin pages
 * and/or AJAX requests (even ones created by third party plugins).
 *
 * @see https://docs.wpemerge.com/#/framework/routing/defining-routes?id=defining-routes
 * @since 1.12.0
 * @package Brocooly
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
