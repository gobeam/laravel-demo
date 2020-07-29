
<input type="hidden" name="id" value="{{ isset($blog) ? $blog->id : null}}">
<div class="form-group row">
    {!! Form::label('title','Title:',array('class'=>'col-sm-2 col-form-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('title',null,array('placeholder'=>'Title','class'=>'form-control','disabled'=>$readOnly)) !!}
        @error('title')
        <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
    </div>
</div>


<div class="form-group row">
    {!! Form::label('status','Status:',array('class'=>'col-sm-2 col-form-label')) !!}
    <div class="col-sm-10 ">
        <div class="form-check form-check-inline">
            {!! Form::radio('status',1,null ,array('class'=>'form-check-input', 'id'=> "inlineRadio1", 'disabled'=>$readOnly)) !!}
            {!! Form::label('status','Publish', null,array('class'=>'form-check-label', 'for'=> "inlineRadio1")) !!}
        </div>

        <div class="form-check form-check-inline">
            {!! Form::radio('status',0,null, array('class'=>'form-check-input', 'id'=> "inlineRadio2", 'disabled'=>$readOnly)) !!}
            {!! Form::label('status','Un-Publish',array('class'=>'form-check-label', 'for'=> "inlineRadio2")) !!}
        </div>
        @error('status')
        <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
    </div>


</div>

@if(!$readOnly)
    <div class="form-group row">
        <div class="col-sm-10">
            {!! Form::submit($btnTxt,array('class'=>'btn btn-success')) !!}
        </div>
    </div>
@endif
