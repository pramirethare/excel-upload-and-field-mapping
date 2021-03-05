@extends('product::layouts.master')

@section('content')
    <div class="container">
        <form action="{{ route('product.import') }}" data-url="{{ route('product.import') }}" method="POST" id='product'>
            {{ csrf_field() }}
            @foreach ($columns as $key => $column)
                <div class="row">
                    <div class="col-sm-6 offset-sm-3">                        
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">{{ $column }}</label>
                            <div class="col-sm-10">
                                <select class="form-control required" name='{{ "header[{$key}]" }}' id="{{ $key }}" onchange="manageError(this)">
                                    <option value="">--Select--</option>
                                    @foreach ($headings as $headerKey => $heading)
                                        <option value="{{ $headerKey }}">{{ ucfirst(str_replace('_', ' ', $heading)) }}</option>
                                    @endforeach
                                </select>
                                <div class="error" id='{{ "$key-error" }}'></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </form>
        <div class="row">
            <div class="col-sm-6 offset-sm-3 text-center">
                <button type="button" class="btn btn-primary" onclick="submit()">Submit</button>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script>
        var error = 0;
        function submit() {
            error = 0;
            $('.required').each(function(){
                manageError(this);
            });
            if (error == 0) {
                $('#product').submit();
            }
        }

        function manageError(obj)
        {
            var elementValue = $(obj).val();
            var elementId = $(obj).attr('id');
            var elementErrorId = `#${elementId}-error`;
            if ( elementValue == '') {
                error++;
                $(elementErrorId).html('Please select an option.');
            } else {
                $(elementErrorId).html('');
            }
        }
    </script>
@endsection