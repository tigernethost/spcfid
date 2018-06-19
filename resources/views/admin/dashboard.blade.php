@extends('backpack::layout')

@section('header')
    {{-- <section class="content-header">
      <h1>
        {{ trans('backpack::base.dashboard') }}<small>{{ trans('backpack::base.first_page_you_see') }}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ backpack_url() }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">{{ trans('backpack::base.dashboard') }}</li>
      </ol>
    </section> --}}
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
              <div class="col-md-6">
                <div class="card" style="background-color: #FFF; padding: 10px; box-shadow: 1px 1px 1px 1px #ccc;">
                    <svg src="{{ asset('images/turnstiles.svg') }}" alt="" style="height: 300px; display: block"></svg>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card" style="background-color: #FFF; padding: 10px; box-shadow: 1px 1px 1px 1px #ccc;">
                    <svg src="{{ asset('images/turnstiles.svg') }}" alt="" style="height: 300px; display: block; ">
                </div>
              </div>
            </div>
        </div>
    </div>
@endsection