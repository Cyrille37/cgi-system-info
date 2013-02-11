<?php
/*
 * cgi-system-info / page_overview
 */

global $wp_version ;

if( function_exists('curl_version')){
	$v= curl_version();
	$curl_version = $v['version'].', ssl:'.$v['ssl_version'].', libz:'.$v['libz_version'];
}
else
{
	$curl_version = 'none';
}
	
?>

<div class="wrap">
	<div id="icon-options-general" class="icon32">
		<br>
	</div>

	<h2><?php _e('System information',
	CgiSystemInfo::PLUGIN); ?></h2>

	<p>&nbsp;</p>

	<table class="widefat">
		<tr>
			<td nowrap="nowrap">PHP Version</td><td><?php echo PHP_VERSION ?></td>
		</tr>
		<tr>
			<td nowrap="nowrap">Wordpress Version</td><td><?php echo $wp_version ?></td>
		</tr>
		<tr>
			<td nowrap="nowrap">Curl</td><td><?php echo $curl_version ?></td>
		</tr>
		<tr>
			<td nowrap="nowrap">Hash algos</td><td><?php echo (function_exists('hash_algos')) ? implode(',',hash_algos()): 'none' ?></td>
		</tr>
	</table>

</div>
