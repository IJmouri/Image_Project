<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- bootstrap css -->
  <link rel="stylesheet" href="{{asset('/')}}front_end/css/bootstrap.min.css">
  <!-- main css -->
  <link rel="stylesheet" href="{{asset('/')}}front_end/css/style.css">
  <link rel="stylesheet" href="{{asset('/')}}front_end/style.css">

  <!-- font awesome -->
  <link rel="stylesheet" href="{{asset('/')}}front_end/css/all.css">
  <title>Image Upload</title>

</head>

<body>
  </br>
  <div class="container">
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">
      Upload
    </button>
    <form>
      </br>
      <input type="text" class="form-control" placeholder='Search....' id="search-item">
    </form>
  </div>
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Upload Image</h5>
        </div>

        <div class="modal-body">
          <form method="POST" id="upload_form" enctype="multipart/form-data" class="modal-content animate">
            {{csrf_field()}}
            <div class="container">
              <div class="alert" id="message" style="display: none"></div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label">Upload File</label>
                    <button type="button" onclick="Javascript:window.location.reload()" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="dropzone-wrapper" id="drop-zone">
                      <div class="dropzone-desc">
                        <i class="glyphicon glyphicon-download-alt"></i>
                        <p>Choose an image file or drag it here.</p>
                      </div>
                      <input type="file" name="select_file" id="select_file" class="dropzone">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="control-label col-md-3">Image Title</label>
                <div class="col-md-9">
                  <input type="text" name="image_name" class="form-control" required />
                </div>
              </div>
              </br>
              <div class="row">
                <div class="col-md-12">
                  <button type="submit" id="upload" name="upload" class="btn btn-success pull-right remove-preview">Upload</button>
                </div>
              </div>
              </br>
              <div class="row">
                <div class="progress">
                  <div class="progress-bar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 0%;background-color:green">
                    <div class="percent">
                      0%
                    </div>
                  </div>
                </div>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  </div>


  <div class="container">
    {{Session:: get('message')}}
    <div id="mydiv">
      @foreach(array_reverse($images) as $image)
      <div class="store-items" id="store-items">
        <div class=" store-item {{$image->image_name}}" data-item="{{ $image->image_name }}">
          <div class="gallery">
            <div class="card ">
              <div class="img-container">
                <img src="{{asset('/')}}images/{{$image -> image_name}}.png" class="card-img-top store-img">
              </div>
              <div class="desc">
                @if(strlen( $image->image_name ) > 18)
                <marquee behavior="alternate" style="height:18px;" direction="left">{{ $image->image_name }}</marquee>
                @else
                {{ $image->image_name }}
                @endif
              </div>
              <div class="desc">
                <a data-toggle="modal" data-target="#exampleModal{{ $image->image_name }}">
                  <span class="fas fa-trash"> </span>
                </a>
                Remove
                <div class="modal fade" id="exampleModal{{ $image->image_name }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirm </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        Are you sure you want to delete {{ $image->image_name}}.png?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <a href="{{route('delete-image',['name'=>$image->image_name])}}" class="btn btn-primary">
                          Yes
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>

      <!--end of store items -->

    </div>
    <div class="container">
      <!-- modal-container -->
      <div class="container-fluid ">
        <div class="row lightbox-container align-items-center">
          <div class="col-10 col-md-10 mx-auto text-right lightbox-holder">
            <span class="lightbox-close"><i class="fas fa-window-close"></i></span>
            <div class="lightbox-item"></div>
            <span class="lightbox-control btnLeft"><i class="fas fa-caret-left"></i></span>
            <span class="lightbox-control btnRight"><i class="fas fa-caret-right"></i></span>
          </div>

        </div>
      </div>
    </div>
  

    <script src="{{asset('/')}}front_end/function.js"></script>
    <script src="{{asset('/')}}front_end/search.js"></script>
    <!-- jquery -->
    <script src="{{asset('/')}}front_end/js/jquery-3.3.1.min.js"></script>
    <!-- bootstrap js -->
    <script src="{{asset('/')}}front_end/js/bootstrap.bundle.min.js"></script>
    <!-- script js -->
    <script src="{{asset('/')}}front_end/js/app.js"></script>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
    <script>
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
              duration: 3000
            });
          },
          success: function(data) {
            if (data.success) {
              $('#success').html('<div class="text-success text-center"><b>' + data.success + '</b></div><br /><br />');
              $('#success').append(data.image);
              $('.progress-bar').text('Uploaded');
              $('.progress-bar').css('width', '100%');

            } else {
              document.write("Failed");
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
              $('#success').empty();
              $('.progress-bar').text('0%');
              $('.progress-bar').css('width', '0%');
              //            window.location.reload();
              $("#mydiv").load(location.href + " #mydiv");
            }

          });

          document.getElementById("upload_form").reset();
        });

      });
    </script>

</body>

</html>