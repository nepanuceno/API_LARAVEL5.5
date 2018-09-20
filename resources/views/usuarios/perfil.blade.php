@extends('layouts.master')

@section('cssLink')
<link rel="stylesheet" href="{{ asset('./node_modules/sweetalert2/dist/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('./node_modules/cropperjs/dist/cropper.css') }}" />
<style>
    .label {
      cursor: pointer;
    }

    .progress {
      display: none;
      margin-bottom: 1rem;
    }

    .alert {
      display: none;
    }

    .img-container img {
      max-width: 100%;
    }
  </style>
@endsection


@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Perfil
        <small>Foto</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Perfil</a></li>
        <li class="active">Foto</li>
      </ol>
    </section>

    <?php
      $URI = "/storage/foto/avatar_".Auth::user()->id.".png";
    ?>
    
    <!-- Main content -->
    <div class="container">
        <section class="content">
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <!-- <img class="profile-user-img img-responsive img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture"> -->

              <label class="label" data-toggle="tooltip" title="Mudar avatar">
                  <img class="profile-user-img img-responsive img-circle" id="avatar" src="{{ asset($URI) }}" onerror="this.src='{{ asset('storage/foto/default.png') }}'" alt="avatar">
                  <input type="file" class="sr-only" id="input" name="image" accept="image/*">
              </label>

              <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

              <p class="text-muted text-center">Software Engineer</p>
<!--
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Followers</b> <a class="pull-right">1,322</a>
                </li>
                <li class="list-group-item">
                  <b>Following</b> <a class="pull-right">543</a>
                </li>
                <li class="list-group-item">
                  <b>Friends</b> <a class="pull-right">13,287</a>
                </li>
              </ul>
              <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
-->
              
            </div>

            <!-- /.box-body -->
            <div class="box-footer text-center">
              <div class="progress">
                  <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
              </div>
            </div>

          </div>
        
            <div class="alert" role="alert"></div>
              <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="modalLabel">Cortar Imagem</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                          <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="img-container">
                        <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                      <button type="button" class="btn btn-primary" id="crop">Crop</button>
                    </div>
                  </div>
                </div>
            </div>
        </section>
    </div>
    </div>
@endsection

@section('JavaScript')
    <script src="{{ asset('./node_modules/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('./node_modules/cropperjs/dist/cropper.js') }}"></script>

 @if (session('status'))
    <script>
      var msg ="{{ session('status') }}"
      swal({
        position: 'top-end',
        type: 'success',
        title: msg,
        showConfirmButton: false,
        timer: 2500
      });
    </script>
  @endif

   @if(session('error'))
    <script>
      var msg ="{{ session('status') }}"
      swal({
        position: 'top-end',
        type: 'error',
        title: msg,
        showConfirmButton: false,
        timer: 3000
      });
    </script>
  @endif

  <script>

var $funcao = document.querySelectorAll('.btn-remove');

Array.prototype.forEach.call($funcao,function(e){ 
    e.addEventListener('click',function(e){
        var strFuncao = this.getAttribute('data-name');
        var id = this.getAttribute('data-id');

        swal({
            title: 'Remover Função',
            text: "Deseja realmente remover a função "+strFuncao,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim',
        }).then((result) => {
            if (result.value) {
                window.location="/deleteRoles/"+id
            }
        })
    });
});

  
</script>

 <script>
    window.addEventListener('DOMContentLoaded', function () {
      var avatar = document.getElementById('avatar');
      var image = document.getElementById('image');
      var input = document.getElementById('input');
      var $progress = $('.progress');
      var $progressBar = $('.progress-bar');
      var $alert = $('.alert');
      var $modal = $('#modal');
      var cropper;

      $('[data-toggle="tooltip"]').tooltip();

      input.addEventListener('change', function (e) {
        var files = e.target.files;
        var done = function (url) {
          input.value = '';
          image.src = url;
          $alert.hide();
          $modal.modal('show');
        };
        var reader;
        var file;
        var url;

        if (files && files.length > 0) {
          file = files[0];

          alert(URL);

          if (URL) {
            done(URL.createObjectURL(file));
          } else if (FileReader) {
            reader = new FileReader();
            reader.onload = function (e) {
              done(reader.result);
            };
            reader.readAsDataURL(file);
          }
        }
      });

      $modal.on('shown.bs.modal', function () {
        cropper = new Cropper(image, {
          aspectRatio: 1,
          viewMode: 3,
        });
      }).on('hidden.bs.modal', function () {
        cropper.destroy();
        cropper = null;
      });

      document.getElementById('crop').addEventListener('click', function () {
        var initialAvatarURL;
        var canvas;

        $modal.modal('hide');

        if (cropper) {
          canvas = cropper.getCroppedCanvas({
            width: 160,
            height: 160,
          });
          initialAvatarURL = avatar.src;
          avatar.src = canvas.toDataURL();
          $progress.show();
          $alert.removeClass('alert-success alert-warning');
          canvas.toBlob(function (blob) {
            var formData = new FormData();

            formData.append('avatar', blob);
            
            $.ajax('/alterarFoto', {
              method: 'POST',
              data: formData,
              processData: false,
              contentType: false,
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

              xhr: function () {
                var xhr = new XMLHttpRequest();

                xhr.upload.onprogress = function (e) {
                  var percent = '0';
                  var percentage = '0%';

                  if (e.lengthComputable) {
                    percent = Math.round((e.loaded / e.total) * 100);
                    percentage = percent + '%';
                    $progressBar.width(percentage).attr('aria-valuenow', percent).text(percentage);
                  }
                };

                return xhr;
              },

              success: function () {
                $alert.show().addClass('alert-success').text('Upload success');
              },

              error: function () {
                avatar.src = initialAvatarURL;
                $alert.show().addClass('alert-warning').text('Upload error');
              },

              complete: function () {
                $progress.hide();
              },
            });
          });
        }
      });
    });
  </script>
@endsection