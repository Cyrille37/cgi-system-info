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

global $wpdb ;

$mysql_server_version = $wpdb->db_version();

$wp_options_table_fieldnames = $wpdb->get_col('DESC wp_options', 0);

$tables_list = $wpdb->get_col('SHOW TABLES', 0);

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
			<td nowrap="nowrap">PHP version</td><td><?php echo PHP_VERSION ?></td>
		</tr>
		<tr>
			<td nowrap="nowrap">Wordpress version</td><td><?php echo $wp_version ?></td>
		</tr>
		<tr>
			<td nowrap="nowrap">Mysql server version</td><td><?php echo (isset($mysql_server_version) ? $mysql_server_version : 'null') ?></td>
		</tr>
		<tr>
			<td nowrap="nowrap">Curl</td><td><?php echo $curl_version ?></td>
		</tr>
		<tr>
			<td nowrap="nowrap">Hash algos</td><td><?php echo (function_exists('hash_algos')) ? implode(',',hash_algos()): 'null' ?></td>
		</tr>
		<tr>
			<td nowrap="nowrap">tables list</td><td><?php echo (is_array($tables_list)) ? implode(',',$tables_list): 'null' ?></td>
		</tr>
		<tr>
			<td nowrap="nowrap">wp_options table fieldnames</td><td><?php echo (is_array($wp_options_table_fieldnames)) ? implode(',',$wp_options_table_fieldnames): 'null' ?></td>
		</tr>
	</table>

	<p>&nbsp;</p>

	<?php phpinfo() ?>
</div>
