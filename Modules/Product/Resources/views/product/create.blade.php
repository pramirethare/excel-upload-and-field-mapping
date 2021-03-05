@extends('product::layouts.master')

@section('content')
    <div class="container">
        <form action= 'javascript:void(0)' data-url="{{  route('store') }}" enctype="multipart/form-data" method="POST" id='product'>
            
            <div class="row">
                <div class="col-sm-4 offset-sm-4">                
                    <div class="form-group">
                        <label for="formFileLg" class="form-label">Choose File</label>
                        <input class="form-control form-control-lg" id="attachment" type="file" name='attachment'/>
                        <p class="small">Accepted format: Excel(xlsx)</p>
                        <div class="text-danger error" data-error="attachment"></div>
                    </div>
                </div>    
            </div>
            <div class="row">
                <div class="col-sm-4 offset-sm-4">
                    <button type="submit" class="btn btn-primary btn-block" id="send_form">Submit</button>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-4 offset-sm-4">
                    <a class="btn btn-danger btn-block" href="{{ route('product.download') }}">Download Sample File</a>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script>
        if ($("#product").length > 0) {
            $("#product").validate({
                rules: {
                    attachment: {
                        required: true,
                        extension: "xlsx"
                    }
                },
                messages: {
                    attachment: {
                        required: 'This field is required.',
                        extension: "File type not valid."
                    },
                },
                
                submitHandler: function (form) {
                    var formData = new FormData($("#product")[0]);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    
                    $.ajax({
                        url: $('#product').data('url'),
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        beforeSend: function ()  {
                            $('#send_form').attr("disabled",true);
                        },
                        success: function (response) {
                            $('#send_form').attr("disabled",false);
                            if (response.status == 'success') {
                                showSuccessAlert('',response.message,'success','Ok','');
                            } else {
                                showSuccessAlert('',response.message,'error','Ok','');
                            }
                        },
                        error(error) {
                            showErrors(error)
                        }
                    });
                }
            });
        }        
    </script>    
@endsection
