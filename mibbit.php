<?php

$phpEx = 'php'; // Added to define the variable as the appropriate extension, no extension.inc file in phpBB3
define('IN_PHPBB', true);
$phpbb_root_path = '/home/uesp/www/forums/'; // set this as the path to your phpBB installation
// include($phpbb_root_path . 'extension.inc'); // This is no longer valid. phpBB3 no longer utilizes extension.inc
include($phpbb_root_path . 'common.'.$phpEx);
include($phpbb_root_path . 'includes/functions_user.'.$phpEx);


//
// Start session management
//
$user->session_begin();
$auth->acl($user->data);
$userdata = $user->data;

//
// End session management
//

function is_valid_nickname($nickname)
{
        if($nickname != '')
        {
                for($i = 0, $maxi = strlen($nickname); $i < $maxi; $i++)
                {
                        $code = ord($nickname[$i]);
                        if( !(($i > 0 && ( $code == 45 || ($code >= 48 && $code <= 57) )) || ($code >= 65 && $code <= 125)) ) break;
                }
                return ($i == $maxi);
        }
}

if($user->data['user_id'] != ANONYMOUS)
{
        $nickname = is_valid_nickname($user->data['username']) ? $user->data['username'] : '';
}
else
{
        $nickname = '';
}

if( !is_valid_nickname($nickname) )
{
        $nickname = 'uesp_guest_'.chr(mt_rand(65, 90)).chr(mt_rand(97, 122)).chr(mt_rand(97, 122));
}

$uri = 'http://widget.mibbit.com/?nick='.$nickname
        .'&server=irc.xertion.org%3A6667' // replace server and port with matching information
        .'&noServerTab=false'
        .'&channel=%23uespforums'; // replace channel with the name of your channel. '%23' is the '#' before most irc channel names.

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
   <head>
        <title>UESP Forum Chat</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <style type="text/css">
                html,body,iframe { border: 0; height: 100%; margin: 0; overflow: hidden; padding: 0; }
                iframe { height: 100%; width: 100%; }
        </style>
   </head>
   <body>
     <iframe src="<?php echo $uri; ?>" frameborder="0"><h1><a href="<?php echo $uri; ?>">Open IRC channel</a></h1></iframe>

<h1><a href="<?php echo $uri; ?>">Open IRC channel</a></h1>
	</body>
</html>

