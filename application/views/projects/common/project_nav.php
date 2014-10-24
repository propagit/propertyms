<span class="project-prev"><h4><i class="fa fa-angle-double-left"></i> Prev</h4></span>
<span class="project-next"><h4>Next <i class="fa fa-angle-double-right"></i></h4></span>

<script>
$(function(){
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