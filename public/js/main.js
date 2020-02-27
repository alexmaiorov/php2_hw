function showMore(btn) {
    let position = parseInt(btn.getAttribute('data-position'));
    let addCount = parseInt(btn.getAttribute('data-add'));
    btn.innerText = 'Подождите...';
    $.ajax({
        url: "../core/ajax.php",
        type: "post",
        dataType: "json",
        data: {
            "position":   position,
            "addCount": addCount,
        },
        success: function(data){
            if(data.result == "success"){
                $('.main-products').append(data.html);
                btn.innerText = 'Показать еще';
                btn.setAttribute('data-position', (position + addCount));
            }else{
                btn.innerText = 'Больше нечего показывать';
            }
        }
    });
}