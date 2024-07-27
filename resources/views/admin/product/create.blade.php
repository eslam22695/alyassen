@extends('layouts.admin')

@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            @if (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @elseif(Session::has('danger'))
                <div class="alert alert-danger">{{ Session::get('danger') }}</div>
            @endif
            <div class="main-title-00">
                <h4 class="page-title">إنشاء منتج</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            {{Form::open(['method'=>'POST','action' => ['App\Http\Controllers\Admin\ProductController@store'], 'files' => true])}}

                <div class="card-box">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <td>الاسم</td>
                                <td>
                                    <input type="text" name="title" value="{{old('title')}}" class="form-control" required>
                                </td>
                            </tr>
                            <tr>
                                <td>الوصف</td>
                                <td>
                                    <textarea name="description" class="form-control" required>{{old('description')}}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>السعر</td>
                                <td>
                                    <input type="number" name="price" min="1" value="{{old('price')}}" class="form-control" required>
                                </td>
                            </tr>
                            <tr>
                                <td>الكمية الافتتاحية</td>
                                <td>
                                    <input type="number" name="in_stock" min="1" value="{{old('in_stock')}}" class="form-control" required>
                                </td>
                            </tr>
                            <tr>
                                <td>التنبيه على الكمية</td>
                                <td>
                                    <input type="number" name="alert_quantity" min="1" value="{{old('alert_quantity')}}" class="form-control" required>
                                </td>
                            </tr>
                            <tr>
                                <td>الاقسام</td>
                                <td>
                                    <select class="select2 select2-multiple" multiple="multiple" multiple name="categories[]" required>
                                        @foreach ($data['categpries'] as $category)
                                            <option value="{{$category->id}}">{{$category->title}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>   
                            <tr>
                                <td></td>
                                <td>
                                    <button type="submit" class="btn btn-success">حفظ</button>
                                </td>
                            </tr>        
                        </tbody>
                    </table>
                </div>
            {!! Form::close() !!}

        </div><!-- end col -->
    </div>
@endsection