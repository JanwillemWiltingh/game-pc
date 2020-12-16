<?php
	if(isset($_SESSION["alert"]))
	{
?>
	<div style="margin-bottom: 0rem !important;" class="alert-correction alert alert-<?php echo $_SESSION["alert"]["type"] ?> alert-dismissible fade show" role="alert">
		<?php echo $_SESSION["alert"]["message"] ?>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
<?php
	unset($_SESSION["alert"]);
	}
?>
