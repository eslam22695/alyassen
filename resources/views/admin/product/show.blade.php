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
                <h4 class="page-title">تفاصيل المنتج</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <td>الاسم</td>
                            <td>
                                {{$product->title}}
                            </td>
                        </tr>
                        <tr>
                            <td>الوصف</td>
                            <td>
                                {{$product->description}}
                            </td>
                        </tr>
                        <tr>
                            <td>السعر</td>
                            <td>
                                {{$product->price}}
                            </td>
                        </tr>
                        <tr>
                            <td>تنبيه الكمية</td>
                            <td>
                                {{$product->alert_quantity}}
                            </td>
                        </tr>
                    </tbody>
                </table>
               
            </div>
        </div><!-- end col -->
    </div>
@endsection