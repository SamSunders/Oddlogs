(function($, w, d, undef) {
	$(d).bind("pagecreate", function(e) {
		$(".wiziapp-be-in-touch-homescreen-gallery", e.target).each(function() {
			var pos = 0,
				cnt = $(".wiziapp-be-in-touch-homescreen-gallery-scroller", this),
				max = $(".wiziapp-be-in-touch-homescreen-gallery-image", cnt).length-1,
				lbtn = $(".wiziapp-be-in-touch-homescreen-gallery-button-left", this),
				rbtn = $(".wiziapp-be-in-touch-homescreen-gallery-button-right", this);
			if (pos < max) {
				rbtn.show();
			}
			lbtn.click(function() {
				if (pos <= 0) {
					return;
				}
				var newpos = --pos;
				cnt.animate({"left":(-newpos*100)+"%"}, function() {
					if (newpos <= 0)
					{
						lbtn.hide();
					}
					rbtn.show();
				});
			});
			rbtn.click(function() {
				if (pos >= max) {
					return;
				}
				var newpos = ++pos;
				cnt.animate({"left":(-newpos*100)+"%"}, function() {
					if (newpos >= max)
					{
						rbtn.hide();
					}
					lbtn.show();
				});
			});
		});
	});
})(jQuery, window, document);
