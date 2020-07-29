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
            @can('create', $emptyCategory)
                <a class="btn btn-success" href="{{ URL::to('/category/create') }}"><i class="fa fa-plus" aria-hidden="true"
                                                                                 style="margin-right:10px;"></i>{{ __('Add New')}}
                </a>
            @endif
        </div>
    </div>

    @include('errors.error')
    <div class="card">
        @component('slots.search',['url'=> URL::to('/category')])
        @endcomponent

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" data-toggle="dataTable"
                       data-form="deleteForm">
                    <thead class="cf">
                    <tr>
                        <th>S.N.</th>
                        <th>{{ __('Title') }}</th>
                        <th>{{ __('Status')}} </th>
                        <th>{{ __('Action')}}</th>
                    </tr>
                    </thead>
                    <tbody>

                    @php $a=$categories->perPage() * ($categories->currentPage()-1); @endphp
                    @forelse($categories as $category)
                        @php $a++;@endphp
                        <tr>
                            <td>{{ $a }}</td>
                            <td>{{$category->title}}</td>
                            <td><span class="badge badge-{{ $category->status ? "success" : "warning" }}">{{ $category->status ? "Active" : "Inactive" }}</span></td>

                            <td class="">
                                @can('update', $category)
                                    @component('slots.editDeleteForm',['route'=> route('category.edit',$category->id), "edit" => true])
                                    @endcomponent
                                @endcan
                                @can('update', $category)
                                    @component('slots.editDeleteForm',['route'=> route('category.destroy',$category->id), "edit" => false, "model" => $category])
                                    @endcomponent
                                @endcan
                                    @can('view', $category)
                                        <a class="btn btn-sm btn-info btn_glyph"
                                           href="{{ route('category.show', $category->id) }}"><i
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

        @if(!$categories->isEmpty())
            <div class="pagination-tile">
                <label class="pagination-sub" style="display: block">
                    {{ __('Showing') }} {{($categories->currentpage()-1)*$categories->perpage()+1}} {{ __('to')}} {{(($categories->currentpage()-1)*$categories->perpage())+$categories->count()}} {{ __('of')}} {{$categories->total()}} {{ __('entries')}}
                </label>
                <ul class="pagination">
                    {!! str_replace('/?', '?',$categories->appends(['keywords'=>Request::input('keywords')])->render()) !!}
                </ul>
            </div>
    @endif

@endsection
