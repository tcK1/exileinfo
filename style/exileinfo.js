// Change div content based on select
$(document).on('change', '.div-toggle', function() {
    var target = $(this).data('target');
    var show = $("option:selected", this).data('show');
    $(target).children().addClass('hide');
    $(show).removeClass('hide');
});

// Change iframe src
function src(loc) {
    document.getElementById('graph').src = loc;
}