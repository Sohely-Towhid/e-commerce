@extends('layouts.dashboard')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>Sub Catagory list</h3>
                </div>
                <div class="card-body">
                <form action="{{ url('/mark/delete') }}" method="POST">
                    @csrf
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Catagory Name</th>
                            <th>SubCatagory Name</th>
                            <th>Created AT</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($subcatagories as $key=>$subcatagory )
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{!! ($subcatagory->rel_to_catagory->deleted_at==NULL?$subcatagory->rel_to_catagory->catagory_name:$subcatagory->rel_to_catagory->catagory_name. '<span class="badge bg-secoandary">Soft Deleted</span>')!!}</td>
                                <td>{{ $subcatagory->subcatagory_name }}</td>
                                <td>{{ $subcatagory->created_at->diffForHumans() }}</td>
                                <td>
                                    <a href="{{ route('subcatagory.delete',$subcatagory->id) }}" class="btn btn-danger shadow btn-xs sharp mr-1">
                                        <i class="fa fa-trash">
                                        </i></a>
                                </td>
                            </tr>

                        @endforeach
                    </table>
                </form>
            </div>
        </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Add Sub Catagory</h3>
                </div>

                <div class="card-body">
                    <form action="{{ url('/subcatagory/insert') }}" method="POST">
                        @csrf
                        <div class="mt-3">
                            <select name="catagory_id" class="form-control">
                                <option value="">--Select catagory--</option>
                                @foreach ($catagories as $catagory )
                                 <option value="{{ $catagory->id }}">{{ $catagory->catagory_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-3">
                            <label for="" class="form-label"> Sub Catagory Name</label>
                            <input type="text" class="form-control" name="subcatagory_name">
                            @error('subcatagory_name')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Add SubCatarory</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer_script')
@if (session('success'))
    <script>
        Swal.fire(
        'Good job!',
       ' {{ session('success') }}',
        'success'
        )
    </script>

@endif

@if (session('delete'))
    <script>
        Swal.fire(
        'Good job!',
       ' {{ session('delete') }}',
        'success'
        )
    </script>

@endif


<script>
    $(function(){

            $('.checkall').click(function(){
                var checked=$(this).prop('checked');
                $('.checkme').prop('checked',checked);
            });
    })
</script>

<script>
    $(function(){

            $('.checkall2').click(function(){
                var checked=$(this).prop('checked');
                $('.checkme2').prop('checked',checked);
            });
    })
</script>
@endsection
