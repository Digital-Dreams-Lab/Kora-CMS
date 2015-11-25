
    
    <div class="row">
        <div class="col-lg-12">
            <hr />
            <div class="hidden-xs hidden-sm visible-md-* visible-lg-*">
                <?php echo Asset::img('koracms_visible-md.png', array('id' => 'logo', 'class'=>'center-block')); ?>
            </div>
            <div class="hidden-md hidden-lg visible-sm-* visible-xs-*">
                <?php echo Asset::img('koracms_visible-sm.png', array('id' => 'logo', 'class'=>'center-block')); ?>
            </div>
            <hr />
        </div>
    </div>
    <!-- /.row -->  
                
    <div class="row">
        <div class="col-md-6 well">
        	<h3><i class="fa fa-lock fa-fw"></i> Login</h3>
            
            <?php echo Form::open(); ?>
    
                <?php if (isset($_GET['destination'])): ?>
                    <?php echo Form::hidden('destination',$_GET['destination']); ?>
                <?php endif; ?>
    
                <?php if (isset($login_error)): ?>
                    <div class="error"><?php echo $login_error; ?></div>
                <?php endif; ?>
    
                <div class="form-group <?php echo ! $val->error('email') ?: 'has-error' ?>">
                    <label for="email">Email or Username:</label>
                    <?php echo Form::input('email', Input::post('email'), array('class' => 'form-control required', 'placeholder' => 'Email or Username', 'autofocus')); ?>
    
                    <?php if ($val->error('email')): ?>
                        <span class="control-label"><?php echo $val->error('email')->get_message('You must provide a username or email'); ?></span>
                    <?php endif; ?>
                </div>
    
                <div class="form-group <?php echo ! $val->error('password') ?: 'has-error' ?>">
                    <label for="password">Password:</label>
                    <?php echo Form::password('password', null, array('class' => 'form-control required', 'placeholder' => 'Password')); ?>
    
                    <?php if ($val->error('password')): ?>
                        <span class="control-label"><?php echo $val->error('password')->get_message(':label cannot be blank'); ?></span>
                    <?php endif; ?>
                    <div class="checkbox">
                        <label>
                        	<input type="checkbox" name="remember" id="remember"> Remember login
                        </label>
                        <p class="help-block">(if this is a private computer)</p>
                    </div>
                </div>
                
                <div class="actions">
                	<button type="submit" name="submit" class="btn btn-lg btn-primary">
                    	<i class="fa fa-fw fa-sign-in"></i> Login to your account
                    </button>
                    <?php // Form::submit(array('value'=>'Login to your account', 'name'=>'submit', 'class' => 'btn btn-lg btn-primary')); ?>
                </div>
                <hr />

                <div class="form-group">
                	<p><a href="">Forgot your password</a></p>
                </div>
    
            <?php echo Form::close(); ?>
        </div>
    
        <div class="col-md-6 vertical-center">
        	<h3><i class="fa fa-user fa-fw"></i> Register</h3> 
            <ul class="list-group">
                <li class="list-group-item"><a href="/read-more/"><u>Read more</u></a></li>
            </ul>
            
            <button type="submit" name="submit" class="btn btn-lg btn-default">
                <i class="fa fa-fw fa-user"></i> Register
            </button> 
        </div>
    </div>