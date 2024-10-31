<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$permission = current_user_can('administrator');

if($permission == '1') {
?>
<div class="container">
	<div class="row" style="margin-top: 80px;">
		<center><h1>Custom Redirect Plugin</h1></center>
	</div>
	<div class="row">
		<div class="col-md-12">
			<?php
			if(isset($_POST['url']) && current_user_can('administrator')) {
				
				if(wp_verify_nonce($_POST['send-url'], 'change-url')){
					
					$url = esc_url( $_POST['url'] );
					if (filter_var($url, FILTER_VALIDATE_URL)) {
						update_option( "lah_crp_custom_redirect_plugin", $url);
						echo "<div class='alert alert-success'>
							<strong>Success!</strong> Your URL has been updated.
						</div>";
					} else {
						echo "<div class='alert alert-danger'>
							<strong>Oops!</strong> Your URL you entered is not valid
						</div>";
					}
					
				} else {
					
				}
					
			}
			?>
		</div>
	</div>
	<form action="" method="post">
	<?php $nonce = wp_create_nonce( 'change-url' ); ?>
	<input type="hidden" name="send-url" value="<?php echo $nonce ?>" />
	<div class="row" style="background: #F7F7F7; border: 1px solid #DFDFDF; border-radius: 5px; min-height: 130px;">
		<div class="col-md-9" style="margin-top: 20px;">
			<label for="url">URL</label>
            <input type="text" class="form-control" name="url" id="url" placeholder="URL" value="<?php echo esc_url(get_option( 'lah_crp_custom_redirect_plugin' )); ?>" required>
			
		</div>
		<div class="col-md-3" style="margin-top: 51px;">
			<button class="btn btn-success" type="submit">Update</button>
		</div>
	</div>
	</form>
</div>
<?php
} else {
	die();
}