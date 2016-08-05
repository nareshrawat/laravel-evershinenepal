@extends('dashboard.layouts.master')
@section('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection
@section('content')
        <!-- Content Wrapper. Contains faq content -->
<div class="content-wrapper">
    {{--Content Header (Product header)--}}
    <section class="content-header">
        <h1>
            {{ $title }}
            <a href="{{ route('dashboard.products.create') }}">
                <button class="btn btn-primary btn-sm">Add Product</button>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Products</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs subsubsub">
                                <li>
                                    <a href="{{ URL::to('/dashboard/products') }}" class="btn btn-link">All
                                        <span class="label label-primary">{{ $productsNotDeletedCount }}</span>
                                    </a>
                                </li>
                                <li class="active">
                                    <a href="{{ route('dashboard.products.trash') }}" class="btn btn-link">Trash
                                        <span class="label label-primary">{{ $productsTrashedCount }}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('dashboard.products.generatepdf') }}" class="btn btn-link"
                                       target="_blank">Export To PDF
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Categories</th>
                                <th>Author</th>
                                <th>Last Modified</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($productsTrashed as $product)
                                <tr>
                                    <td>{{ $product->title }}</td>
                                    <td>{{ $product->sale_price .' '. $product->regular_price }}</td>
                                    <td>
                                        @if(count($product->categories))
                                          @foreach($product->categories as $cats)
                                          
                                          <p>{{ $cats->name }}</p>
                                          
                                          @endforeach

                                          @else
                                          <span>No Categories</span>
                                          @endif
                                    </td>
                                    <td>{{ $product->user->name }}</td>
                                    <td>{{ $product->deleted_at->format('Y-m-d \a\t g:i A') }}</td>
                                    <td class="actions">

                                        {!! Form::open(array('method'=> 'PUT', 'route' => array('dashboard.products.restore', $product->id))) !!}
                                        <button type="submit" class="btn btn-xs btn-primary" data-toggle="tooltip"
                                                data-placement="top"
                                                title="" data-original-title="Restore">
                                            <i class="fa fa-refresh"></i>
                                        </button>
                                        {!! Form::close() !!}

                                        {!! Form::open(array('method'=> 'DELETE', 'route' => array('dashboard.products.forcetrash', $product->id))) !!}
                                        <button type="submit" class="btn btn-xs btn-danger deleteModal"
                                                data-toggle="tooltip" data-placement="top"
                                                title="" data-original-title="Delete Permanently">
                                            <i class="fa fa-remove"></i>
                                        </button>
                                        {!! Form::close() !!}

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Categories</th>
                                <th>Author</th>
                                <th>Last Modified</th>
                                <th>Actions</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@stop
@section('scripts')
    <!-- DataTables -->
    <script src="{{ URL::asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(function () {
            $("#example1").DataTable();
        });
    </script>

    {{--@include('dashboard.partials.message-success')--}}
    {{--@include('dashboard.partials.message-error')--}}
@stop