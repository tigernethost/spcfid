@extends('backpack::layout')

@section('after_styles')
  {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izimodal/1.5.1/css/iziModal.min.css"> --}}
  <style>
    .content-wrapper {
/*        background: rgb(105,155,200);
        background: -moz-radial-gradient(top left, ellipse cover, rgba(105,155,200,1) 0%, rgba(181,197,216,1) 57%);
        background: -webkit-gradient(radial, top left, 0px, top left, 100%, color-stop(0%,rgba(105,155,200,1)), color-stop(57%,rgba(181,197,216,1)));
        background: -webkit-radial-gradient(top left, ellipse cover, rgba(105,155,200,1) 0%,rgba(181,197,216,1) 57%);
        background: -o-radial-gradient(top left, ellipse cover, rgba(105,155,200,1) 0%,rgba(181,197,216,1) 57%);
        background: -ms-radial-gradient(top left, ellipse cover, rgba(105,155,200,1) 0%,rgba(181,197,216,1) 57%);
        background: radial-gradient(ellipse at top left, rgba(105,155,200,1) 0%,rgba(181,197,216,1) 57%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#699bc8', endColorstr='#b5c5d8',GradientType=1 );*/
    }
  </style>
@endsection

@section('header')
    <section class="content-header">
      {{-- <h1>
        {{ trans('backpack::base.dashboard') }}<small>{{ trans('backpack::base.first_page_you_see') }}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ backpack_url() }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">{{ trans('backpack::base.dashboard') }}</li>
      </ol> --}}
    </section>
@endsection


@section('content')

    <div class="row">
        <div class="col-md-12" style="padding: 40px;">
        {{--     <div class="box box-default">
                <div class="box-header with-border">
                    <div class="box-title">{{ trans('backpack::base.login_status') }}</div>
                </div>

                <div class="box-body">{{ trans('backpack::base.logged_in') }}</div>

                
            </div> --}}

            <div class="box-default row">
              
              @foreach($turnstiles as $turnstile)
                  <div class="col-md-4" id="{{ str_slug($turnstile->name) }}">
                    <div class="card" style="background-color: #FFF; box-shadow: 1px 1px 1px 1px #ccc;">
                        {{-- <svg src="{{ asset('images/turnstiles.svg') }}" alt="" style="height: 300px; display: block"></svg> --}}
                        <h4 style=" padding: 10px;
                                    text-align: center;
                                    background-color: #13608B;
                                    display: block;
                                    color: #FFF;">
                                  {{ $turnstile->name }}
                        </h4>
                        <div style="padding: 20px; width: fit-content; margin: auto;">
                            <p><strong>IP ADDRESS </strong>: <small>{{ $turnstile->ipaddress }}</small></p>
                            <p><strong>STATUS </strong>: <small id="turnstile_status" class="label label-success">connecting...</small></p>
                            
                            <div class="btn-action" style="margin-top: 30px;">
                              <button class="btn btn-default btn-sm">View Logs</button>
                              <button class="btn btn-danger btn-sm" onclick="reboot('{{ str_slug($turnstile->name) }}')">Reboot</button>
                              {{-- <button class="btn btn-primary btn-sm">Tunnel</button> --}}
                            </div>
                        </div>
                    </div>
                  </div>
              @endforeach

            </div> <!-- END OF BOX-DEFAULT -->
        </div>
    </div>
@endsection

@section('after_scripts')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/izimodal/1.5.1/js/iziModal.min.js"></script> --}}
<script>
    
  function ping( name, ipaddress ) {
      this.name = name;
      this.ipaddress = ipaddress;
      $.ajax({
          type: 'GET',
          url: window.location.protocol + '//' + window.location.host + '/admin/turnstile/ping',
          data: { ip_address: this.ipaddress , name: this.name },
          success: function (res) {
            console.log(res);
              $('#' + res.TURNSTILE_NAME + ' #turnstile_status').text(res.TURNSTILE_MESSAGE);
          },
          error: function(data) {
            $('#' + name.toLowerCase() + ' #turnstile_status').text('Not Connected');
          }
      });
  }

  function reboot(name) {
    console.log(name);
    $.ajax({
      type: 'GET',
      url: window.location.protocol + '//' + window.location.host + '/admin/turnstile/reboot',
      data: { name: name },
      success: function (res) {
        console.log('success: ',res);
      },
      error: function (res) {
        console.log('error: ' , res);
      }
    });
  }

  @foreach($turnstiles as $turnstile)
    new ping( '{!! strtolower($turnstile->name) !!}', '{!! $turnstile->ipaddress !!}' );
  @endforeach
</script>
@endsection