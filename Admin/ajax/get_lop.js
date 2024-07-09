$(document).ready(function () {
    $('#nganh').on('change', function () {
        var nganh_id = $(this).val();
        if (nganh_id) {
            $.ajax({
                url: 'View/ajax-url/get_lop.php',
                method: 'GET',
                dataType: "json",
                data: {
                    nganh_id: nganh_id
                },
                success: function (data) {
                    $('#lop').empty();
                    $.each(data, function (i, lop) {
                        $('#lop').append($('<option>', {
                            value: lop.id,
                            text: lop.name
                        }));
                    });
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.log('Error: ' + errorThrown);
                }
            });
        } else {
            $('#lop').empty();
        }
    });
});
