<?php
/**
*
* @package acp
* @version $Id$
* @copyright (c) 2005 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @package module_install
*/
class acp_lock_info
{
	function module()
	{
		return array(
			'filename'	=> 'acp_lock',
			'title'		=> 'ACP_LOCK_FORUMS',
			'version'	=> '1.0.0',
			'modes'		=> array(
				'forums'	=> array('title' => 'ACP_LOCK_FORUMS', 'auth' => 'acl_a_modules', 'cat' => array('ACP_MANAGE_FORUMS')),
			),
		);
	}

	function install()
	{
	}

	function uninstall()
	{
	}
}

?>