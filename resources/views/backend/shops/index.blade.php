@extends('backend.layouts.app')

@section('title', __('User Management'))

{{--@section('breadcrumb-links')--}}
{{--    @include('backend.auth.user.includes.breadcrumb-links')--}}
{{--@endsection--}}

@section('content')
    <x-backend.card>
        <x-slot name="header">
            <a href="{{route('shops.create')}}" class="btn btn-primary btn-labeled btn-labeled-left btn-lg legitRipple  "><b><i class="fas fa-store"></i></b>&nbsp; &nbsp;Add Shop</a>
        </x-slot>

        <x-slot name="body">
            <table class="table table-bordered text-center" id="myTable">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Ratings</th>
                    <th>Creator</th>
                    <th>Action</th>
                </tr>
                </thead>
            </table>
        </x-slot>
    </x-backend.card>
@endsection

@push('after-scripts')
<script>
    $(document).ready( function(){
        $('#myTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('shops.getData') !!}',
        columns: [
            { data: 'name', name: 'name' },
            { data: 'description', description: 'description' },
            { data: 'ratings', ratings: 'ratings' },
            { data: 'creator', name: 'creator' },
            { data: 'action', name: 'action' },
        ]
    });
    });
</script>
@endpush
