<?php
/**
 * Smarty {site_url} function plugin
 *
 * Type:     function<br>
 * Name:     site_url<br>
 * Purpose:  Codeigniter site_urlヘルパーのラッパープラグイン<br>
 * Examples: {site_url url="member/add"}<br>
 * Output:   http://example.com/member/add/<br>
 * Params:
 * <pre>
 * - id      - (optional) - id attribute
 * - label
 * - value
 * - class
 * </pre>
 */
function smarty_function_site_url($params,&$smarty)
{
	if ( ! isset($params['url']))
	{
		$params['url'] = '';
	}
	return site_url($params['url']);
}