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
                <h4 class="page-title">تعديل المنتج</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            {{Form::model($product,['method'=>'PATCH','action' => ['App\Http\Controllers\Admin\ProductController@update',$product->id], 'files' => true])}}

            <div class="card-box">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <td>الاسم</td>
                            <td>
                                <input type="text" name="title" value="{{$product->title}}" class="form-control" required>
                            </td>
                        </tr>
                        <tr>
                            <td>الوصف</td>
                            <td>
                                <textarea name="description" class="form-control" required>{{$product->description}}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>السعر</td>
                            <td>
                                <input type="number" name="price" min="1" value="{{$product->price}}" class="form-control" required>
                            </td>
                        </tr>
                        <tr>
                            <td>التنبيه على الكمية</td>
                            <td>
                                <input type="number" name="alert_quantity" min="1" value="{{$product->alert_quantity}}" class="form-control" required>
                            </td>
                        </tr>
                        <tr>
                            <td>الاقسام</td>
                            <td>
                                <select class="select2 select2-multiple" multiple="multiple" multiple name="categories[]" required>
                                    @foreach ($data['categpries'] as $category)
                                        <option value="{{$category->id}}" {{$product->categories->where('category_id',$category->id)->count() > 0 ? 'selected' : ''}}>{{$category->title}}</option>
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