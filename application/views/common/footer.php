		
        </div><!--end body-wrap-->
        <footer>
        	<div id="footer-wrap">
            	<div class="container">
                    <span>
                        &copy; property marketing solutions. All rights reserved.<br>
                        <a class="footer-links" href="<?=base_url();?>privacy-policy">privacy policy</a> <a class="footer-links" href="<?=base_url();?>disclaimer">disclaimer</a>
                    </span>
                </div>
            </div>
        </footer>


		
	</body>
<script>
$(function(){
	$('.nav-dd').click(function(){
		$('.sub-nav').toggle();
	});
	
	
	
	$('.project-next').click(function(){
		var next_project = $('.sub-nav-active').next().children();
		if(next_project.parent().hasClass('sub-nav')){
			window.location.href = next_project.attr('href');	
		}else{
			window.location.href = '<?=base_url();?>recent-projects/modeina';
		}
	});
	
	$('.project-prev').click(function(){
		var prev_project = $('.sub-nav-active').prev().children();
		if(prev_project.parent().hasClass('sub-nav')){
			window.location.href = prev_project.attr('href');
		}else{
			window.location.href = '<?=base_url();?>recent-projects/mab-corporation';
		}
	});
	
});
</script>
</html>