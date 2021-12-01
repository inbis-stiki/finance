$(document).ready(function () {
    $("input").click(function () {
        if ($('#km').is(':checked')) {
            $("#bulan-txt").prop('disabled', true);
            $("#km-txt").prop('disabled', false);
        }
        if ($('#bulan').is(':checked')) {
            $("#km-txt").prop('disabled', true);
            $("#bulan-txt").prop('disabled', false);
        }
    });
});

$(document).ready(function () {
    $("input").click(function () {
        if ($('#km2').is(':checked')) {
            $("#bulan-txt2").prop('disabled', true);
            $("#km-txt2").prop('disabled', false);
        }
        if ($('#bulan2').is(':checked')) {
            $("#km-txt2").prop('disabled', true);
            $("#bulan-txt2").prop('disabled', false);
        }
    });
});

$(document).ready(function () {
    $("#input-administrasi").click(function () {
        $(".administrasi-extend").addClass('active');
        $(".submit-administrasi").prop('disabled', false);
        $(".input-administrasi").hide();
        $(".input-administrasi-input").prop('disabled', true);
    });
    $("#input-maintenance").click(function () {
        $(".maintenance-extend").addClass('active');
        $(".submit-maintenance").prop('disabled', false);
        $(".input-maintenance").hide();
        $(".input-maintenance-input").prop('disabled', true);
    });
    $("#input-expense").click(function () {
        $(".expense-extend").addClass('active');
        $(".submit-expense").prop('disabled', false);
        $(".input-expense").hide();
        $(".input-expense-input").prop('disabled', true);
    });
});

// Image Input
$('#imageInput').on('change', function() {
	$input = $(this);
	if($input.val().length > 0) {
		fileReader = new FileReader();
		fileReader.onload = function (data) {
		$('.image-preview').attr('src', data.target.result);
		}
		fileReader.readAsDataURL($input.prop('files')[0]);
		$('.image-button').css('display', 'none');
		$('.image-preview').css('display', 'block');
		$('.change-image').css('display', 'block');
	}
});
						
$('.change-image').on('click', function() {
	$control = $(this);			
	$('#imageInput').val('');	
	$preview = $('.image-preview');
	$preview.attr('src', '');
	$preview.css('display', 'none');
	$control.css('display', 'none');
	$('.image-button').css('display', 'block');
});

$('.accordion-nav').on('click', function() {
    $('.accordion-nav').not(this).removeClass('active');
    $(this).toggleClass('active');
});

$('#toggleSideNav').on('click', function() {
    $('.general-padding').toggleClass('no-sidenav');
    $('.top-nav').toggleClass('no-sidenav');
    $('.side-nav').toggleClass('no-sidenav');
});