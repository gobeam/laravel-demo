<div class="card-header">
    <div class="row">
        <div class="col-sm-6">
            {!!Form::open(['method'=>'GET','url'=>$url, 'class'=>'form-inline'])!!}
            <div class="form-group">
                <input type="text" class="form-control" name="keywords"
                       value="{{Request::input('keywords')}}" autocomplete="off">
                <button type="submit" class="btn btn-success">{{ __('Search')}}</button>
            </div>
        </div>
        {!!Form::close() !!}
    </div>
</div>
