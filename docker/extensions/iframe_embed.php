<?php
# iframe.  Modified from:
#       CSO_iFrame - MediaWiki Extension
#       CSharp-Online.NET (C) 2006 Chang & Wagers Associates
# The text between the tags is used as the properties of an iFrame tag.
# Usage: <iframe_embed>iframe-properties</iframe_embed>
#
# To activate the extension, add this line to LocalSettings.php:
# include("extensions/iframe.php");

$wgExtensionFunctions[] = "wfIframe";

function wfIframe(){
	global $wgParser;
	$wgParser->setHook ("iframe_embed", "efIframe_embed"); # tagname, callback
	return true;
}


function efIframe_embed ($text, $argv, &$wgParser){
	global $wgTitle, $wgUser;
	$tmp = explode("\n", trim($text));
	$output = "<iframe src=";
	switch (strtolower($tmp[0])){
			case 'phpicalendar':
				$output .= "http://phpicalendar.org/phpicalendar";
				break;
			case 'cnn':
				$output .= "http://cnn.com";
				break;
			case 'coveritlive':
				$output = '<iframe src="http://www.coveritlive.com/index2.php/option=com_altcaster/task=viewaltcast/altcast_code='.$tmp[1].'/height=550/width=470" scrolling="no" height="550px" width="470px" frameBorder ="0" ></iframe>';
				return $output;
				break;
			case 'googlecalendar':
				$output = '<iframe src="https://www.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%23ffffff&amp;src=97rvdqlt7r4qm47322jgo2pums%40group.calendar.google.com&amp;color=%2328754E&amp;ctz=America%2FChicago" style=" border-width:0 " width="800" height="600" frameborder="0" scrolling="no"></iframe>';
				return $output;
				break;
			default:
				$output .= "http://hulab.tamu.edu";
	}
	$output .= " width = '100%' height = '800'></iframe>";
	return $output;
}
?>
