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
$dbErrors = array();

$mysql_server_version = $wpdb->db_version();
if( ! empty( $wpdb->last_error) ) $dbErrors[] = $wpdb->last_error;

$tables_list = $wpdb->get_col('SHOW TABLES', 0);
if( ! empty( $wpdb->last_error) ) $dbErrors[] = $wpdb->last_error;

$wp_options_table_fieldnames = $wpdb->get_col('DESC '.$wpdb->get_blog_prefix().'options', 0);
if( ! empty( $wpdb->last_error) ) $dbErrors[] = $wpdb->last_error;

$post_types=get_post_types();

?>
<div class="wrap">
	
	<div id="icon-options-general" class="icon32">
	</div>
	<h2><?php _e('System information',
	CgiSystemInfo::PLUGIN); ?></h2>

	<p>&nbsp;</p>

	<p>&gt;&gt; <a href="#phpinfo">phpinfo</a></p>

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
		<tr>
			<td nowrap="nowrap">db errors</td><td><?php echo (count($dbErrors)>0 ? implode('<br/>',$dbErrors) : 'no error') ?></td>
		</tr>
	</table>

	<table class="widefat">
		<tr>
			<td nowrap="nowrap">WP post types <i>(<a href="http://codex.wordpress.org/Function_Reference/register_post_type" target="_blank">doc</a>)</i></td><td>
				<?php 
					$post_types=get_post_types('','names'); 
					foreach ($post_types as $post_type ) {
					  echo '<p>'. $post_type. '</p>';
					}
				?>
			</td>
		</tr>
	</table>

	<p>&nbsp;</p>

	<a name="phpinfo"></a>

	<script id="phpinfo-doc" type="text/template">
	<?php phpinfo() ?>
	</script>
	<iframe id="phpinfo-iframe" width="100%" height="1024">
	</iframe>
	<script type="text/javascript">
	jQuery(function()
	{
		jQuery('#phpinfo-iframe');
		var doc = document.getElementById('phpinfo-iframe').contentWindow.document;
   		doc.open();
   		doc.write( jQuery('#phpinfo-doc').html() );
   		doc.close();
	});
	</script>

</div>
