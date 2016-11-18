(function ($) {
    "use strict";
    $(document).ready(function () {
        if ($.fn.plot) {
			// start loader
			document.dispatchEvent(new CustomEvent('loadingStart'));
			$.get(base_url + 'home/btechProgress', function (result) {
				// stop loader
				document.dispatchEvent(new CustomEvent('loadingComplete'));
				var data = ([{
					data: JSON.parse(result).progress,
					lines: {
						show: true,
						fill: true,
						lineWidth: 2,
						fillColor: {
							colors: ["rgba(255,255,255,.1)", "rgba(160,220,220,.8)"]
						}
					}
				}]);
				var options = {
					grid: {
						backgroundColor: {
							colors: ["#fff", "#fff"]
						},
						borderWidth: 0,
						borderColor: "#f0f0f0",
						margin: 0,
						minBorderMargin: 0,
						labelMargin: 20,
						hoverable: true,
						clickable: true
					},
					// Tooltip
					tooltip: true,
					tooltipOpts: {
						content: "Semester: %x Percentage: %y",
						shifts: {
							x: -60,
							y: 25
						},
						defaultTheme: false
					},

					legend: {
						labelBoxBorderColor: "#ccc",
						show: false,
						noColumns: 0
					},
					series: {
						stack: true,
						shadowSize: 0,
						highlightColor: 'rgba(30,120,120,.5)'

					},
					xaxis: {
						tickLength: 0,
						tickDecimals: 0,
						show: true,
						min: 1,

						font: {

							style: "normal",


							color: "#666666"
						}
					},
					yaxis: {
						ticks: 3,
						tickDecimals: 0,
						show: true,
						tickColor: "#f0f0f0",
						font: {

							style: "normal",


							color: "#666666"
						}
					},
					points: {
						show: true,
						radius: 2,
						symbol: "circle"
					},
					colors: ["#87cfcb", "#48a9a7"]
				};
				var plot = $.plot($("#daily-visit-chart"), data, options);
				$('.visit-chart-value').html(JSON.parse(result).aggregate.toFixed(2));
				var arrow = JSON.parse(result).change >= 0 ? '<i class="fa fa-arrow-up"></i>' : '<i class="fa fa-arrow-down"></i>';
				$('.visit-chart-title').html(arrow + Math.abs(JSON.parse(result).change.toFixed(2)) + '%');
			});

			// start loader
			document.dispatchEvent(new CustomEvent('loadingStart'));
			// Branch Topper
			$.get(base_url + 'home/branchToppers', function (result) {
				// stop loader
				document.dispatchEvent(new CustomEvent('loadingComplete'));
				result = JSON.parse(result);
				// bar's value
				$('.branch-toppers .progress-stat-bar li').eq(0).attr('data-percent', result[0].percentage);
				$('.branch-toppers .progress-stat-bar li').eq(1).attr('data-percent', result[1].percentage);
				$('.branch-toppers .progress-stat-bar li').eq(2).attr('data-percent', result[2].percentage);

				// topper's name (chart-legends)
				$('.branch-toppers .bar-legend li').eq(0).html('<span class="bar-legend-pointer pink"></span>' + result[0].name);
				$('.branch-toppers .bar-legend li').eq(1).html('<span class="bar-legend-pointer green"></span>' + result[1].name);
				$('.branch-toppers .bar-legend li').eq(2).html('<span class="bar-legend-pointer yellow-b"></span>' + result[2].name);

				// highest percentage
				$('.sales-count').html(parseFloat(result[0].percentage).toFixed(2) + '%');

				$('.progress-stat-bar li').each(function () {
		            $(this).find('.progress-stat-percent').animate({
		                height: $(this).attr('data-percent')
		            }, 1000);
		        });
			});
        }

		// start loader
		// document.dispatchEvent(new CustomEvent('loadingStart'));
		// Your rank
		$.get(base_url + '/home/yourRank', function (result) {
			// stop loader
			document.dispatchEvent(new CustomEvent('loadingComplete'));
			result = JSON.parse(result);
			var rank = result.rank;
			switch (rank % 10) {
				case 0: rank = "N/A"; break;
				case 1: rank += '<sup>st</sup>'; break;
				case 2: rank += '<sup>nd</sup>'; break;
				case 3: rank += '<sup>rd</sup>'; break;
				default:rank += '<sup>th</sup>';
			}
			$('.rank-value').html(rank);
		});

        /*==Slim Scroll ==*/
        if ($.fn.slimScroll) {
            $('.event-list').slimscroll({
                height: '305px',
                wheelStep: 20
            });
            $('.conversation-list').slimscroll({
                height: '360px',
                wheelStep: 35
            });
            $('.to-do-list').slimscroll({
                height: '300px',
                wheelStep: 35
            });
        }

		// student attandance chart for analysis (in percentage)
        if (Morris.EventEmitter) {
			// start loader
			document.dispatchEvent(new CustomEvent('loadingStart'));
            // Use Morris.Area instead of Morris.Line
            $.get(base_url + '/home/attendance', function (result) {
				// stop loader
				document.dispatchEvent(new CustomEvent('loadingComplete'));
            	result = JSON.parse(result);
				var keys = Object.keys(result[0]);
				var ykeys = keys.splice(keys.indexOf('date'), 1);
				Morris.Area({
					element: 'graph-area',
					padding: 10,
					behaveLikeLine: true,
					gridEnabled: true,
					gridLineColor: '#aaa',
					axes: true,
					fillOpacity: .1,
					data: result,
					lineColors: ['#AFAFA4', '#D6D23A', '#B19CD9','#FFB347', '#32D2C9', '#ED5D5D'],
					xkey: 'date',
					ykeys: keys,
					labels: keys,
					pointSize: 2,
					lineWidth: 2,
					hideHover: 'auto'
				});
            });
        }

        $(document).on('click', '.event-close', function () {
            $(this).closest("li").remove();
            return false;
        });

        /*Calendar*/
        $(function () {
            $('.evnt-input').keypress(function (e) {
                var p = e.which;
                var inText = $('.evnt-input').val();
                if (p == 13) {
                    if (inText == "") {
                        alert('Empty Field');
                    } else {
                        $('<li>' + inText + '<a href="#" class="event-close"> <i class="ico-close2"></i> </a> </li>').appendTo('.event-list');
                    }
                    $(this).val('');
                    $('.event-list').scrollTo('100%', '100%', {
                        easing: 'swing'
                    });
                    return false;
                    e.epreventDefault();
                    e.stopPropagation();
                }
            });
        });

        /*Chat*/
        $(function () {
            $('.chat-input').keypress(function (ev) {
                var p = ev.which;
                var chatTime = moment().format("h:mm");
                var chatText = $('.chat-input').val();
                if (p == 13) {
                    if (chatText == "") {
                        alert('Empty Field');
                    } else {
                        $('<li class="clearfix"><div class="chat-avatar"><img src="images/chat-user-thumb.png" alt="male"><i>' + chatTime + '</i></div><div class="conversation-text"><div class="ctext-wrap"><i>John Carry</i><p>' + chatText + '</p></div></div></li>').appendTo('.conversation-list');
                    }
                    $(this).val('');
                    $('.conversation-list').scrollTo('100%', '100%', {
                        easing: 'swing'
                    });
                    return false;
                    ev.epreventDefault();
                    ev.stopPropagation();
                }
            });


            $('.chat-send .btn').click(function () {
                var chatTime = moment().format("h:mm");
                var chatText = $('.chat-input').val();
                if (chatText == "") {
                    alert('Empty Field');
                    $(".chat-input").focus();
                } else {
                    $('<li class="clearfix"><div class="chat-avatar"><img src="images/chat-user-thumb.png" alt="male"><i>' + chatTime + '</i></div><div class="conversation-text"><div class="ctext-wrap"><i>John Carry</i><p>' + chatText + '</p></div></div></li>').appendTo('.conversation-list');
                    $('.chat-input').val('');
                    $(".chat-input").focus();
                    $('.conversation-list').scrollTo('100%', '100%', {
                        easing: 'swing'
                    });
                }
            });
        });
    });
	// start loader
	document.dispatchEvent(new CustomEvent('loadingStart'));
	$.get(base_url + 'home/btechPercent', function (data) {
		// stop loader
		document.dispatchEvent(new CustomEvent('loadingComplete'));
		if (Gauge) {
			/*Knob*/
			var opts = {
				lines: 12, // The number of lines to draw
				angle: 0, // The length of each line
				lineWidth: 0.48, // The line thickness
				pointer: {
					length: 0.6, // The radius of the inner circle
					strokeWidth: 0.03, // The rotation offset
					color: '#464646' // Fill color
				},
				limitMax: 'true', // If true, the pointer will not go past the end of the gauge
				colorStart: '#fa8564', // Colors
				colorStop: '#fa8564', // just experiment with them
				strokeColor: '#F1F1F1', // to see which ones work best for you
				generateGradient: true,
				percentColors: [[0.0, "#ff0000" ], [0.50, "#f9c802"], [1.0, "#a9d70b"]]
			};


			var target = document.getElementById('gauge'); // your canvas element
			var gauge = new Gauge(target).setOptions(opts); // create sexy gauge!
			gauge.maxValue = 100; // set max gauge value
			gauge.animationSpeed = 32; // set animation speed (32 is default value)
			gauge.set(parseFloat(data)); // set actual value
			gauge.setTextField(document.getElementById("gauge-textfield"));
			if(data <= 65) {
				$('.gauge-title').html('Danger');
			} else {
				$('.gauge-title').html('Safe');
			}
		}
	});

})(jQuery);
