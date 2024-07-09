$(document).ready(function () {
    $('#khoa').on('change', function () {
        var khoa_id = $(this).val();
        if (khoa_id) {
            $.ajax({
                url: 'View/ajax-url/get_nganh.php',
                method: 'GET',
                dataType: "json",
                data: {
                    khoa_id: khoa_id
                },
                success: function (data) {
                    $('#nganh').empty();
                    $.each(data, function (i, nganh) {
                        $('#nganh').append($('<option>', {
                            value: nganh.id,
                            text: nganh.name
                        }));
                    });
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.log('Error: ' + errorThrown);
                }
            });
        } else {
            $('#nganh').empty();
        }
    });
});
