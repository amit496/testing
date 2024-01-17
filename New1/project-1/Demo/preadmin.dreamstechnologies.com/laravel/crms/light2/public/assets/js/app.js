/*
Author       : Dreamguys
Template Name: Crypto -  Admin Template
Version      : 1.1
*/

(function($) {
    "use strict";
	
	// Variables declarations
	
	var $wrapper = $('.main-wrapper');
	var $pageWrapper = $('.page-wrapper');
	var $slimScrolls = $('.slimscroll');
	
	// Sidebar
	
	var Sidemenu = function() {
		this.$menuItem = $('#sidebar-menu a');
	};
	
	function init() {
		var $this = Sidemenu;
		$('#sidebar-menu a').on('click', function(e) {
			if($(this).parent().hasClass('submenu')) {
				e.preventDefault();
			}
			if(!$(this).hasClass('subdrop')) {
				$('ul', $(this).parents('ul:first')).slideUp(350);
				$('a', $(this).parents('ul:first')).removeClass('subdrop');
				$(this).next('ul').slideDown(350);
				$(this).addClass('subdrop');
			} else if($(this).hasClass('subdrop')) {
				$(this).removeClass('subdrop');
				$(this).next('ul').slideUp(350);
			}
		});
		$('#sidebar-menu ul li.submenu a.active').parents('li:last').children('a:first').addClass('active').trigger('click');
	}
	
	// Sidebar Initiate
	init();
	
	// Mobile menu sidebar overlay
	
	$('body').append('<div class="sidebar-overlay"></div>');
	$(document).on('click', '#mobile_btn', function() {
		$wrapper.toggleClass('slide-nav');
		$('.sidebar-overlay').toggleClass('opened');
		$('html').addClass('menu-opened');
		return false;
	});
	
	// Sidebar overlay
	
	$(".sidebar-overlay").on("click", function () {
		$wrapper.removeClass('slide-nav');
		$(".sidebar-overlay").removeClass("opened");
		$('html').removeClass('menu-opened');
	});
	
	// Page Content Height
	
	if($('.page-wrapper').length > 0 ){
		var height = $(window).height();	
		$(".page-wrapper").css("min-height", height);
	}
	
	// Page Content Height Resize
	
	$(window).resize(function(){
		if($('.page-wrapper').length > 0 ){
			var height = $(window).height();
			$(".page-wrapper").css("min-height", height);
		}
	});
	
	// Select 2
	
    if ($('.select').length > 0) {
        $('.select').select2({
            minimumResultsForSearch: -1,
            width: '100%'
        });
    }

    // Floating Label
	if($('.floating').length > 0) {
		$('.floating').on('focus blur', function(e) {
			$(this).parents('.form-focus').toggleClass('focused', (e.type === 'focus' || this.value.length > 0));
		}).trigger('blur');
	}
	
	// Datetimepicker
	
	if($('.datetimepicker').length > 0 ){
		$('.datetimepicker').datetimepicker({
			format: 'DD/MM/YYYY',
			icons: {
				up: "fa fa-angle-up",
				down: "fa fa-angle-down",
				next: 'fa fa-angle-right',
				previous: 'fa fa-angle-left'
			}
		});
		$('.datetimepicker').on('dp.show',function() {
			$(this).closest('.table-responsive').removeClass('table-responsive').addClass('temp');
		}).on('dp.hide',function() {
			$(this).closest('.temp').addClass('table-responsive').removeClass('temp')
		});
	}

	// Tooltip
	
	if($('[data-toggle="tooltip"]').length > 0 ){
		$('[data-toggle="tooltip"]').tooltip();
	}
	
    // Datatable

    if ($('.datatable').length > 0) {
        $('.datatable').DataTable({
            "bFilter": false,
        });
    }
	
	// Email Inbox

	if($('.clickable-row').length > 0 ){
		$(document).on('click', '.clickable-row', function() {
			window.location = $(this).data("href");
		});
	}

	// Check all email
	
	$(document).on('click', '#check_all', function() {
		$('.checkmail').click();
		return false;
	});
	if($('.checkmail').length > 0) {
		$('.checkmail').each(function() {
			$(this).on('click', function() {
				if($(this).closest('tr').hasClass('checked')) {
					$(this).closest('tr').removeClass('checked');
				} else {
					$(this).closest('tr').addClass('checked');
				}
			});
		});
	}
	
	// Mail important
	
	$(document).on('click', '.mail-important', function() {
		$(this).find('i.fa').toggleClass('fa-star').toggleClass('fa-star-o');
	});
	
	$(document).on('mouseover', function (e) {
		e.stopPropagation();
		if ($('body').hasClass('mini-sidebar') && $('#toggle_btn').is(':visible')) {
			var targ = $(e.target).closest('.sidebar').length;
			if (targ) {
				$('body').addClass('expand-menu');
				$('.subdrop + ul').slideDown();
			} else {
				$('body').removeClass('expand-menu');
				$('.subdrop + ul').slideUp();
			}
			return false;
		}
	});
	
	$(document).on('click', '#filter_search', function() {
		$('#filter_inputs').slideToggle("slow");
	});
	
	if($('.custom-file-container').length > 0) {
        //First upload
        var firstUpload = new FileUploadWithPreview('myFirstImage');
        //Second upload
        var secondUpload = new FileUploadWithPreview('mySecondImage');
	}
    
	// Clipboard 
	
	if($('.clipboard').length > 0) {
		var clipboard = new Clipboard('.btn');
	}

	// Summernote
	
	if($('.summernote').length > 0) {
		$('.summernote').summernote({
			height: 300,
			minHeight: null,
			maxHeight: null,
			focus: false
		});
	}
	
	// Tooltip
	
	if($('[data-bs-toggle="tooltip"]').length > 0) {
		var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
		var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
		  return new bootstrap.Tooltip(tooltipTriggerEl)
		})
	}
	
	// Popover
	
	if($('.popover-list').length > 0) {
		var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
		var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
		  return new bootstrap.Popover(popoverTriggerEl)
		})
	}
	if($('[data-toggle="popover"]').length > 0) {
		$('[data-toggle="popover"]').popover();
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

    // Lightgallery

    if ($('#pro_popup').length > 0) {
        $('#pro_popup').lightGallery({
            thumbnail: true,
            selector: 'a'
        });
    }
	
	// Sidebar Slimscroll

	if($slimScrolls.length > 0) {
		$slimScrolls.slimScroll({
			height: 'auto',
			width: '100%',
			position: 'right',
			size: '7px',
			color: '#ccc',
			allowPageScroll: false,
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
	
	// Small Sidebar

	$(document).on('click', '#toggle_btn', function() {
		if($('body').hasClass('mini-sidebar')) {
			$('body').removeClass('mini-sidebar');
			$('.subdrop + ul').slideDown();
		} else {
			$('body').addClass('mini-sidebar');
			$('.subdrop + ul').slideUp();
		}
		return false;
	});
	$(document).on('mouseover', function(e) {
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

	//datetimepicker
	if($('#datetimepicker1').length > 0) {
		$(function () {
			$('#datetimepicker1').datetimepicker();
			$('#datetimepicker2').datetimepicker();
			$('#datetimepicker5').datetimepicker();
			$('#datetimepicker6').datetimepicker();
			$('#datetimepicker7').datetimepicker();
			$('#datetimepicker8').datetimepicker();
		});
	}

    // Revenue Chart
	if($('#revenue-chart').length > 0) {	
		var options = {
			colors: ['#8BA88F'],
			series: [{
				name: 'Revenue',
				data: [0.8, 1.3, 2.5, 2.1, 1.3, 2.4, 0.6, 2.4, 2.1, 1.5, 2.2, 0.6, 1.0, 1.5, 2.1, 1.9, 2.4, 2.1, 1.5, 2.2, 1, 0.4]
		  	}],
			chart: {
				height: 150,
				type: 'bar',
				toolbar: {
					show: false
				}
			},
			grid: {
				show: false
			},
			plotOptions: {
				bar: {
				borderRadius: 10,
				columnWidth: '20%',
				dataLabels: {
					position: 'top',
				},
				},
				stroke: {
					width: 10,
					colors: ["#fff"]
				}
			},
			dataLabels: {
				enabled: false,
				formatter: function (val) {
				return val + "%";
				},
				offsetY: -20,
				style: {
				fontSize: '12px',
				colors: ["#8BA88F"]
				}
			},		  
			xaxis: {
				categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
				position: 'top',
				axisBorder: {
				show: false
				},
				axisTicks: {
				show: false
				},
				crosshairs: {
				fill: {
					type: 'gradient',
					gradient: {
					colorFrom: '#8BA88F',
					colorTo: '#8BA88F',
					stops: [0, 100],
					opacityFrom: 0.4,
					opacityTo: 0.5,
					}
				}
				},
				tooltip: {
				enabled: true,
				}
			},
			yaxis: {
				axisBorder: {
					show: false
				},
				axisTicks: {
					show: false,
				},
				labels: {
				show: false,
					formatter: function (val) {
						return val + "%";
					}
				}			
			}
		};  
		var chart = new ApexCharts(document.querySelector("#revenue-chart"), options);
		chart.render();
	}
	if($('#revenue-chart2').length > 0) {
		var options = {
			colors: ['#d0cbef'],
			series: [{
				name: 'Revenue',
				data: [0.8, 1.3, 2.5, 2.1, 1.3, 2.4, 0.6, 2.4, 2.1, 1.5, 2.2, 0.6, 1.0, 1.5, 2.1, 1.9, 2.4, 2.1, 1.5, 2.2, 1, 0.4]
		  	}],
			chart: {
				height: 150,
				type: 'bar',
				toolbar: {
					show: false
				}
			},
			grid: {
				show: false
			},
			plotOptions: {
				bar: {
				borderRadius: 10,
				columnWidth: '20%',
				dataLabels: {
					position: 'top',
				},
				},
				stroke: {
					width: 10,
					colors: ["#fff"]
				}
			},
			dataLabels: {
				enabled: false,
				formatter: function (val) {
				return val + "%";
				},
				offsetY: -20,
				style: {
				fontSize: '12px',
				colors: ["#8BA88F"]
				}
			},		  
			xaxis: {
				categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
				position: 'top',
				axisBorder: {
				show: false
				},
				axisTicks: {
				show: false
				},
				crosshairs: {
				fill: {
					type: 'gradient',
					gradient: {
					colorFrom: '#8BA88F',
					colorTo: '#8BA88F',
					stops: [0, 100],
					opacityFrom: 0.4,
					opacityTo: 0.5,
					}
				}
				},
				tooltip: {
				enabled: true,
				}
			},
			yaxis: {
				axisBorder: {
					show: false
				},
				axisTicks: {
					show: false,
				},
				labels: {
				show: false,
					formatter: function (val) {
						return val + "%";
					}
				}			
			}
		}; 
		var chart = new ApexCharts(document.querySelector("#revenue-chart2"), options);
		chart.render();
	}
	if($('#revenue-chart3').length > 0) {	
		var options = {
			colors: ['#DFB19C'],
			series: [{
				name: 'Revenue',
				data: [0.8, 1.3, 2.5, 2.1, 1.3, 2.4, 0.6, 2.4, 2.1, 1.5, 2.2, 0.6, 1.0, 1.5, 2.1, 1.9, 2.4, 2.1, 1.5, 2.2, 1, 0.4]
		  	}],
			chart: {
				height: 150,
				type: 'bar',
				toolbar: {
					show: false
				}
			},
			grid: {
				show: false
			},
			plotOptions: {
				bar: {
				borderRadius: 10,
				columnWidth: '20%',
				dataLabels: {
					position: 'top',
				},
				},
				stroke: {
					width: 10,
					colors: ["#fff"]
				}
			},
			dataLabels: {
				enabled: false,
				formatter: function (val) {
				return val + "%";
				},
				offsetY: -20,
				style: {
				fontSize: '12px',
				colors: ["#8BA88F"]
				}
			},		  
			xaxis: {
				categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
				position: 'top',
				axisBorder: {
				show: false
				},
				axisTicks: {
				show: false
				},
				crosshairs: {
				fill: {
					type: 'gradient',
					gradient: {
					colorFrom: '#8BA88F',
					colorTo: '#8BA88F',
					stops: [0, 100],
					opacityFrom: 0.4,
					opacityTo: 0.5,
					}
				}
				},
				tooltip: {
				enabled: true,
				}
			},
			yaxis: {
				axisBorder: {
					show: false
				},
				axisTicks: {
					show: false,
				},
				labels: {
				show: false,
					formatter: function (val) {
						return val + "%";
					}
				}			
			}
		};  
		var chart = new ApexCharts(document.querySelector("#revenue-chart3"), options);
		chart.render();
	}
	if($('#revenue-chart4').length > 0) {
		var options = {
			colors: ['#77B5C6'],
			series: [{
				name: 'Revenue',
				data: [0.8, 1.3, 2.5, 2.1, 1.3, 2.4, 0.6, 2.4, 2.1, 1.5, 2.2, 0.6, 1.0, 1.5, 2.1, 1.9, 2.4, 2.1, 1.5, 2.2, 1, 0.4]
		  	}],
			chart: {
				height: 150,
				type: 'bar',
				toolbar: {
					show: false
				}
			},
			grid: {
				show: false
			},
			plotOptions: {
				bar: {
				borderRadius: 10,
				columnWidth: '20%',
				dataLabels: {
					position: 'top',
				},
				},
				stroke: {
					width: 10,
					colors: ["#fff"]
				}
			},
			dataLabels: {
				enabled: false,
				formatter: function (val) {
				return val + "%";
				},
				offsetY: -20,
				style: {
				fontSize: '12px',
				colors: ["#8BA88F"]
				}
			},		  
			xaxis: {
				categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
				position: 'top',
				axisBorder: {
				show: false
				},
				axisTicks: {
				show: false
				},
				crosshairs: {
				fill: {
					type: 'gradient',
					gradient: {
					colorFrom: '#8BA88F',
					colorTo: '#8BA88F',
					stops: [0, 100],
					opacityFrom: 0.4,
					opacityTo: 0.5,
					}
				}
				},
				tooltip: {
				enabled: true,
				}
			},
			yaxis: {
				axisBorder: {
					show: false
				},
				axisTicks: {
					show: false,
				},
				labels: {
				show: false,
					formatter: function (val) {
						return val + "%";
					}
				}			
			}
		};
		var chart = new ApexCharts(document.querySelector("#revenue-chart4"), options);
		chart.render();
	}
	
	// Project Chart
	if($('#pro-project').length > 0) {	
		var options = {
			colors : ['#251B8A', '#8BA88F', '#9B715D'],
			series: [{
				name: 'Test 1',
				data: [10, 20, 30, 15, 8, 25, 18, 22, 16, 23, 28, 20, 7, 18, 6, 18]
			}, {
				name: 'Test 2',
				data: [10, 20, 30, 15, 8, 25, 18, 22, 16, 23, 28, 20, 7, 18, 6, 18]
			}, {
				name: 'Test 3',
				data: [10, 20, 30, 15, 8, 25, 18, 22, 16, 23, 28, 20, 7, 18, 6, 18]
			}],
				chart: {
				type: 'bar',
				height: 300,
				stacked: true,
				toolbar: {
				show: false
				},
				zoom: {
				enabled: true
				}
			},
			responsive: [{
				breakpoint: 480,
				options: {
				legend: {
					position: 'bottom',
					offsetX: -10,
					offsetY: 0
				}
				}
			}],
			plotOptions: {
				bar: {
					borderRadius: '80%',
					columnWidth: '20%',
					dataLabels: {
						position: 'top', // top, center, bottom
					},
					horizontal: false,
				},				
				stroke: {
					width: 80,
					colors: ["#fff"]
				}
			},
			xaxis: {
				type: 'years',
				categories: ['2006', '2007', '2008', '2009',
				'2010', '2011', '2012', '2013', '2014', '2015', '2016', '2017', '2018', '2019', '2020', '2021'
				],
			},
			legend: {
				show: false
			},
			fill: {
				opacity: 1
			},
			dataLabels: {
				enabled: false
			}
		};
  
		var chart = new ApexCharts(document.querySelector("#pro-project"), options);
		chart.render();
	}
	
	//rounded 3d chart
	if($('#pro-round').length > 0) {	
		var options = {
			series: [50, 25, 15, 5],
			colors : ['#251B8A', '#55A55E', '#3A7F92', '#9B715D'],
				name: ['pro', 'web', 'box', 'nam'],
				chart: {
				width: 300,
				height: 300,
				type: 'donut',
			},
			plotOptions: {
				pie: {
				startAngle: -160,
				endAngle: 270
				}
			},
			dataLabels: {
				enabled: false
			},
			fill: {
				type: 'gradient',
			},
			legend: {
				formatter: function(val, opts) {
					return val + " - " + opts.w.globals.series[opts.seriesIndex]
				},
				position: 'bottom'
			},
			title: {
				text: 'Projects',
				align: 'center',
				style : {
					color: '#3629B7'
				}
			},
			responsive: [{
				breakpoint: 567,
				options: {
					chart: {
						width: 250,
						height: 250,
					},
					legend: {
						position: 'bottom'
					}
				},				
				breakpoint: 480,
				options: {
					chart: {
						width: 200
					},
					legend: {
						position: 'bottom'
					}
				}
			}]
		};
  
		  var chart = new ApexCharts(document.querySelector("#pro-round"), options);
		  chart.render();
	}
	
	//line chart
	if($('#pro-line').length > 0) {
		var options = {
			series: [
				{
					name: 'Target',
					data: [312, 611, 414, 660]
				},
				{
					name: 'Starbucks',
					data: [200, 480, 306, 545]
				},
				{
					name: 'Task',
					data: [500, 356, 646, 500]
				},
				{
					name: 'Task2',
					data: [450, 300, 580, 400]
				}
			],
			chart: {
				height: 300,
				type: 'line',
				dropShadow: {
				enabled: true,
				color: '#000',
				top: 18,
				left: 7,
				blur: 10,
				opacity: 0.1
				},
				toolbar: {
				show: false
				}
			},
			stroke: {
				width: [2, 2, 2, 2]
			},
			colors: ['#3629B7', '#43BCCD', '#8BA88F', '#9B715D'],
			dataLabels: {
				enabled: false,
			},
			grid: {
				borderColor: '#EBECF1',
				row: {
				opacity: 0.5
				},
			},
			markers: {
				size: 5
			},
			xaxis: {
				categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul']
			},
			yaxis: {
				min: 0,
				max: 800
			},
			legend: {
				tooltipHoverFormatter: function(val, opts) {
					return val + ' - ' + opts.w.globals.series[opts.seriesIndex][opts.dataPointIndex] + ''
				}
			}
		};
	
		var chart = new ApexCharts(document.querySelector("#pro-line"), options);
		chart.render();
	}

	//task chart
	if($('#pro-task').length > 0) {
		var options = {
			chart: {
				height: 300,
				type: "area",
				toolbar: {
					show: false
				},
			},
			dataLabels: {
				enabled: false
			},
			stroke: {
				curve: "smooth"
			},
			series: [{
				name: "Total Income",
				color: '#b6b0e1',
				data: [14, 20, 54, 32, 65, 50, 60]
			}, {				
				name: "Total Outcome",
				color: '#ffcccc',
				data: [41, 52, 40, 62, 40, 30, 11]
			}],
			xaxis: {
				type: 'date',
				categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
			}
		}
		var chart = new ApexCharts(
			document.querySelector("#pro-task"),
			options
		);
		chart.render();
	}
	
})(jQuery);