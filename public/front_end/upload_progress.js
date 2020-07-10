
  $(document).ready(function() {
    $('form').ajaxForm({
      beforeSend: function() {
        $('#success').empty();
        $('.progress-bar').text('0%');
        $('.progress-bar').css('width', '0%');
      },
      uploadProgress: function(event, position, total, percentComplete) {
        $('.progress-bar').text(percentComplete + '0%');
        $('.progress-bar').css('width', percentComplete + '0%');
        $('.progress-bar').animate({
          width: percentageComplete + '%'
        }, {
          duration: 6000
        });
      },
      success: function(data) {
        if (data.success) {
          $('#success').html('<div class="text-success text-center"><b>' + data.success + '</b></div><br /><br />');
          $('#success').append(data.image);
          $('.progress-bar').text('Uploaded');
          $('.progress-bar').css('width', '100%');
        }
      }
    });

    $('#upload_form').on('submit', function(event) {
      event.preventDefault();
      $.ajax({
        url: "{{ route('ajaxupload.action') }}",
        method: "POST",
        data: new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: true,
        processData: false,
        success: function(data) {
          $('#message').css('display', 'block');
          $('#message').html(data.message);
          $('#message').addClass(data.class_name);
          $('#uploaded_image').html(data.uploaded_image);
        }
      })
    });

  });
