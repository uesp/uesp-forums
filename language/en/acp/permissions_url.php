<?php
/**
*
* @package Enable HTML
* @copyright (c) 2008 RMcGirr83
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

// Create the lang array if it does not already exist
if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'acl_u_url'		=> array('lang' => 'Can post URL Links in posts', 'cat' => 'post'),
));
?>