@extends('layouts.dashboard')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header">
                        <h3> Product List </h3>
                    </div>
                    <div class="card-body">
                        <div class="card-wrap overflow-auto">
                            <table class="table table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Product Name</th>
                                        <th>Product Price</th>
                                        <th>Product discount</th>
                                        <th>After discount</th>
                                        <th>Brand Name</th>
                                        <th>Short Description</th>
                                        <th>Description</th>

                                        <th>Product preview</th>
                                        <th>Action</th>



                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($products  as $key=>$product  )


                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $product->product_name }}</td>
                                            <td>{{ number_format($product->product_price) }}</td>
                                            <td>{{ $product->product_discount }}</td>
                                            <td>{{ $product->after_discount }}</td>
                                            <td>{{ $product->brand }}</td>
                                            <td>{{ $product->short_description }}</td>
                                            <td>{{ $product->description }}</td>
                                            <td>
                                                <img width="100" src="{{ asset('/uploads/product/preview/') }}/{{ $product->preview }}" alt="">
                                            </td>
                                            <td class="d-flex">
                                                <a href="{{ route('inventory',$product->id) }}" class="btn btn-info shadow btn-xs sharp mr-1">
                                                    <i class="fa fa-archive"></i>
                                                </a>
                                                <a href="" class="btn btn-danger shadow btn-xs sharp mr-1">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h3 class="text-white">Add Product</h3>
                    </div>
                    <div class="card-body">

                        <form action="{{ url('/product/insert') }}" method="POST" enctype="multipart/form-data">
                            @csrf


                            <div class="form-group">
                               <select name="catagory_id" class="form-control" id="catagory_id">
                                   <option value="">--Select Catagory--</option>
                                    @foreach ($catagories as $catagory)
                                       <option value="{{  $catagory->id}}">{{ $catagory->catagory_name}}</option>
                                    @endforeach
                               </select>
                            </div>
                            <div class="form-group">
                                <select name="subcatagory_id" class="form-control" id="subcatagory_name">
                                    <option value="">--Select Sub Catagory--</option>
                                </select>
                             </div>


                            <div class="form-group">
                                <input type="text" class="form-control" name="product_name" placeholder="Product Name">
                            </div>

                            <div class="form-group">
                                <input type="number" class="form-control" name="product_price" placeholder="Product Price">
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" name="discount" placeholder="Product Discount %">
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" name="brand_name" placeholder="Brand Name">
                            </div>

                            <div class="form-group">
                                <textarea name="short_description" class="form-control" placeholder="Short_Description"></textarea>
                            </div>
                            <div class="form-group">
                                <textarea name="description" class="form-control" placeholder="Description"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="" class="form-label">Product Image</label>
                                <input type="file" class="form-control" name="product_preview">
                            </div>

                            <div class="form-group">
                                <label for="" class="form-label">Product Thumbnails</label>
                                <input type="file" multiple class="form-control" name="product_thumbnails[]">
                            </div>

                            <div class="form-group">
                               <button type="submit" class="btn btn-primary">Add product</button>
                            </div>






                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection

@section('footer_script')


    <script>
         $('#catagory_id').change(function(){
           var catagory_id = $(this).val();

           $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });

            $.ajax({

            type:'POST',
            url:'/getCatagory',
            data:{'catagory_id':catagory_id},
            success:function(data){
                $('#subcatagory_name').html(data);
            }
            });
         })
    </script>

    <script>
        $(document).ready(function() {
    $('#catagory_id').select2();
    });
    </script>
@endsection
