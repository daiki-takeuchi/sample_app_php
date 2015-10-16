<?php
function smarty_function_validation_errors($params,&$smarty)
{
	if ( ! function_exists('validation_errors'))
	{
		//return error message in case we can't get CI instance
		if ( ! function_exists('get_instance')) return "Can't get CI instance";
		{
			$CI= &get_instance();
			$CI->load->helper('form');
		}
	}
	return validation_errors();
}

function smarty_function_validation_errors_javascript($params,&$smarty)
{
	if ( ! function_exists('validation_errors'))
	{
		//return error message in case we can't get CI instance
		if ( ! function_exists('get_instance')) return "Can't get CI instance";
		{
			$CI= &get_instance();
			$CI->load->helper('form');
		}
	}
	$CI= &get_instance();
	$CI->form_validation->set_error_delimiters('','');

	$script = '<script type="application/javascript">';
	$script .= '    window.onload=function(){';
	$script .= '        alert(\''.str_replace("\n","\\n",validation_errors()).'\')';
	$script .= '    };';
	$script .= '</script>';

	return $script;
}