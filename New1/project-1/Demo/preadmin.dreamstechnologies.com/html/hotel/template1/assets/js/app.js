/*
Author       : Dreamguys
Template Name: Hotel-Admin Template
Version      : 1.0
*/

(function($) {
    "use strict";
	
	$(document).ready(function($) {
	
		// Variables declarations
		
		var $wrapper = $('.main-wrapper');
		var $pageWrapper = $('.page-wrapper');
		var $slimScrolls = $('.slimscroll');
		var $sidebarOverlay = $('.sidebar-overlay');
		
		// Sidebar
		
		var Sidemenu = function() {
			this.$menuItem = $('#sidebar-menu a');
		};

		Sidemenu.prototype.init = function() {
			var $this = this;
			$this.$menuItem.on('click', function(e) {
				if ($(this).parent().hasClass('submenu')) {
					e.preventDefault();
				}
				if (!$(this).hasClass('subdrop')) {
					$('ul', $(this).parents('ul:first')).slideUp(350);
					$('a', $(this).parents('ul:first')).removeClass('subdrop');
					$(this).next('ul').slideDown(350);
					$(this).addClass('subdrop');
				} else if ($(this).hasClass('subdrop')) {
					$(this).removeClass('subdrop');
					$(this).next('ul').slideUp(350);
				}
			});
			$('#sidebar-menu ul li.submenu a.active').parents('li:last').children('a:first').addClass('active').trigger('click');
		},
		
		$.Sidemenu = new Sidemenu;
		
		// Sidebar Initiate
		
		$.Sidemenu.init();

		// Sidebar overlay
		
		function sidebar_overlay($target) {
			if ($target.length) {
				$target.toggleClass('opened');
				$sidebarOverlay.toggleClass('opened');
				$('html').toggleClass('menu-opened');
				$sidebarOverlay.attr('data-reff', '#'+$target[0].id);
			}
		}
	
		// Mobile menu sidebar overlay
		
		$(document).on('click', '#mobile_btn', function () {
			var $target = $($(this).attr('href'));
			sidebar_overlay($target);
			
			$wrapper.toggleClass('slide-nav');
			$('#chat_sidebar').removeClass('opened');
			return false;
		});
		
		// Chat sidebar overlay
		
		$(document).on('click', '#task_chat', function () {
			var $target = $($(this).attr('href'));
			console.log($target);
			sidebar_overlay($target);
			return false;
		});
		
		// Sidebar overlay reset
		
		$sidebarOverlay.on('click', function() {
			var $target = $($(this).attr('data-reff'));
			if ($target.length) {
				$target.removeClass('opened');
				$('html').removeClass('menu-opened');
				$(this).removeClass('opened');
				$wrapper.removeClass('slide-nav');
			}
			return false;
		});
		
		// Select 2

		if ($('.select').length > 0) {
			$('.select').select2({
				minimumResultsForSearch: -1,
				width: '100%'
			});
		}

		// Floating Label

		if ($('.floating').length > 0) {
			$('.floating').on('focus blur', function(e) {
				$(this).parents('.form-focus').toggleClass('focused', (e.type === 'focus' || this.value.length > 0));
			}).trigger('blur');
		}

		// Right Sidebar Scroll

		if ($('#msg_list').length > 0) {
			$('#msg_list').slimscroll({
				height: '100%',
				color: '#878787',
				disableFadeOut: true,
				borderRadius: 0,
				size: '4px',
				alwaysVisible: false,
				touchScrollStep: 100
			});
			var msgHeight = $(window).height() - 124;
			$('#msg_list').height(msgHeight);
			$('.msg-sidebar .slimScrollDiv').height(msgHeight);

			$(window).resize(function() {
				var msgrHeight = $(window).height() - 124;
				$('#msg_list').height(msgrHeight);
				$('.msg-sidebar .slimScrollDiv').height(msgrHeight);
			});
		}

		// Left Sidebar Scroll

		if ($slimScrolls.length > 0) {
			$slimScrolls.slimScroll({
				height: 'auto',
				width: '100%',
				position: 'right',
				size: '7px',
				color: '#ccc',
				wheelStep: 10,
				touchScrollStep: 100
			});
			var wHeight = $(window).height() - 60;
			$slimScrolls.height(wHeight);
			$('.sidebar .slimScrollDiv').height(wHeight);

			$(window).resize(function() {
				var rHeight = $(window).height() - 60;
				$slimScrolls.height(rHeight);
				$('.sidebar .slimScrollDiv').height(rHeight);
			});
		}

		// Page wrapper height

		var pHeight = $(window).height();
		$pageWrapper.css('min-height', pHeight);

		$(window).resize(function() {
			var prHeight = $(window).height();
			$pageWrapper.css('min-height', prHeight);
		});

		// Datetimepicker

		if ($('.datetimepicker').length > 0) {
			$('.datetimepicker').datetimepicker({
				format: 'DD/MM/YYYY'
			});
		}

		// Datatable

		if ($('.datatable').length > 0) {
			$('.datatable').DataTable({
				"bFilter": false,
			});
		}

		// Bootstrap Tooltip

		if ($('[data-toggle="tooltip"]').length > 0) {
			$('[data-toggle="tooltip"]').tooltip();
		}
		
		// Bootstrap Popover

		if ($('[data-toggle="popover"]').length > 0) {
			$('[data-toggle="popover"]').popover();
		}
		
		// File Upload 
		
		if($('.custom-file-container').length > 0) {
			//First upload
			var firstUpload = new FileUploadWithPreview('myFirstImage')
			//Second upload
			var secondUpload = new FileUploadWithPreview('mySecondImage')
		}
		
		// Clipboard 
		
		if($('.clipboard').length > 0) {
			var clipboard = new Clipboard('.btn');
		}
		
		// Counter 
		
		if($('.counter').length > 0) {
		   $('.counter').counterUp({
				delay: 20,
				time: 2000
		   });
		}
		
		if($('#timer-countdown').length > 0) {
			$( '#timer-countdown' ).countdown( {
				from: 180, // 3 minutes (3*60)
				to: 0, // stop at zero
				movingUnit: 1000, // 1000 for 1 second increment/decrements
				timerEnd: undefined,
				outputPattern: '$day Day $hour : $minute : $second',
				autostart: true
			});
		}
		
		if($('#timer-countup').length > 0) {
			$( '#timer-countup' ).countdown( {
				from: 0,
				to: 180 
			});
		}
		
		if($('#timer-countinbetween').length > 0) {
			$( '#timer-countinbetween' ).countdown( {
				from: 30,
				to: 20 
			});
		}
		
		if($('#timer-countercallback').length > 0) {
			$( '#timer-countercallback' ).countdown( {
				from: 10,
				to: 0,
				timerEnd: function() {
					this.css( { 'text-decoration':'line-through' } ).animate( { 'opacity':.5 }, 500 );
				} 
			});
		}
		
		if($('#timer-outputpattern').length > 0) {
			$( '#timer-outputpattern' ).countdown( {
				outputPattern: '$day Days $hour Hour $minute Min $second Sec..',
				from: 60 * 60 * 24 * 3
			});
		}

		// Mobile Menu

		$(document).on('click', '#open_msg_box', function () {
			$wrapper.toggleClass('open-msg-box');
			return false;
		});

		// Lightgallery
		
		if ($('#lightgallery').length > 0) {
			$('#lightgallery').lightGallery({
				thumbnail: true,
				selector: 'a'
			});
		}
		
		// Incoming call popup
		
		if ($('#incoming_call').length > 0) {
			$('#incoming_call').modal('show');
		}

		// Summernote

		if ($('.summernote').length > 0) {
			$('.summernote').summernote({
				height: 200,
				minHeight: null,
				maxHeight: null,
				focus: false
			});
		}

		// Check all email

		$(document).on('click', '#check_all', function () {
			$('.checkmail').click();
			return false;
		});
			
		if ($('.checkmail').length > 0) {
			$('.checkmail').each(function() {
				$(this).on('click', function() {
					if ($(this).closest('tr').hasClass('checked')) {
						$(this).closest('tr').removeClass('checked');
					} else {
						$(this).closest('tr').addClass('checked');
					}
				});
			});
		}

		// Mail important

		$(document).on('click', '.mail-important', function () {
			$(this).find('i.fa').toggleClass('fa-star');
			$(this).find('i.fa').toggleClass('fa-star-o');
		});

		// Dropfiles

		if ($('#drop-zone').length > 0) {
			var dropZone = document.getElementById('drop-zone');
			var uploadForm = document.getElementById('js-upload-form');
			var startUpload = function(files) {
				console.log(files);
			};

			uploadForm.addEventListener('submit', function(e) {
				var uploadFiles = document.getElementById('js-upload-files').files;
				e.preventDefault();

				startUpload(uploadFiles);
			});

			dropZone.ondrop = function(e) {
				e.preventDefault();
				this.className = 'upload-drop-zone';

				startUpload(e.dataTransfer.files);
			};

			dropZone.ondragover = function() {
				this.className = 'upload-drop-zone drop';
				return false;
			};

			dropZone.ondragleave = function() {
				this.className = 'upload-drop-zone';
				return false;
			};

		}

		// Small Sidebar
		
		if (screen.width >= 992) {
			$(document).on('click', '#toggle_btn', function () {
				if($('body').hasClass('mini-sidebar')) {
					$('body').removeClass('mini-sidebar');
					$('.subdrop + ul').slideDown();
				} else {
					$('body').addClass('mini-sidebar');
					$('.subdrop + ul').slideUp();
				}
				return false;
			});	
			
			$(document).on('mouseover', function(e){
				e.stopPropagation();
				if($('body').hasClass('mini-sidebar') && $('#toggle_btn').is(':visible')) {
					var targ = $(e.target).closest('.sidebar').length;
					if(targ) {
						$('body').addClass('expand-menu');
						$('.subdrop + ul').slideDown();
					} else {
						$('body').removeClass('expand-menu');
						$('.subdrop + ul').slideUp();
					}
					return false;
				}
			});
		}
	});

// Inspect keyCode

	$( window ).on( "load", function() {
		document.onkeydown = function(e) {
			if(e.keyCode == 123) {
			 return false;
			}
			if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)){
			 return false;
			}
			if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)){
			 return false;
			}
			if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)){
			 return false;
			}
		
			if(e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)){
			 return false;
			}      
		 };
		 
	});

	document.oncontextmenu = function() {return false;};
		$(document).mousedown(function(e){ 
		if( e.button == 2 ) { 
			return false; 
		} 
		return true; 
	});

})(jQuery);
