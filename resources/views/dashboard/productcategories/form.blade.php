<!-- left column -->
<div class="col-md-8">
  <!-- general form elements -->
  <div class="box box-primary">
    <!-- /.box-header -->
    <div class="box-body">
      <div class="form-group @if ($errors->has('title')) has-error @endif">
        {!! Form::label('title','Title') !!}
        {!! Form::text('title',null, ['class'=> 'form-control', 'placeholder' => 'Enter Title']) !!}
        @if ($errors->has('title')) <p class="help-block">{{ $errors->first('title') }}</p> @endif
      </div>
      
      <div class="form-group">
        {!! Form::label('editor1','Content') !!}
        {!! Form::textarea('description',null, ['rows'=> 10, 'cols' => 80, 'id' => 'editor1']) !!}
      </div>

    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</div>
<!--/.col (left) -->
<!-- right column -->
<div class="col-md-4">
  <!-- general form elements disabled -->
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Page Attributes</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <!-- text input -->
      <div class="form-group">
        <label>
          {!! Form::checkbox('active', 1, (isset($active) && $active == 1) ? true : null, ['class' => 'minimal'] ) !!}
          Publish
        </label>
      </div>
      <div class="form-group">
        <label>Select Parent Category</label>
  
        {!! Form::select('parent', $parents, [isset($parent)? $parent:null], ['class' => 'form-control select2', 'style'=>'width:100%']) !!}
       

        @if ($errors->has('parent'))
         <span class="help-block">
            <strong>{{ $errors->first('parent') }}</strong>
         </span>
        @endif

      </div>
      <div class="form-group">
        {!! Form::submit($submitButtonText, ['class'=>'btn btn-primary']) !!}
      </div>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</div>
<!--/.col (right) -->
<style>
  .select2-container--default .select2-selection--single .select2-selection__rendered {line-height: 20px !important;}
  .help-block{color:#dd4b39 !important;}
</style>
