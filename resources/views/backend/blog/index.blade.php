@extends('layouts.app')
@section('title')
    {{$title}}
@endsection
@section('content')

    @component('slots.breadcrumb',['title'=>$title])
    @endcomponent

    <div id="page-title">
        <h2 style="display:inline-block">{{ __($title)}}</h2>
        <div class="right" style="float:right">
            @can('create', $emptyBlog)
                <a class="btn btn-success" href="{{ URL::to('/blog/create') }}"><i class="fa fa-plus" aria-hidden="true"
                                                                                 style="margin-right:10px;"></i>{{ __('Add New')}}
                </a>
            @endif
        </div>
    </div>

    @include('errors.error')
    <div class="card">
        @component('slots.search',['url'=> URL::to('/blog')])
        @endcomponent

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" data-toggle="dataTable"
                       data-form="deleteForm">
                    <thead class="cf">
                    <tr>
                        <th>S.N.</th>
                        <th>{{ __('Title') }}</th>
                        <th>{{ __('Description')}} </th>
                        <th>{{ __('Status')}} </th>
                        <th>{{ __('Action')}}</th>
                    </tr>
                    </thead>
                    <tbody>

                    @php $a=$blogs->perPage() * ($blogs->currentPage()-1); @endphp
                    @forelse($blogs as $blog)
                        @php $a++;@endphp
                        <tr>
                            <td>{{ $a }}</td>
                            <td>{{$blog->title}}</td>
                            <td>{{$blog->description}}</td>
                            <td><span class="badge badge-{{ $blog->status ? "success" : "warning" }}">{{ $blog->status ? "Published" : "Un Published" }}</span></td>

                            <td class="">
                                @can('update', $blog)
                                    @component('slots.editDeleteForm',['route'=> route('blog.edit',$blog->id), "edit" => true])
                                    @endcomponent
                                @endcan
                                @can('update', $blog)
                                    @component('slots.editDeleteForm',['route'=> route('blog.destroy',$blog->id), "edit" => false, "model" => $blog])
                                    @endcomponent
                                @endcan
                                    @can('view', $blog)
                                        <a class="btn btn-sm btn-info btn_glyph"
                                           href="{{ route('blog.show', $blog->id) }}"><i
                                                class="fa fa-edit"></i> {{ __('View')}}</a>
                                    @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="no-data" colspan="6">
                                <b>{{ __('No data to display!')}}</b>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if(!$blogs->isEmpty())
            <div class="pagination-tile">
                <label class="pagination-sub" style="display: block">
                    {{ __('Showing') }} {{($blogs->currentpage()-1)*$blogs->perpage()+1}} {{ __('to')}} {{(($blogs->currentpage()-1)*$blogs->perpage())+$blogs->count()}} {{ __('of')}} {{$blogs->total()}} {{ __('entries')}}
                </label>
                <ul class="pagination">
                    {!! str_replace('/?', '?',$blogs->appends(['keywords'=>Request::input('keywords')])->render()) !!}
                </ul>
            </div>
    @endif

@endsection
