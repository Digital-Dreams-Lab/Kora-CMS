
<?php echo Form::open(); ?>

	<div class="control-group">    
        <?php echo Form::label('Username', 'username', array('class'=>'control-label')); ?>
        <div class="input-group">
            <span class="input-group-addon" id="username_addon"><i id="username_spinner" class="fa fa-user"></i></span>
            <?php echo Form::input('username', Input::post('username', isset($user) ? $user->username : ''), array('class' => 'form-control', 'required' => 'required', 'placeholder'=>'Username', 'id'=>'username')); ?>        
            <span class="input-group-btn">
                <button id="submit" class="btn btn-warning" type="submit">
                    <i class="fa fa-save"></i> Save new user
                </button>	
            </span>
        </div>
        <div id="username_message"></div>
    </div>

    <div class="form-group">
        <?php echo Form::label('Email', 'email', array('class'=>'control-label')); ?>
        <div class="input-group">    
            <span class="input-group-addon" id="email_addon"><i id="email_spinner" class="fa fa-envelope"></i></span>
            <?php echo Form::input('email', Input::post('email', isset($user) ? $user->email : ''), array('class' => 'form-control', 'required' => 'required', 'placeholder'=>'Email', 'id'=>'email')); ?>
        </div>
        <div id="email_message"></div>
	</div>
        
    <div class="form-group">
        <?php echo Form::label('Password', 'password', array('class'=>'control-label')); ?>
        <?php echo Form::input('password', Input::post('password', isset($user) ? $user->password : ''), array('class' => 'form-control', 'required' => 'required', 'placeholder'=>'Password')); ?>
    </div>
    
    <?php if (Kora\Permissions::check_group_level(0)) : ?>
    
    <div class="form-group">
        <?php echo Form::label('Levels', 'levels', array('class'=>'control-label')); ?>
        <?php echo Form::select('level', Input::post('level', isset($user) ? $user->level : ''), $levels, array('class' => 'form-control')); ?>
    </div>
    
    <?php endif; ?>    
    
    <div class="form-group">
        <?php echo Form::label('Group', 'group', array('class'=>'control-label')); ?>
        <?php echo Form::select('group', Input::post('group', isset($user) ? $user->group : ''), $groups_array, array('class' => 'form-control')); ?>
    </div>

    <?php echo render('admin/users/_profile'); ?>

<?php echo Form::close(); ?>


<script>

$(document).ready(function() {
    //listens for typing on the desired field
	$("#email").keyup(function() {
        var email = $("#email").val();
		if (isValidEmailAddress(email)) {
			$.ajax({
				type: "POST",
				dataType: "json",
				url: '<?php echo Uri::base(false).'admin/rest/users/check_email.json'; ?>', 
				data: {email:email},					
				beforeSend: function(){
					$("#email_spinner").removeClass('fa-envelope');
					$("#email_spinner").addClass('fa-refresh fa-spin');
				},									   
				success: function(response){
					$("#email_spinner").removeClass('fa-refresh fa-spin fa-times');
					$("#email_message").html('');
					//*/
					if(response.check === '1') {
						$("#email_spinner").addClass('fa-check');
						$("#email_addon").addClass('text-success');
						$("#email_addon").removeClass('text-danger');
						$("#email_message").html('<span class="text-success">'+response.message+'</span>');
						$("#submit").removeClass('disabled');
					}
					else {
						$("#email_spinner").addClass('fa-times');
						$("#email_addon").addClass('text-danger');
						$("#email_addon").removeClass('text-success');
						$("#email_message").html('<span class="text-danger">'+response.message+'</span>');
						$("#submit").addClass('disabled');
					}
					//*/
					console.log(response);
				},				
				error: function(response) {
					$("#email_spinner").html('<i class="fa fa-exclamation"></i>');
				}	
			});
		}
     });
	 
	 $("#username").keyup(function() {
        var username = $("#username").val();
		if (isValidUsername(username)) {
			$.ajax({
				type: "POST",
				dataType: "json",
				url: '<?php echo Uri::base(false).'admin/rest/users/check_username.json'; ?>', 
				data: {username:username},					
				beforeSend: function(){
					$("#username_spinner").removeClass('fa-user');
					$("#username_spinner").addClass('fa-refresh fa-spin');
				},									   
				success: function(response){
					$("#username_spinner").removeClass('fa-refresh fa-spin fa-times');
					//*/
					if(response.check === '1') {
						$("#username_spinner").addClass('fa-check');
						$("#username_addon").addClass('text-success');
						$("#username_addon").removeClass('text-danger');
						$("#username_message").html('<span class="text-success">'+response.message+'</span>');
						$("#submit").removeClass('disabled');
					}
					else {
						$("#username_spinner").addClass('fa-times');
						$("#username_addon").addClass('text-danger');
						$("#username_addon").removeClass('text-success');
						$("#username_message").html('<span class="text-danger">'+response.message+'</span>');
						$("#submit").addClass('disabled');
					}
					//*/
					console.log(response);
				},				
				error: function(response) {
					$("#username_spinner").html('<i class="fa fa-exclamation"></i>');
				}	
			});
		}
     });
	 
	 function isValidEmailAddress(emailAddress) {
    	var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
		return pattern.test(emailAddress);
	};
    function isValidUsername(username) {
    	var pattern = /^[a-zA-Z0-9]{4,}$/;
		return pattern.test(username);
	};
	 
}); // document

</script>

