@extends('dashboard.layouts.master')
@section('styles')
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/iCheck/all.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/select2/select2.min.css') }}">
@endsection
@section('content')
    {{--Content Wrapper. Contains page content--}}
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Pages <a href="{{ URL::to('/dashboard/pages') }}" class="btn btn-primary btn-sm">View All</a></h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active"><a href="#">Page</a></li>
                <li>{{ $title }}</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                {!! Form::model($page, ['method' => 'PATCH', 'action' => ['Dashboard\PageController@update', $page->id]]) !!}
                @include('dashboard.pages.form', ['submitButtonText' => 'Update Page'])
                {!! Form::close() !!}
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@stop
@section('scripts')
    <!-- CK Editor -->
    <script src="{{ URL::asset('assets/plugins/iCheck/icheck.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ URL::asset('assets/plugins/select2/select2.full.min.js') }}"></script>
    <!-- CK-Editor -->
    <script src="{{ URL::asset('assets/plugins/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('editor1');
        //iCheck for checkbox
        $('input[type="checkbox"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue'
        });
        $('.select2').select2({
            placeholder: "Select Parent Page"
        });
    </script>

    {{--@include('dashboard.partials.message-success')--}}
    {{--@include('dashboard.partials.message-error')--}}
    {{--@include('dashboard.partials.error-popup')--}}

@stop