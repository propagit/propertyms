<div class="container">
	<h1>Contact us now for an obligation free meeting</h1>
    <p>
    	Phone: 0419 841 411<br>
        Address: PO Box 627 Hawthorn, Vic 3122.<br>
       <em>COntact us via email using the form below</em>
    </p>
    
    <form id="contact-form" class="form-horizontal form-alt">
    	<div class="form-group">
    		<label class="col-xs-2 control-label push-text">Name <span class="text-danger">*</span></label>
        	<div class="col-xs-6">
            	<input type="text" class="form-control" name="name">
            </div>
        </div>
        
        <div class="form-group">
    		<label class="col-xs-2 control-label push-text">Email <span class="text-danger">*</span></label>
        	<div class="col-xs-6">
            	<input type="email" class="form-control" name="email">
            </div>
        </div>
        
        <div class="form-group">
    		<label class="col-xs-2 control-label push-text">Message <span class="text-danger">*</span></label>
        	<div class="col-xs-6">
            	<textarea class="form-control" name="message"></textarea>
            </div>
        </div>
        
        <div class="form-group">
        	<div class="col-xs-offset-2 col-xs-6">
            	<button class="btn btn-primary" type="reset">Clear</button>
                <button id="send-msg" class="btn btn-primary" type="button">Send</button>
                
                <br><br>
                
                <span class="text-danger">* mandatory fields</span>
                
                <p id="contact-result" style="display:none;">
                	
                </p>
            </div>
        </div>
    </form>
</div>

<script>
$('#send-msg').click(function(){
	$('#contact-result').hide();
	$.ajax({
		url: '<?=base_url();?>content/sendcontact',
		data: $('#contact-form').serialize(),
		type:'POST',
		dataType:'JSON',
		success:function(data){
			var form_id = 'contact-form';
			if (!data.ok) { 
				// Invalid
				var errors = data.errors;
				//reset error class in form as they will need to be re validated
				remove_error_class(form_id);
				mark_errors(form_id,errors);
			}else{
				$('#contact-result').html('Your message was successfully sent.').removeClass('bg-danger').addClass('bg-success').show();
				remove_error_class(form_id);
				$('#'+form_id)[0].reset();
			}
		}
	});
	
});

function mark_errors(form_id,errors){
	var msg = '';
	errors.forEach(function(e){
		$('#' + form_id).find('[name="' + e.field + '"]').parent().addClass('has-error');
		msg += e.msg+'<br>';
		$('#contact-result').html(msg).addClass('bg-danger').show();
	});	
}

function remove_error_class(form_id){
	$('#'+form_id+' input,#'+form_id+' textarea,#'+form_id+' select,#'+form_id+' date#'+form_id+' email').each(function(){
		$(this).parent().removeClass('has-error');
	});
}

</script>
