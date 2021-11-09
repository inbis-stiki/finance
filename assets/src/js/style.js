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