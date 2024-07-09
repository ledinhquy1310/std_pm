$(document).ready(function () {
    $('#lop').on('change', function () {
        var lop_id = $(this).val();
        if (lop_id) {
            $.ajax({
                url: 'View/ajax-url/get_sinhvien.php',
                method: 'GET',
                dataType: "json",
                data: {
                    lop_id: lop_id
                },
                success: function (data) {
                    $('#sinhvien').empty();
                    $.each(data, function (i, sinhvien) {
                        $('#sinhvien').append($('<option>', {
                            value: sinhvien.id,
                            text: sinhvien.name
                        }));
                    });
                    console.log(data);
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.log('Error: ' + errorThrown);
                }
            });
        } else {
            $('#sinhvien').empty();
        }
    });
});
