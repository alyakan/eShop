<?php

/*** begin our session ***/

/*** set a form token ***/
$form_token = md5( uniqid('auth', true) );

/*** set the session form token ***/
$_SESSION['form_token'] = $form_token;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
  


<div class="page-header">
    <h1><i class="fa fa-user fa-fw"></i> Register</h1>
</div>
		<form action="adduser_submit.php" method="post" class="form" role="form">
			<fieldset>

			<div class="form-group col-xs-4">
				<input placeholder="Username (4 Characters or more!)" type="text" class="form-control" id="username">
			</div>

			<div class="form-group col-xs-4">
				<input type="password" class="form-control" id="password" name="password" placeholder="Password">
			</div>

			<div class="form-group col-xs-4">
				<input type="password" class="form-control" id="conpass" name="conpass" placeholder="Confirm Password">
			</div>

			<div class="form-group col-xs-4">
				<input type="email" class="form-control" id="email" name="email" placeholder="Email">
			</div>

			<div class="form-group col-xs-4">
				<input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name">
			</div>

			<div class="form-group col-xs-4">
				<input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name">
			</div>

			<p>
				<label for="avatar">Avatar</label>
				<input type="text" id="avatar" name="avatar" value="" maxlength="50" />
			</p>

			<p>
				<input type="hidden" name="form_token" value="<?php echo $form_token; ?>" />
				<input type="submit" value="Complete Registeration" type="button" class="btn btn-success btn-block" />
			</p>
			</fieldset>
		</form>