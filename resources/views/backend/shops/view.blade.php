@extends('backend.layouts.app')
@section('content')
<x-backend.card>
    <x-slot name="header">
        <a href="{{ route('shops.index') }}"
            class="btn btn-secondary btn-labeled btn-labeled-left btn-lg legitRipple  "><b><i
                    class="fas fa-store"></i></b>&nbsp; &nbsp;Back</a>
    </x-slot>
    <x-slot name="body">
        <table class="table">
            <thead>
                <tr>
                  <th>Field</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Name</td>
                <td>{{$shop->name}}</td>
                </tr>
                <tr>
                  <td>Description</td>
                  <td>{!! $shop->description !!}</td>
                </tr>
                <tr>
                    <td>Creator</td>
                    <td>{{shopOwnerName($shop->user_id)}}</td>
                  </tr>
              </tbody>
        </table>
    </x-slot>
</x-backend.card>
@endsection
