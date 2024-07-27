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
                <h4 class="page-title">المنتجات</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-sm-12">
                        <div class=" main-btn-00">
                            <!-- Responsive modal -->
                            <a href="{{route('admin.product.create')}}" class="btn btn-default waves-effect"><i class="fa fa-plus" aria-hidden="true"></i></a>
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
                                <th data-field="السعر" data-align="center">السعر</th>
                                <th data-field="الكمية" data-align="center">الكمية</th>
                                <th data-field="التحكم" data-align="center">التحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($products))
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{$product->title}}</td>
                                        <td>{{$product->price}}</td>
                                        <td>{{$product->stocks->sum('in_stock') - $product->stocks->sum('out_stock')}}</td>
                                   
                                        <td class="actions">
                                            <a href="{{route('admin.product.show',$product->id)}}" class="btn btn-info waves-effect"><i class="fa fa-eye"></i></a>

                                            <a href="{{route('admin.product.edit',$product->id)}}" class="btn btn-primary waves-effect"><i class="fa fa-edit"></i></a>

                                            <button type="button" class="btn btn-danger waves-effect" data-toggle="modal" data-target="#{{$product->id}}delete"> <i class="fa fa-times" aria-hidden="true"></i></button>
                                            
                                            <div id="{{$product->id}}delete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
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
                                                            <form action="{{action('App\Http\Controllers\Admin\ProductController@destroy', $product['id'])}}" method="post">
                                                                {{csrf_field()}}
                                                                <input name="_method" type="hidden" value="DELETE">
                                                                <button class="btn btn-danger" type="submit">حذف</button>
                                                            </form>
                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
               
            </div>
        </div><!-- end col -->
    </div>
        
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){ 

            $('#car-select').change(function() {
                var carId = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: '{{ route('get-categories') }}',
                    data: { car_id: carId },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        $('#category-select').empty();
                        $.each(data, function(index, category) {
                            $('#category-select').append('<option value="' + category.id + '">' + category.title + '</option>');
                        });
                    }
                });
            });
        });  
    </script>

@endsection