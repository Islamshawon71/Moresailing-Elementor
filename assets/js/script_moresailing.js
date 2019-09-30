(function($) {
	/**
 	 * @param $scope The Widget wrapper element as a jQuery element
	 * @param $ The jQuery alias
	 */

	var testimonial = function($scope, $) {
		var data = $('.elementor-widget-moresailing-testimonial').attr('data-settings');
		var settings = $.parseJSON(data);

		var swiper = new Swiper('.moresailing-testimonial', {
			loop: 0,
			slidesPerView: 4,
			slidesPerGroup: 1,
			navigation: {
				nextEl: '.elementor-swiper-button-next',
				prevEl: '.elementor-swiper-button-prev'
			},
			breakpoints: {
				// when window width is >= 320px
				320: {
					slidesPerView: 1
				},
				// when window width is >= 480px
				480: {
					slidesPerView: 1
				},
				// when window width is >= 640px
				640: {
					slidesPerView: 2,
					spaceBetween: 40
				}
			}
		});
	};
	var bookingTable = function($scope, $) {
		//  Add Counter
		$(document).ready(function() {
			CallAzax();
			$('div#increase').click(function() {
				var person = $('#passengersCount').val();
				person = isNaN(person) ? 1 : person;
				person++;
				$('#passengersCount').val(person);
			});
			$('div#decrease').click(function() {
				var person = $('#passengersCount').val();
				// var value = parseInt(person, 10);
				if (person > 1) {
					person = isNaN(person) ? 1 : person;
					person < 1 ? (person = 1) : '';
					person--;
				}
				$('#passengersCount').val(person);
			});
			$('#newPersonUpdate').click(function() {
				$('.quantity.buttons_added').toggle();
			});
			$('.add_quantity').click(function() {
				var person = $('#passengersCount').val();
				var total = person + ' st';
				$('#passengersCount').val(person);
				$('#newPersonUpdate').val(total);
				$('.quantity.buttons_added').toggle();
				CallAzax();
			});
			$('#destination').change(function() {
				CallAzax();
			});
			$('#tourDate').change(function() {
				CallAzax();
			});
		});
		$(document).on('click', '.remove_passenger', function() {
			$(this).closest('.other-passenger').remove();
			numberOfPassengers = numberOfPassengers - 1;
			$('#passengers').val(numberOfPassengers);
			updateDetails();
			finalPriceUpdate();
			if (numberOfPassengers < freeSpace) {
				$('#add_passenger').show();
			}
		});

		$('#add_passenger').click(function() {
			numberOfPassengers = numberOfPassengers + 1;
			$('#passengers').val(numberOfPassengers);
			updateDetails();
			finalPriceUpdate();

			let html =
				'<div class="booking-form other-passenger"><div class="booking-form-header"><h3 class="header">Resenär ' +
				numberOfPassengers +
				'</h3> <button class="btn remove_passenger" type=""><i class="fa fa-times" aria-hidden="true"></i> Ta bort resenär <span class="badge badge-primary"></span> </button></div><div class="form-group"><label for="">Förnamn</label><input type="text" class="form-control other_passenger_firstname" value=""></div> <div class="form-group">  <label for="">Efternamn</label>  <input type="text" class="form-control other_passenger_lastname" value="">   </div>  <div class="form-group"> <label for="">Personnummer (ÅÅÅÅMMDD)</label> <input type="text" class="form-control birth_datepicker other_passenger_day" value=""  > </div> </div>';
			$('#other_passengers').append(html);
			if (numberOfPassengers == freeSpace) {
				$(this).hide();
			}
		});

		function updateDetails() {
			$('p.passengers').text(numberOfPassengers);
		}
		function CallAzax() {
			var month = $('#tourDate').val();
			var person = $('#passengersCount').val();
			var destination = $('#destination option:selected').val();
			if (destination == 'Alla-destinationer') {
				destination = 'all';
			}
			$('#tour-table tbody').html(
				'<tr> <td colspan="6" style="padding:30px"> <div> <div class="loader"></div> <p>Loading...</p> </div> </td> </tr>'
			);

			$.ajax({
				url: 'http://localhost/Moresailing_se/wp-admin/admin-ajax.php',
				type: 'get',
				data: {
					action: 'bookresa_request',
					passengers: person,
					month: month,
					destination: destination
				},
				success: function(response) {
					if (response.status == 'success') {
						$('#tour-table tbody').html(response.content);
					} else {
						$('#tour-table tbody').html(response.content);
					}
				}
			});
		}

		function enableAllTheseDays(date) {
			var sdate = $.datepicker.formatDate('d-m-yy', date);
			console.log(sdate);
			if ($.inArray(sdate, AllDates) != -1) {
				return [ true, 'ui-state-enable', sdate ];
			}
			return [ false ];
		}

		$('.datrepicker').datepicker({ dateFormat: 'dd-mm-yy', beforeShowDay: enableAllTheseDays });
		// $('.datrepicker').datepicker({ dateFormat: 'dd-mm-yy' });
	};

	var bookingForm = function($scope, $) {
		var cart = [];
		var totalPrice = 0;
		var numberOfPassengers = +$('#TotalPassengers').val();
		var localPrice = +$('#TourPrice').val();
		var totalWithSupliment = 0;
		var totalWithOutSupliment = 0;
		var bookingPrice = +$('#TourPrice').val();
		var coupon_value = 0;
		var coupon_id = 0;
		var no_transfer = 0;
		var no_transfer_value = $('#no_transfer_value').val();
		var freeSpace = $('#freeSpace').val();
		totalPrice += numberOfPassengers * localPrice;

		// Promo Box Hide Show
		$('.promoLabel').click(function() {
			$('#promoInput').toggle();
		});

		// Mobile Cart Hide Show
		$('.mobile-cart').click(function() {
			if ($('.to_move_content').hasClass('open')) {
				$('.to_move_content').removeClass('open');
			} else {
				$('.to_move_content').addClass('open');
			}
		});
		// Left Sidebar Scroll Effect
		if ($('.to_move_content').length) {
			$('.to_move_content').css({ top: '74px' });
			if ($(window).width() >= 1200) {
				var element = $('.to_move_content'),
					originalY = element.offset().top;
				var footer = $('.elementor-location-footer').offset().top;
				var topMargin = 74;
				element.css({ position: 'relative' });

				$(window).on('scroll', function(event) {
					var scrollTop = $(window).scrollTop();
					element.stop(false, false).animate(
						{
							top: scrollTop < originalY ? 70 : scrollTop - originalY + topMargin
						},
						0
					);
				});
			}
		}
		$('.privacy_check').click(function() {
			if ($('.privacy_check').is(':checked')) {
				$('#SendData').prop('disabled', false);
			} else {
				$('#SendData').prop('disabled', true);
			}
		});
		$(document).on('change', '#customer_airport', function() {
			// alert('The text has been changed.');
			var no_transfer_value = $('#no_transfer_value').val();
			// alert(no_transfer_value);
			if ($(this).val() == 'no_transfer') {
				$('.tillvalAdd #data' + no_transfer_value).remove();

				var html = '<div id="data';
				html = html + no_transfer_value;
				html = html + '" data-no_transfer= ';
				html = html + numberOfPassengers * no_transfer_value;
				html =
					html +
					' class="AddedSupplements" ><label>Utan flyg och transfer</label> <p class = "transfer" >  -  ';
				html = html + numberOfPassengers * no_transfer_value;
				html = html + ' SEK </p></div>';
				$('.tillvalAdd').append(html);
				no_transfer = numberOfPassengers * no_transfer_value;
			} else {
				$('.tillvalAdd #data' + no_transfer_value).remove();
				no_transfer = 0;
			}
			finalPriceUpdate();
		});
		function finalPriceUpdate() {
			supplements = 0;
			insurance = 0;
			$(".single-tilval.supplements input[type='checkbox']").each(function() {
				supplement_id = $(this).closest('.single-tilval').attr('data-supplement_id');
				value = $(this).closest('.single-tilval').attr('data-value');
				title = $(this).closest('.single-tilval').attr('data-title');
				id = $(this).closest('.single-tilval').attr('data-id');
				//console.log(supplement_id, title, id);
				if ($(this).is(':checked')) {
					supplements += numberOfPassengers * value;
					$('.tillvalAdd #data' + id).remove();
					var html =
						'<div id="data' +
						id +
						'" data-supplement_id=' +
						supplement_id +
						' class="AddedSupplements" ><label>' +
						title +
						'</label> <p class = "passengers" >' +
						value * numberOfPassengers +
						' SEK</p></div>';
					$('.tillvalAdd').append(html);
				} else {
					$('.tillvalAdd #data' + id).remove();
				}
			});
			$(".single-tilval.insurance input[type='checkbox']").each(function() {
				value = $(this).closest('.single-tilval').attr('data-value');
				title = $(this).closest('.single-tilval').attr('data-title');
				id = $(this).closest('.single-tilval').attr('data-id');
				//console.log(value, title, id);
				if ($(this).is(':checked')) {
					insurance += numberOfPassengers * value;
					$('.tillvalAdd #data' + id).remove();
					var html =
						'<div id="data' +
						id +
						'" ><label>' +
						title +
						'</label> <p class = "passengers" >' +
						value * numberOfPassengers +
						' SEK</p></div>';
					$('.tillvalAdd').append(html);
				} else {
					$('.tillvalAdd #data' + id).remove();
				}
			});
			totalPrice =
				supplements +
				insurance +
				bookingPrice * numberOfPassengers -
				coupon_value -
				no_transfer * numberOfPassengers;

			// console.log(supplements);
			// console.log(insurance);
			// console.log(totalPrice);
			// console.log(coupon_value);
			// console.log(no_transfer);
			// console.log(numberOfPassengers);

			setSupplementsData();
			updatePrice();
		}
		$(".single-tilval input[type='checkbox']").change(function() {
			finalPriceUpdate();
		});
		// Booking Data send
		function getSupplementsData() {
			var selected_supplements = [];

			$(".single-tilval.supplements input[type='checkbox']").each(function() {
				supplement_id = $(this).closest('.single-tilval').attr('data-supplement_id');
				if ($(this).is(':checked')) {
					selected_supplements.push(supplement_id);
				}
			});

			//console.log(supplement_id);

			return selected_supplements;
		}
		$('#promoInput').on('input', function() {
			var code = $(this).val();
			if (codes.hasOwnProperty(code)) {
				coupon_value = parseFloat(codes[code].value) * numberOfPassengers;
				coupon_id = codes[code].id;
				$('.static-value').show();
				var html =
					'<div id="promo"><label>Rabatt</label> <p class = "passengers promo" > - ' +
					coupon_value +
					' SEK</p></div>';
				$('.PromoAdd').append(html);
			} else {
				coupon_value = 0;
				coupon_id = 0;
				$('.static-value').hide();
				$('#promo').remove();
			}
			finalPriceUpdate();
			setSupplementsData();
		});
		function setSupplementsData() {
			cancellation_insurance =
				(supplements + bookingPrice * numberOfPassengers - coupon_value) * 0.06 / numberOfPassengers;
			travel_insurance =
				(supplements + bookingPrice * numberOfPassengers - coupon_value) * 0.03 / numberOfPassengers;
			$('.cancellation_insurance').attr('data-value', cancellation_insurance);
			$('.cancellation_insurance span.tilval_totalprice').text(cancellation_insurance);
			$('.travel_insurance').attr('data-value', travel_insurance);
			$('.travel_insurance span.tilval_totalprice').text(travel_insurance);
		}

		function updatePrice() {
			$('.basePrice').html(totalPrice);
			$('#coupon_id').val(coupon_id);
			$('#coupon_value').val(coupon_value);
			$('p.transfer').text('-' + no_transfer_value * numberOfPassengers);
		}
		$('#customer_phone').keypress(function() {
			if ($(this).val().length >= 10) {
				$(this).val($(this).val().slice(0, 10));
				return false;
			}
		});
		$('#customer_person_number').keypress(function() {
			if ($(this).val().length >= 6) {
				$(this).val($(this).val().slice(0, 6));
				return false;
			}
		});
		function validateName(name) {
			var re = /^([^0-9]*)$/;
			var check = re.test(name);
			return check;
		}
		$(document).on('keypress', '.other_passenger_day', function() {
			//console.log(jQuery("#customer_phone").val());
			if ($(this).val().length >= 8) {
				$(this).val($(this).val().slice(0, 8));
				return false;
			}
		});
		function validatePhone(number) {
			var re = /^[\+\\\d\s]{6,}$/;
			var check = re.test(number);
			return check;
		}
		function validateEmail(email) {
			var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
			var b = re.test(email);
			return b;
		}

		$('#SendData').click(function() {
			var customer_data = [];
			customer_firstname = $('#customer_firstname');
			customer_lastname = $('#customer_lastname');
			customer_person_number = $('#customer_person_number');
			customer_phone = $('#customer_phone');
			customer_email = $('#customer_email');
			customer_airport = $('#customer_airport option:selected');
			tour_id = $('#coupon_tour_id').val();
			pax = $('#passengers').val();
			start_date = $('#start_date').val();
			promoCode = $('#coupon_id').val();
			if (promoCode == '') {
				promoCode = 0;
			}
			customer_data['passengers'] = [];

			$('.other-passenger').each(function(index) {
				customer_data['passengers'][index] = {
					firstname: $(this).find('.other_passenger_firstname').val(),
					lastname: $(this).find('.other_passenger_lastname').val(),
					person_number: $(this).find('.other_passenger_day').val()
				};
			});
			no_transfer = 0;
			if (customer_airport.val() == 'Atlanten') {
				no_transfer = 1;
			}
			customer_notes = 'test Notes';
			customer_nationality = 'test Notes';
			constantValue = 0;
			if (
				customer_firstname.val() == '' ||
				!validateName(customer_firstname.val()) ||
				customer_firstname.val().length < 2
			) {
				customer_firstname.css('border-color', 'red');
				constantValue = 1;
			} else {
				customer_firstname.css('border-color', '#6BB971');
			}
			if (
				customer_lastname.val() == '' ||
				!validateName(customer_lastname.val()) ||
				customer_lastname.val().length < 2
			) {
				customer_lastname.css('border-color', 'red');
				constantValue = 1;
			} else {
				customer_lastname.css('border-color', '#6BB971');
			}
			if (customer_person_number.val() == '') {
				customer_person_number.css('border-color', 'red');
				constantValue = 1;
			} else {
				customer_person_number.css('border-color', '#6BB971');
			}
			if (customer_phone.val() == '' || !validatePhone(customer_phone.val())) {
				customer_phone.css('border-color', 'red');
				constantValue = 1;
			} else {
				customer_phone.css('border-color', '#6BB971');
			}
			if (customer_email.val() == '' || !validateEmail(customer_email.val())) {
				customer_email.css('border-color', 'red');
				constantValue = 1;
			} else {
				customer_email.css('border-color', '#6BB971');
			}
			if (customer_airport.val() == 'no_transfer') {
				customer_airport.css('border-color', 'red');
				constantValue = 1;
			} else {
				customer_airport.css('border-color', '#6BB971');
			}

			$('.other_passenger_firstname').each(function() {
				if ($(this).val() == '') {
					$(this).css('border-color', 'red');
					constantValue = 1;
				} else {
					$(this).css('border-color', '#6BB971');
				}
			});
			$('.other_passenger_lastname').each(function() {
				if ($(this).val() == '') {
					$(this).css('border-color', 'red');
					constantValue = 1;
				} else {
					$(this).css('border-color', '#6BB971');
				}
			});
			$('.other_passenger_day').each(function() {
				if ($(this).val() == '') {
					$(this).css('border-color', 'red');
					constantValue = 1;
				} else {
					$(this).css('border-color', '#6BB971');
				}
			});

			cancellation_insurance = 0;
			if ($("input[type='checkbox'].cancellation_insurance_redio").is(':checked')) {
				cancellation_insurance = 0.06;
			}
			travel_insurance = 0;
			if ($("input[type='checkbox'].travel_insurance_redio").is(':checked')) {
				travel_insurance = 0.03;
			}
			// var data = {
			// 	test: true,
			// 	item_id: tour_id,
			// 	pax: pax,
			// 	booking_type: 'tour',
			// 	date: start_date,
			// 	step: 'save_step_1',
			// 	pax: pax,
			// 	length: '1',
			// 	currency: 'SEK',
			// 	customer_data: {
			// 		customer_firstname: customer_firstname.val(),
			// 		customer_lastname: customer_lastname.val(),
			// 		customer_person_number: customer_person_number.val(),
			// 		customer_email: customer_email.val(),
			// 		customer_phone: customer_phone.val(),
			// 		customer_notes: customer_notes,
			// 		customer_nationality: customer_nationality,
			// 		cancellation_insurance: cancellation_insurance,
			// 		travel_insurance: travel_insurance,
			// 		customer_airport: customer_airport.text(),
			// 		no_transfer: no_transfer
			// 	},
			// 	passengers_data: customer_data['passengers'],
			// 	booking_type: 'tour',
			// 	booking_price: bookingPrice,
			// 	step2: 'save_step_2',
			// 	accept_terms: 1,
			// 	step3: 'complete',
			// 	payment_type: 'klarna',
			// 	paid: 0,
			// 	supplements: getSupplementsData(),
			// 	promo_code: promoCode
			// };
			if (constantValue == 1) {
				$('html, body').animate(
					{
						scrollTop: $('.book-form-container').position().top + 400
					},
					500
				);
			} else {
				$.ajax({
					method: 'POST',
					url: 'https://tourbooker.moresailing.se/ms-admin/API/bookingAPI/startBooking',
					data: {
						test: true,
						item_id: tour_id,
						pax: pax,
						booking_type: 'tour',
						date: start_date,
						step: 'save_step_1',
						pax: pax,
						length: '1',
						currency: 'SEK',
						customer_data: {
							customer_firstname: customer_firstname.val(),
							customer_lastname: customer_lastname.val(),
							customer_person_number: customer_person_number.val(),
							customer_email: customer_email.val(),
							customer_phone: customer_phone.val(),
							customer_notes: customer_notes,
							travel_insurance: travel_insurance,
							customer_nationality: customer_nationality,
							cancellation_insurance: cancellation_insurance,
							customer_airport: customer_airport.text(),
							no_transfer: no_transfer
						},
						passengers_data: customer_data['passengers'],
						booking_type: 'tour',
						booking_price: bookingPrice,
						step2: 'save_step_2',
						accept_terms: 1,
						step3: 'complete',
						payment_type: 'klarna',
						paid: 0,
						supplements: getSupplementsData(),
						promo_code: promoCode
					},
					dataType: 'json',
					success: function(response) {
						var delay = 4000;
						if (response.status == 'ok') {
							$('.popup-content')
								.empty()
								.append(
									'Tack för din bokning, du kommer nu skickas vidare till vår kundportal. Du har fått ditt inlogg till kundportalen på din e-post'
								);
							$('.hover_bkgr_fricc').toggle();
							console.log(response);
							OrderTour(response.booking_id);
							setTimeout(function() {
								// window.location =
								// moresailing_plugin_ajax.moresailing_API_ajax + 'ms-admin/booking-portal/login';
							}, delay);
						} else {
							$('.hover_bkgr_fricc').toggle();
							$('.popup-content')
								.empty()
								.append('Något är fel, var vänlig och kontakta supporten eller prova senare');
						}
					}
				});
			}
		});

		$('.popupCloseButton').click(function() {
			$('.hover_bkgr_fricc').toggle();
		});
		$('.hover_bkgr_fricc').click(function() {
			$('.hover_bkgr_fricc').toggle();
		});
	};
	// Make sure you run this code under Elementor.
	$(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction('frontend/element_ready/moresailing-testimonial.default', testimonial);
		elementorFrontend.hooks.addAction('frontend/element_ready/booking-form.default', bookingForm);
		elementorFrontend.hooks.addAction('frontend/element_ready/booking-table.default', bookingTable);
	});
})(jQuery);
