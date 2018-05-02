function a(){
	var next=$(".next");
	var prev=$(".prev");
	var pos=-1;
	next.click(function(){
		pos--;
		if (pos==-5) {
			pos=-1;
			$('.slideshow').css({left:0+"px"});
		}
		$(".slideshow").animate({left:pos*675+"px"},600);
		showdots();
	})
	prev.click(function(){
		pos++;
		if (pos==0) {
			pos=-4;
			$('.slideshow').css({left:-3375+"px"});
		}
		$(".slideshow").animate({left:pos*675+"px"},600);
		showdots();
	})
    $('.dot').click(function() {
        pos=-$(this).attr("data-index");
        $('.slideshow').animate({left:pos*675+"px"},500);
        showdots();
    })
	function showdots(){
		var dq=-pos-1;
        var dots = $('.dot');
        $(dots).removeClass('active');
        var dot = dots[dq];
        $(dot).addClass('active');
	}
}
export{
	a
}