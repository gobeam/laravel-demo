@if($errors->any())
    @if(($errors->first('alert-success') || $errors->first('alert-danger') || $errors->first('alert-warning')))
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if($errors->has('alert-' . $msg))
                <div class="alert alert-{{ $msg }}" style="width: 100%;">
                    <p style="margin-bottom: 0px;">{{ $errors->first('alert-' . $msg) }}<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                </div>
            @endif
        @endforeach
    @endif
@endif
