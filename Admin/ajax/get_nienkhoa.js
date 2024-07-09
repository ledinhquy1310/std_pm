$(document).ready(function () {
    $('#hdt').on('change', function () {
        var hdt_id = $(this).val();
        if (hdt_id) {
            $.ajax({
                url: 'View/ajax-url/get_nienkhoa.php',
                method: 'GET',
                dataType: "json",
                data: {
                    hdt_id: hdt_id,

                },
                success: function (data) {
                    $('#nienkhoa').empty();
                    $.each(data, function (i, nienkhoa) {
                        $('#nienkhoa').append($('<option>', {
                            value: nienkhoa.id,
                            text: nienkhoa.name
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
