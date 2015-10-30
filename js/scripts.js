/*!
 * hoverIntent r7 // 2013.03.11 // jQuery 1.9.1+
 * http://cherne.net/brian/resources/jquery.hoverIntent.html
 *
 * You may use hoverIntent under the terms of the MIT license.
 * Copyright 2007, 2013 Brian Cherne
 */
(function(e){e.fn.hoverIntent=function(t,n,r){var i={interval:100,sensitivity:7,timeout:0};if(typeof t==="object"){i=e.extend(i,t)}else if(e.isFunction(n)){i=e.extend(i,{over:t,out:n,selector:r})}else{i=e.extend(i,{over:t,out:t,selector:n})}var s,o,u,a;var f=function(e){s=e.pageX;o=e.pageY};var l=function(t,n){n.hoverIntent_t=clearTimeout(n.hoverIntent_t);if(Math.abs(u-s)+Math.abs(a-o)<i.sensitivity){e(n).off("mousemove.hoverIntent",f);n.hoverIntent_s=1;return i.over.apply(n,[t])}else{u=s;a=o;n.hoverIntent_t=setTimeout(function(){l(t,n)},i.interval)}};var c=function(e,t){t.hoverIntent_t=clearTimeout(t.hoverIntent_t);t.hoverIntent_s=0;return i.out.apply(t,[e])};var h=function(t){var n=jQuery.extend({},t);var r=this;if(r.hoverIntent_t){r.hoverIntent_t=clearTimeout(r.hoverIntent_t)}if(t.type=="mouseenter"){u=n.pageX;a=n.pageY;e(r).on("mousemove.hoverIntent",f);if(r.hoverIntent_s!=1){r.hoverIntent_t=setTimeout(function(){l(n,r)},i.interval)}}else{e(r).off("mousemove.hoverIntent",f);if(r.hoverIntent_s==1){r.hoverIntent_t=setTimeout(function(){c(n,r)},i.timeout)}}};return this.on({"mouseenter.hoverIntent":h,"mouseleave.hoverIntent":h},i.selector)}})(jQuery);


(function() {

$(document).ready(function(e) {
	$html.addClass('jquery');
	nav.init();
	accordion.init();
	product.gallery();
	bab.init();
});

var html = document.documentElement,
	$html = $(html),
	current = 'current',
	close = 'close',
	open = 'open',
	selected = 'selected';

var nav = {
	init: function() {
		$('#nav_main > ul > li').hoverIntent({
			timeout: 500,
			over: function() {
				$(this).addClass(open);
			},
			out: function() {
				$(this).removeClass(open);
			}
		});
	}
};

var accordion = {
	init: function() {
		var $accordionLinks = $('.accordion > li > a'),
			$accordionAll = $('#accordion-all'),
			accordionAllOpen = $accordionAll.text(),
			accordionAllClose = accordionAllOpen.replace('Show', 'Hide');
		
		$accordionLinks.on('click', function(e) {
			e.preventDefault();
			$(this).toggleClass(open);
		});
		
		$accordionAll.on('click', function(e) {
			e.preventDefault();
			var $this = $(this);
			$this.toggleClass(close);
			
			if ($this.hasClass(close)) {
				$this.text(accordionAllClose);
				$accordionLinks.addClass(open);
			}
			else {
				$this.text(accordionAllOpen);
				$accordionLinks.removeClass(open);
			}
		});
	}
};

var product = {
	gallery: function() {
		var $galleryLarge = $('#gallery_lg img'),
			$galleryLinks = $('#gallery_thumbs a');
		
		$galleryLinks.on('click', function(e) {
			e.preventDefault();
			$galleryLinks.removeClass(current);
			var $this = $(this);
			$this.addClass(current);
			$galleryLarge[0].src = $this[0].href.replace('thumb', 'large');
		});
	}
};

var $babItems,
	$babColors,
	$babQtys,
	babQty,
	babCost,
	$babForm,
	$babTotalFlowers,
	$babTotalCost,
	$babUpdatePrice;


var bab = {
	init: function() {
		var $babStep2 = $('#bab_step2'),
			$bab = $('#bab');
	
		$babForm = $('#bab_form');
		$babItems = $('.bab_item');
		$babColors = $babItems.find('select');
		$babQtys = $babItems.find('.text');
		$babTotalFlowers = $('#total_flowers');
		$babTotalCost = $('#total_cost');
		$babUpdatePrice = $('#update_price');
		
		$babQtys.each(function() {
			var $this = $(this);
			$this.on('change', function(e) {
					e.preventDefault();
					bab.calcTotals();
			});
		});
		
		$babColors.each(function() {
			var $this = $(this),
				$img = $this.parent().prevAll('img')[0];
			
			$this.on('change', function() {
				var value = $(this)[0].value.toLowerCase();
				$img.src = $img.src.substring(0, $img.src.lastIndexOf('/')+1) + value + '.jpg';
			});
		});
		
		$babUpdatePrice.on('click', function(e) {
			e.preventDefault();
			bab.calcTotals();
		});
	},
	calcTotals: function() {
		babQty = 0;
		babCost = 0;
		
		$babQtys.each(function() {
			var $this = $(this),
				qty = parseInt($this[0].value),
				cost;
			
			if (!isNaN(qty)) {
				if (qty < 0) {
					$this[0].value = 0;
					qty = 0;
				}
				babQty += qty;
				var $cost = $this.parent().next(':hidden');
				cost = parseFloat($cost.val());
				$cost.text(qty * cost);
				babCost += qty * cost;
			}
		});
		babCost = babCost.toFixed(2);
		$babTotalFlowers.text(babQty);
		$babTotalCost.text(babCost);
	}
};


})();