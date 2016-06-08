 
<div class="loginBox">        
	<div class="loginHead">
	    <img src="img/logo.png" alt="NTQ Solution Admin Control Panel" title="NTQ Solution Admin Control Panel"/>
	</div>
	<form class="form-horizontal" action="?controller=Users&action=login" method="POST">            
	    <div class="control-group">
	        <label for="inputUsername">Username</label>                
	        <input type="text" id="inputUsername" name="username" required />
	    </div>
	    <div class="control-group">
	        <label for="inputPassword">Password</label>                
	        <input type="password" id="inputPassword" name="password" required />                
	    </div>
	    <div class="control-group" style="<?php if (empty($result['message'])) {echo "display: none";} ?>">
	    	<span id="message" style="margin-left: 2%;">
	    		<?php if (isset($result['message'])) {
	                        echo $result['message'] ;
	                    } ?>
            </span>
        </div>
	    <div class="control-group" style="margin-bottom: 5px;"> 
	    	<input type="checkbox" id="idRemember" name="remember" style="float: left">                
	        <label class="checkbox" for="idRemember">Remember me</label>
	    </div>
	    <div class="form-actions">
	        <button type="submit" class="btn btn-block" name="Sign-in">Sign in</button>
	    </div>
	</form>        
</div>  

