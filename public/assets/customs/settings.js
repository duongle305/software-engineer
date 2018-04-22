let url = $('meta[name="setting"]').attr('content');
    $('.sidebar-bg-options').on('click',function(){
        let color = $(this).data('sidebar');
        $.ajax({
            url: url,
            method: 'POST',
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data:{type : 'sidebar', color: color},
    });
});
$('.tiles').on('click', function() {
    let color = $(this).data('header');
    $.ajax({
        url: url,
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {type: 'header', color: color},
    });
});