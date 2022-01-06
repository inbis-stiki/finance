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
        const kendaraan = $('#adm_slct_kendaraan').val()
        const tglTrans = $('#adm_inpt_tglBeli').val()
        if(kendaraan && tglTrans){
            $('#adm_alert').attr('hidden', true);
            $('#adm_boxInput').html(admRenderHtml())
            $(".administrasi-extend").addClass('active');
            $(".submit-administrasi").prop('disabled', false);
            $(".input-administrasi").hide();
            $(".input-administrasi-input").prop('disabled', true);    
            $('#adm_inptKendaraan').val(kendaraan)
            $('#adm_inptTglTrans').val(tglTrans)
        }else{
            $('#adm_alert').attr('hidden', false);
        }
    });
    $("#input-maintenance").click(function () {
        const kendaraan     = $('#main_slct_kendaraan').val()
        const tglService    = $('#main_inpt_tglService').val()
        const toko          = $('#main_inpt_toko').val()
        const jarak         = $('#main_inpt_jarak').val()

        if(kendaraan && tglService && toko && jarak){
            $('#main_alert').attr('hidden', true)
            $('#main_boxInput').html(mainRenderHtml())
            $(".maintenance-extend").addClass('active');
            $(".submit-maintenance").prop('disabled', false);
            $(".input-maintenance").hide();
            $(".input-maintenance-input").prop('disabled', true);
            $('#main_inptKendaraan').val(kendaraan)
            $('#main_inptTglService').val(tglService)
            $('#main_inptToko').val(toko)
            $('#main_inptJarak').val(jarak)
        }else{
            $('#main_alert').attr('hidden', false)
        }
        
        
    });
    $("#input-expense").click(function () {
        const kendaraan = $('#exp_slct_kendaraan').val()
        const tglService = $('#exp_inpt_tglService').val()

        if(kendaraan && tglService){
            $('#exp_alert').attr('hidden', true);
            $(".expense-extend").addClass('active');
            $(".submit-expense").prop('disabled', false);
            $(".input-expense").hide();
            $(".input-expense-input").prop('disabled', true);    
            $('#exp_inptKendaraan').val(kendaraan)
            $('#exp_inptTglService').val(tglService)
        }else{
            $('#exp_alert').attr('hidden', false);
        }
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