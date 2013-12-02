jQuery.noConflict();

jQuery("document").ready(function($){
	var post_uri = tmp_uri + "/inc/handle_ajax.php",
		top_menu = $('#top_menu'),
		loader 	 = $('<div class="loading"><i class="icon-spinner icon-spin icon-3x"></i></div>').css({
						'margin-top' : $(window).height()/2
					});;

	$('body').addClass('oh');


	var Portfolio = {
		settings 	: {uri: 1, color: 'blue'},
		works_div	: $('#works'),
		preview_div	: $('#work_preview'),
		body		: $('body'),

		item : function (options) {
			Portfolio.settings 	= $.extend({}, Portfolio.settings, options);
			return this;
		},

		show : function(){
			var $this = Portfolio;
			$this.body.addClass('oh');

			$this.works_div.stop(true, true).animate({
				'top' : '10%'
			}, 700, 'easeOutQuint');

			$this.fetch()
				.preview_div
				.show()
				.stop(true, true)
				.animate({
					'top' : '0'
				}, 700, 'easeOutQuint', function(){
					$this.body.removeAttr('style');
				});

			return this;
		},

		hide: function () {
			var $this = Portfolio;

			$this.works_div.stop(true, true).animate({
				'top' : '0'
			}, 700, 'easeOutQuint');

			$this.preview_div
				.stop(true, true)
				.animate({
					'top' : '-150%'
				}, 700, 'easeOutQuint', function(){
					$this.body.removeClass('oh');
					$(this).hide();
					$(this).html('');
				});
		},

		fetch: function(){
			var $this = Portfolio;
			$this.preview_div
				.append(loader)
				.load($this.settings.uri+ ' #work_preview_container', function(){
					var $this = $(this);
					$this.imagesLoaded(function(){
						$this.find('.work-slides').cycle({
							fx: 'scrollHorz',
							timeout: 5000,
							prev: '#slide_nav_left',
							next: '#slide_nav_right'
						});
						loader.remove();
					});

				});


			return $this;
		}
	};


	var Navigate = {
		menu_section : $('#menu_section'), 
		main_wrapper : $('#main_wrapper'),
		moved		 : false,
		nav_trigger	 : $('.nav-trigger'),

		elem : function (item) {
			$('.circle').removeClass('active');
			Navigate.item = item.addClass('active');
			Navigate.moved = item.hasClass('moved');
			return this;
		},

		go: function(){
			var $this = Navigate,
				to = $this.item.data('to');

			if(!$this.moved)
				$this.pull_nav_section('up');

			$this.goto_section(to);

			return $this;
		},

		//PRIVATE METHODS
		pull_nav_section: function(towards){
			var $this = Navigate; 
			$this.nav_trigger.data('nav', towards);

			if(towards == 'down'){
				//moving the menu items' positions
				//$this.move_circles('up');
				$('body').addClass('oh');

				$this.nav_trigger
					.appendTo($this.menu_section)

				$this.menu_section.show().stop(true, true).animate({
					'top'	: '0'
				}, 700, 'easeOutQuint');

				$this.main_wrapper.stop(true, true).animate({
					'top' : '400px'
				}, 700, 'easeOutQuint');
			}else{
				$('body').removeClass('oh');

				$this.nav_trigger
					.insertAfter($this.menu_section)

				$this.menu_section.stop(true, true).animate({
					'top'	: '-120%'
				}, 700, 'easeOutQuint').hide();

				$this.main_wrapper.stop(true, true).animate({
					'top' : '0'
				}, 700, 'easeOutQuint');

				//moving the menu items' positions
				//$this.move_circles('down');
			}
			return $this;
		},

		goto_section: function(section){
			var pos = $('#'+section).offset().top;

			$('html, body').animate({
				scrollTop: (pos > 0) ? pos-400 : 0
			}, 1000, 'easeOutQuint');

			return this;
		},

		move_circles: function(towards){
			var $this = Navigate; 

			if(towards == 'down'){
				if(!$this.moved){
					$this.menu_section
						.find('.nav-item')
						.addClass('moved')
						.attr('style', 'position:relative; display:block;')
						.animate({
							'top' : parseInt( $this.menu_section.css('height') ),
							'margin-top': '15px',
							'margin-right' : '20px',
							'left' : - $('.main').offset().left + 30
						});
				}
			}else{
				$this.menu_section
					.find('.nav-item')
					.removeClass('moved')
					.animate({
						'top' : 0,
						'left' : '30%'
					}, function(){ $(this).removeAttr('style') });
			}
			return $this;
		}
	}

	$('.nav-item').click(function(){
		Navigate.elem($(this)).go();
	});

	$('.nav-trigger').on('click', function(){
		var towards = $(this).data('nav') == 'down' ? 'up' : 'down';
		Navigate.pull_nav_section(towards);

	});


	$('#works .item-img').click(function(){
		Portfolio.item({uri: $(this).data('uri')}).show();
	});

	Portfolio.preview_div.on('click', '.hide-work-preview', function(){
		Portfolio.hide();
	});

	$('.top-img').click(function(){
		$('#menu_section').stop(true, true).animate({
			'top'	: '0'
		}, 1000, 'easeOutQuint');


		$('#main_wrapper').stop(true, true).animate({
			'padding-top' : '25%'
		}, 1000, 'easeOutQuint');
	});
		
	$(".menu-item a").each(function(index, el){
		$(el).parent().on('click', function(e){
			var hash = $(el).attr('href').split('#')[1],
				section = $('#'+hash),
				pos = section.offset().top;
			
			$('html, body').animate({
				scrollTop: (pos > 0) ? pos-100 : 0
			}, 1800, 'easeOutQuint');

			$('.menu-item').removeClass('active');
			$('.tooltip').hide();
			$(this).toggleClass('active').find('.tooltip').toggle();
		});

		$(el).after('<span class="tooltip">'+$(this).text()+'</span>');

	});

	$('.menu-item').hover(function(){
		if(!$(this).hasClass('active')){
			$(this).find('.tooltip').toggle();
		}
	}, function(){
		if(!$(this).hasClass('active')){
			$(this).find('.tooltip').toggle();
		}
	});

	$(".skill-meter").knob({
		draw : function () {

            // "tron" case
            if(this.$.data('skin') == 'tron') {

                var a = this.angle(this.cv)  // Angle
                    , sa = this.startAngle          // Previous start angle
                    , sat = this.startAngle         // Start angle
                    , ea                            // Previous end angle
                    , eat = sat + a                 // End angle
                    , r = true;

                this.g.lineWidth = this.lineWidth;

                this.o.cursor
                    && (sat = eat - 0.3)
                    && (eat = eat + 0.3);

                if (this.o.displayPrevious) {
                    ea = this.startAngle + this.angle(this.value);
                    this.o.cursor
                        && (sa = ea - 0.3)
                        && (ea = ea + 0.3);
                    this.g.beginPath();
                    this.g.strokeStyle = this.previousColor;
                    this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
                    this.g.stroke();
                }

                this.g.beginPath();
                this.g.strokeStyle = r ? this.o.fgColor : this.fgColor ;
                this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
                this.g.stroke();

                this.g.lineWidth = 4;
                this.g.beginPath();
                this.g.strokeStyle = this.o.fgColor;
                this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
                this.g.stroke();

                return false;
            }
        }
	});
	
	$('.testimonial-items').cycle({
		fx: 'fade',
		timeout: 5000
	});

	$(window).scroll(function(){
		if($(this).scrollTop() > 200){
			top_menu.addClass('fixed');
		}else{
			top_menu.removeClass('fixed');
		}
	});

	$(window).load(function(){
		$('#works .wrap').isotope({
			animationEngine: "jquery"
		});

		$('.work-filters li').click(function(){
			var selector = $(this).attr('data-filter');
			$('#works .wrap').isotope({
				filter: selector		
			});
			return false;
		});
	});

	$('.item-img .wp-post-image').removeAttr('width height');

	//$('.works-filter .freelance').trigger('click');

	//draw the google map and mark the areas
	var map;
	function initialize() {	
		var myOptions = {
				zoom: 4,
				mapTypeId: google.maps.MapTypeId.ROADMAP,
    			disableDefaultUI: true
			},
			all = [
				["Location 1", "London", "51.51121", "-0.11982"],
				["Location 1", "Palermo", "38.11569", "13.36127"],
				["Location 1", "Turin", "45.07098", "7.68568"]
			],
			infoWindow = new google.maps.InfoWindow;

		map = new google.maps.Map(document.getElementById('map_canvas'), myOptions);
		// Set the center of the map
		var pos = new google.maps.LatLng(all[0][2], all[0][3]);

		map.setCenter(pos);
		function infoCallback(infowindow, marker) {
			return function() {
				infowindow.open(map, marker);
			};
		}	
		function setMarkers(map, all) {	
			for (var i in all) {	
				var name = all[i][0],
					city = all[i][1],
					lat = all[i][2],
					lng = all[i][3],
					latlngset;

				latlngset = new google.maps.LatLng(lat, lng);

				var marker = new google.maps.Marker({
						map: map, title: city, position: latlngset
					}),
					content = '<div class="map-content"><h3>' + name + city + ', <br /></div>',
					infowindow = new google.maps.InfoWindow();

				infowindow.setContent(content);
				//infowindow.open(map, marker);
				google.maps.event.addListener(marker, 'click', infoCallback(infowindow, marker));
			}
		}	
		// Set all markers in the all variable
		setMarkers(map, all);
	};
	// Initializes the Google Map
	google.maps.event.addDomListener(window, 'load', initialize);

	
	//contact form functionality
	var contact_form = $("#contact_form");
	
	contact_form.validate({
		rules: {
			name: {
				required: true,
				minlength: 3
			},
			email: {
				required: true,
				email: true
			},
			message: {
				required: true,
				minlength: 3
			}
		},
		messages: {
			name: "write your name",
			email: "invalid email address",
			message: "write a message"
		}
	});
	$("#submit_form").click(function(){
		if(contact_form.valid()){
			var contact_form_data = contact_form.serialize();
			$.post(contact_form.attr("action"), contact_form_data, function(msg){
				console.log(msg.status);
				contact_form.slideUp().next().delay(800).fadeIn("slow");
			}, "json");
		}
	});
});