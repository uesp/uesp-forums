<?php
/**
*
* @package phpBB3
* @version $Id: authorized_url.php,v 1.5 2009/03/16 15:11:39 rmcgirr83 Exp $
* @copyright (c)Rich McGirr
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

/**
* Include only once.
*/
function authorized_url($auth_url)
{
	global $user, $config, $img_status;
	
	// need to notice language
    $user->add_lang('mods/authorized_url');

	// initialize a variable or two
	$auth_msg = '';
	
	// The following will allow img bbcode and email links to be overridden
	// eg if $not_check_email = true, then emails (eg rmcgirr83@rmcgirr83.org, etc)
	// will not be checked for
	 
	$not_check_email = false; // change to true to not check for email links
	$not_check_img_bbcode = false; // change to true to not check for img bbcode tags
	
	// our TLD array..add to or subtract from to suit your needs
	$tld_list = array(
		'ac', 'ad', 'ae', 'aero', 'af', 'ag', 'ai', 'al',
		'am', 'an', 'ao', 'aq', 'ar', 'arpa', 'arts', 'as',
		'at', 'au', 'aw', 'az', 'ba', 'bb', 'bd', 'be',
		'bf', 'bg', 'bh', 'bi', 'biz', 'bj', 'bm', 'bn',
		'bo', 'br', 'bs', 'bt', 'bv', 'bw', 'by', 'bz',
		'ca', 'cc', 'cd', 'cf', 'cg', 'ch', 'ci', 'ck',
		'cl', 'cm', 'cn', 'co', 'com', 'coop', 'cr', 'cu',
		'cv', 'cx', 'cy', 'cz', 'de', 'dj', 'dk', 'dm',
		'do', 'dz', 'ec', 'edu', 'ee', 'eg', 'eh', 'er',
		'es', 'et', 'fi', 'firm', 'fj', 'fk', 'fm', 'fo',
		'fr', 'fx', 'ga', 'gd', 'ge', 'gf', 'gg', 'gh',
		'gi', 'gl', 'gm', 'gn', 'gov', 'gp', 'gq', 'gr',
		'gs', 'gt', 'gu', 'gw', 'gy', 'hk', 'hm', 'hn',
		'hr', 'ht', 'hu', 'id', 'ie', 'il', 'im', 'in',
		'info', 'int', 'io', 'iq', 'ir', 'is', 'it', 'je',
		'jm', 'jo', 'jp', 'ke', 'kg', 'kh', 'ki', 'km',
		'kn', 'kp', 'kr', 'kw', 'ky', 'kz', 'la', 'lb',
		'lc', 'li', 'lk', 'lr', 'ls', 'lt', 'lu', 'lv',
		'ly', 'ma', 'mc', 'md', 'mg', 'mh', 'mil', 'mk',
		'ml', 'mm', 'mn', 'mo', 'mp', 'mq', 'mr', 'ms',
		'mt', 'mu', 'museum', 'mv', 'mw', 'mx', 'my', 'mz',
		'na', 'name', 'nato', 'nc', 'ne', 'net', 'nf', 'ng',
		'ni', 'nl', 'no', 'np', 'nom', 'np', 'nr', 'nu',
		'nz', 'om', 'org', 'pa', 'pe', 'pf', 'pg', 'ph',
		'pk', 'pl', 'pn', 'pr', 'pro', 'pt', 'pw', 'py',
		'qa', 're', 'rec', 'ro', 'ru', 'rw', 'sa', 'sb',
		'sc', 'sd', 'se', 'sg', 'sh', 'shop', 'si', 'sj',
		'sk', 'sl', 'sm', 'sn', 'so', 'sr', 'st', 'su',
		'sv', 'sy', 'sz', 'tc', 'td', 'tf', 'tg', 'th',
		'tj', 'tk', 'tm', 'tn', 'to', 'tp', 'tr', 'tt',
		'tv', 'tw', 'tz', 'ua', 'ug', 'uk', 'um', 'us',
		'uy', 'uz', 'va', 'vc', 've', 'vg', 'vi', 'vn',
		'vu', 'web', 'wf', 'ws', 'ye', 'yt', 'yu', 'za',
		'zm', 'zr', 'zw'
	);
							
	$disallowed_tld = implode('|',$tld_list);

	// thanks for the regex tut A_Jelly_Doughnut!! :)
	// we want emails to show
	if($not_check_email)
	{
		$auth_url = preg_replace("#([a-z0-9\-_]+)@(((?:www.)?\b[a-z0-9\-_]+)\.($disallowed_tld)(\.($disallowed_tld))?\b)#i",'',$auth_url);
	}	
	// we want img bbcode tags to show
	if($not_check_img_bbcode)
	{
		$auth_url = preg_replace("/\[img\s*\](.+?)\[\/img\]/i", '',$auth_url);		
	}
	// check the whole darn thang now for any TLD's
	// at least those that >seem< to match from the array
	// and have not been excluded above
	
	if (preg_match("#(([a-z0-9\-_]+)@)?([a-z]{3,6}://)?(((?:www.)?\b[a-z0-9\-_\.]+)\.($disallowed_tld)(\.($disallowed_tld))?\b)#i", $auth_url)) {
	
//	$valid_sites = array("uesp.net", "elderscrolls.com", "youtube.com", "bethblog.com", "cs.elderscrolls.com");
// remove youtube.com based on moderator requests (and cases of inappropriate videos being linked by spammers)
// add tesnexus.com
		$valid_sites = array("uesp.net", "elderscrolls.com", "bethblog.com", "cs.elderscrolls.com", "tesnexus.com");
		preg_match_all("#(?:(?:[a-z0-9\-_]+)@)?(?:[a-z]{3,6}://)?(((?:www.)?\b[a-z0-9\-_\.]+)\.($disallowed_tld)(\.($disallowed_tld))?\b)#i", $auth_url, $matches, PREG_SET_ORDER);

		$matchesok = 1;
		while (count($matches[0])) {
			$val = $matches[0][1];
			$matchesok = 0;
			foreach ($valid_sites as $site) {
				$testval = substr($val, -1*strlen($site));
				if (stristr($testval, $site)!==false) {
					$matchesok = 1;
					break;
				}
			}
			if ($matchesok==0) break;
			array_shift($matches);
		}
	}

	//free up a tad of memory
	unset($auth_url);
	
	// we have a match..uhoh, someone's being naughty
	// time to slap 'em up side the head
	if (sizeof($matches))
	{
		// if bbcode is still checked
		// then change the board img status for the user
		if(!$not_check_img_bbcode)
		{
			$img_status = $config['allow_sig_img'] = false;		
		}
		$auth_msg = array(sprintf($user->lang['URL_UNAUTHED'], $matches[0][0]));
	}

return ($auth_msg);
}

?>