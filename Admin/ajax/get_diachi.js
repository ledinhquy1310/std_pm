$(document).ready(function () {
  $('#province').on('change', function () {
    var province_id = $(this).val();
    if (province_id) {
      $.ajax({
        url: 'View/ajax-url/get_quan.php',
        method: 'GET',
        dataType: "json",
        data: {
          province_id: province_id
        },
        success: function (data) {
          $('#district').empty();

          $.each(data, function (i, district) {
            $('#district').append($('<option>', {
              value: district.id,
              text: district.name
            }));
          });
          $('#wards').empty();
        },
        error: function (xhr, textStatus, errorThrown) {
          console.log('Error: ' + errorThrown);
        }
      });
      $('#wards').empty();
    } else {
      $('#district').empty();
    }
  });

  $('#district').on('click', function () {
    var district_id = $(this).val();
    if (district_id) {
      $.ajax({
        url: 'View/ajax-url/get_xa.php',
        method: 'GET',
        dataType: "json",
        data: {
          district_id: district_id
        },
        success: function (data) {
          $('#wards').empty();
          $.each(data, function (i, wards) {
            $('#wards').append($('<option>', {
              value: wards.id,
              text: wards.name
            }));
          });
        },
        error: function (xhr, textStatus, errorThrown) {
          console.log('Error: ' + errorThrown);
        }
      });
    } else {
      $('#wards').empty();
    }
  });
});
