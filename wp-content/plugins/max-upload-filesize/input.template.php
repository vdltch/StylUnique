<div class="wrap">
<h2>Upload Filesize settings</h2>
<?php if (sanitize_text_field($_POST['submit'])): 
        if ($m === true): 
?>
<div id="message" class="updated"><p><strong>Updated!</strong></p></div>
<?php else : ?>
<div id="message" class="error"><p><strong><?php echo esc_html($m); ?></strong></p></div>
<?php endif; 
      endif;
?>

<form method="post">
    <?php wp_nonce_field('yld_test'); ?>
<table class= "widefat striped">
    <tbody id="the-list">
            <tr>
                <th>Max Upload Filesize: </th>
                <td><input type="text" name="max_upload_filesize" value="<?php echo esc_attr($yld_max_upload_filesize/1024/1024) ?>"> M</td>
                <td>Set upload filesize limit in <strong>M</strong><br>
                    if you increase up too much this value, you have to set memory limit and max execution time.
                </td>
            </tr>
            <tr>
                <th>Memory Limit: </th> 
                <td><?php echo esc_html(ini_get('memory_limit')); ?> </td>
                <td>You can set <strong>memory_limit</strong> in <strong>php.ini</strong> file.</td>
            </tr>
            <tr>
                <th>Max Execution Time: </th>
                <td><?php echo esc_html(ini_get('max_execution_time')); ?>s</td>
                <td>You can set <strong>max_execution_time</strong> in <strong>php.ini</strong> file.</td>
            </tr>
    </tbody>
</table>
    <?php submit_button() ?>
</form>
</div>