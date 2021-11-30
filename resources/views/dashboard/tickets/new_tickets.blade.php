@extends('layout.template')

@section('title', 'Criar Ticket')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <!-- include summernote css/ js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@stop

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#"> Ticktes</a></li>
    <li class="breadcrumb-item active">Criar</li>
@stop

@section('content')
    @if($errors)
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">
                {{$error}}
            </div>
        @endforeach
    @endif
    <form action="" method="POST" enctype="multipart/form-data" class="form-validate">
        @csrf
        <div class="row">

            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Informações</h3>
                    </div>

                    <div class="card-body">

                        <div class="form-row">
                            <div class="col">
                                <label for="title">Título</label>
                                <input type="text" class="form-control" name="title" id="title">
                            </div>

                            <div class="col">
                                <label for="category">Categoria</label>
                                <select class="custom-select" name="category" id="category">
                                    @foreach(\App\Models\Category::all() as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col">
                                <label for="customer">Cliente</label>
                                <select class="custom-select" name="customer" id="customer">
                                    @foreach(\App\Models\Customer::all() as $customer)
                                        <option value="{{$customer->id}}">{{$customer->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col">
                                <label for="description">Descrição</label>
                                <textarea id="summernote" name="description"></textarea>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Anexos (opcional)</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="attachments" name="attachments[]" multiple>
                                    <label class="custom-file-label" for="attachments">Escolher arquivo</label>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.card -->
                </div>

                <div class="col-12 d-flex justify-content-end mb-3">
                    <button class="btn btn-primary" type="submit">
                        Criar
                    </button>
                </div>
            </div>
        </div>
    </form>
@stop

@section('scripts')
    <!-- Summernote TextArea -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="{{asset('js/dashboard/tickets/summernote.js')}}"></script>

    <!-- Custom files input -->
    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
    <script src="{{asset('js/dashboard/tickets/custom-file-input.js')}}"></script>

    <!-- Jquery Validate -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.js"></script>

    <script src="{{asset('js/dashboard/tickets/form-validate.js')}}"></script>
@stop
