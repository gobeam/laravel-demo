<aside class="col-md-4 blog-sidebar">
    <div class="p-3">
        <h4 class="font-italic">Archives</h4>
        <ol class="list-unstyled mb-0">
            @foreach($archives as $key => $archive)
                @php $parts = explode("-",$key) @endphp
                <li><a href="{{ url("?year=".$parts[0]."&month=".$parts[1]) }}">{{ \Carbon\Carbon::parse($key)->isoFormat('MMM YY')  }}</a></li>
            @endforeach
        </ol>
    </div>
</aside><!-- /.blog-sidebar -->
