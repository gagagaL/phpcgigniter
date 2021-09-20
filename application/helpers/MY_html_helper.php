<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists("stylesheet_link_tag")) {
	function stylesheet_link_tag($href = '',  $index_page = FALSE)
	{
		if (is_array($href)) {
			$result = "";
			foreach ($href as $h) {
				$result .= stylesheet_link_tag($h, $index_page);
			}
			return $result;
		} else {
			$CI = &get_instance();

			$css_path = "application/assets/css/";
			$href = $css_path . preg_replace("#(\.css)$#", "", ltrim($href, "/")) . ".css";

			if ($index_page === TRUE) {
				$link = '<link href="' . $CI->config->site_url($href) . '" ';
			} else {
				$link = '<link href="' . $CI->config->base_url($href) . '" ';
			}

			$link .= 'rel="stylesheet" type="text/css"';
			return $link . "/>\n";
		}
	}
}

if (!function_exists("javascript_link_tag")) {
	function javascript_link_tag($src = '', $index_page = FALSE)
	{
		if (is_array($src)) {
			$result = "";
			foreach ($src as $s) {
				$result .= javascript_link_tag($s, $index_page);
			}
			return $result;
		} else {
			$CI = &get_instance();

			$js_path = "application/assets/js/";
			$src = $js_path . preg_replace("#(\.js)$#", "", ltrim($src, "/")) . ".js";

			if ($index_page === TRUE) {
				$link = '<script src="' . $CI->config->site_url($src) . '" ';
			} else {
				$link = '<script src="' . $CI->config->base_url($src) . '" ';
			}

			$link .= 'type="text/javascript"';
			return $link . "></script>\n";
		}
	}
}
