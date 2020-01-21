function show_fields(value){
    if(value == 1){
        document.getElementById("std_class").style.display = "inline";
    } else if(value == 2) {
        document.getElementById("std_class").style.display = "inline";
        document.getElementById("std_section").style.display = "inline";
    } else {
        document.getElementById("std_class").style.display = "none";
        document.getElementById("std_section").style.display = "none";
    }
}

$(document).ready(function(){

    $('#reg_no').keyup(function () {
        var val = $(this).val();
            $.ajax
            ({
                type: "GET",
                url: '/autocomplete-reg-no',
                data: {'data': val},
                contentType: "json",
                cache: false,
                success: function(data, status, xhr)
                {
                    $('#countryList').fadeIn();  
                    $('#countryList').html(data);
                }
            });
    });

    $(document).on('click', 'li', function(){  
        $('#reg_no').val($(this).text());  
        $('#countryList').fadeOut();  
    });     

});