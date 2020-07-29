@if($edit === true)
    <a class="btn btn-sm btn-info btn_glyph"
       href="{{ $route }}"><i
            class="fa fa-edit"></i> {{ __('Edit')}}</a>
@else
    {!! Form::open(['method' => 'DELETE', 'url' => $route , 'class' =>'form-inline form-delete']) !!}
    {!! Form::hidden('id', $model->id) !!}
    <button type="submit" data-toggle="modal" data-target="#confirm-delete"
            data-id="{{$model->id}}" class="btn btn-sm btn-danger confirm-delete"><i
            class="glyphicon glyphicon-trash"></i> {{ __('Delete')}} </button>
    {!! Form::close() !!}
@endif
