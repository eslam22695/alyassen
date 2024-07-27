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
                <h4 class="page-title">الاقسام</h4>
            </div>

            @if ($errors->has('title'))
                <div class="alert alert-danger">
                    <strong>{{ $errors->first('title') }}</strong>
                </div>
            @endif

        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-sm-12">
                        @can('category-create')
                        <div class=" main-btn-00">
                            <!-- Responsive modal -->
                            <button type="button" class="btn btn-default waves-effect" data-toggle="modal" data-target="#add"> <i class="fa fa-plus" aria-hidden="true"></i></button>
                        </div>
                        @endcan
                    </div>
                </div>
                <div class="col-sm-12">
                    <div>
                        <!-- Responsive modal -->
                        <div id="add" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    {{Form::open(['method'=>'POST','action' => ['App\Http\Controllers\Admin\CategoryController@store'], 'files' => true])}}
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="icon" class="control-label">الاسم</label>
                                                        <input type="text" name="title" value="{{old('title')}}" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <button type="submit" class="btn btn-default waves-effect waves-light form-control">حفظ</button>
                                                </div>
                                            </div>
                                        </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="table-responsive">
                    <table  data-toggle="table"
                            data-search="true"
                            data-show-columns="true"
                            data-sort-name="id"
                            data-page-list="[8, 16, 32]"
                            data-page-size="8"
                            data-pagination="true" data-show-pagination-switch="true" class="table-bordered ">
                                    
                        <thead>
                            <tr>
                                <th data-field="الاسم" data-align="center">الاسم</th>
                                <th data-field="التحكم" data-align="center">التحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($categories))
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{$category->title}}</td>
                                        
                                        <td class="actions">
                                            @can('category-edit')
                                            <button type="button" class="btn btn-success waves-effect" data-toggle="modal" data-target="#{{$category->id}}edit"> <i class="fa fa-edit" aria-hidden="true"></i></button>
                                            @endcan

                                            @can('category-delete')
                                            <button type="button" class="btn btn-danger waves-effect" data-toggle="modal" data-target="#{{$category->id}}delete"> <i class="fa fa-times" aria-hidden="true"></i></button>
                                            @endcan
                                        </td>
                                    </tr>

                                    <div id="{{$category->id}}edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                </div>
                                                {{Form::model($category,['method'=>'PATCH','action' => ['App\Http\Controllers\Admin\CategoryController@update',$category->id], 'files' => true])}}

                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="icon" class="control-label">الاسم</label>
                                                                    <input type="text" name="title" value="{{$category->title }}" class="form-control" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <button type="submit" class="btn btn-default waves-effect waves-light form-control">حفظ</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
    
                                    <div id="{{$category->id}}delete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog" style="width:55%;">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="icon error animateErrorIcon" style="display: block;"><span class="x-mark animateXMark"><span class="line left"></span><span class="line right"></span></span></div>
                                                    <h4 style="text-align:center;"> !!تأكيد الحذف</h4>
                                                </div>
                                                <div class="modal-footer" style="text-align:center">
                                                    <form action="{{action('App\Http\Controllers\Admin\CategoryController@destroy', $category['id'])}}" method="post">
                                                        {{csrf_field()}}
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        <button class="btn btn-danger" type="submit">حذف</button>
                                                    </form>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
    
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
               
            </div>
        </div><!-- end col -->
    </div>
        
@endsection