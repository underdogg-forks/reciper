@extends('layouts.auth')

@section('title', trans('documents.new_doc'))

@section('head')
    <script src="{{ url('/vendor/tinymce/tinymce.min.js') }}"></script>
@endsection

@section('content')

@include('includes.buttons.back', ['url' => '/documents'])

<div class="page">
    <div class="center">
        <h1 class="header">@lang('documents.new_doc')</h1>
    </div>

    <form action="{{ action('DocumentsController@store') }}" method="post">
        @csrf
        <div class="center pb-2 pt-3">
            {{--  Save button  --}}
            <button type="submit" class="btn-floating green tooltipped" data-tooltip="@lang('tips.save')">
                <i class="fas fa-save"></i>
            </button>
        </div>

        <div class="input-field"> {{-- Title field --}}
            <input type="text" name="title" id="title" value="{{ old('title') }}" class="counter" data-length="{{ config('valid.docs.title.max') }}" maxlength="{{ config('valid.docs.title.max') }}" minlength="{{ config('valid.docs.title.min') }}">
            <label for="title">@lang('documents.doc_title')</label>
            @include('includes.input-error', ['field' => 'title'])
        </div>

        <div class="mx-3">
            @include('includes.input-error', ['field' => 'text'])
        </div>

        <div class="input-field"> {{-- Textarea --}}
            <textarea name="text" id="text" class="materialize-textarea"></textarea>
            <span class="helper-text">@lang('documents.doc_text')</span>
        </div>
    </form>
</div>

@endsection

@section('script')
    @include('includes.js.tinymse')
@endsection