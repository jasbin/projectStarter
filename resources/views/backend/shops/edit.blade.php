@extends('backend.layouts.app')
@section('content')
<x-backend.card>
    <x-slot name="header">
        <a href="{{route('shops.index')}}" class="btn btn-secondary btn-labeled btn-labeled-left btn-lg legitRipple  "><b><i class="fas fa-store"></i></b>&nbsp; &nbsp;Back</a>
    </x-slot>
    <x-slot name="body">
        {!! Form::model($shop,['method'=>'PUT','route'=>['shops.update',$shop->id]]) !!}

            <div class="form-group">
                {!!Form::label('name','Name',['class'=>'col-form-label col-lg-2 require']) !!}
                {!! Form::text('name',$value=null,['class'=>"form-control",'required'=>'required']) !!}
            </div>

            <div class="form-group">
                {!!Form::label('description','Description',['class'=>'col-form-label col-lg-2 require']) !!}
                {!! Form::textarea('description',$value=null,['id'=>'editor','class'=>"form-control",'required'=>'required']) !!}
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

    {!! Form::close() !!}
    </x-slot>
</x-backend.card>
@endsection
@push('after-scripts')
<script>
    CKEDITOR.replace('editor');
</script>
@endpush
