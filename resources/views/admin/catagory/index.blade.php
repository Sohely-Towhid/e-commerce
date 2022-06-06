@extends('layouts.dashboard')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>Catagory list</h3>
                </div>
                <div class="card-body">
                <form action="{{ url('/mark/delete') }}" method="POST">
                    @csrf
                    <table class="table table-bordered">
                        <tr>
                            <th><input type="checkbox" class="checkall">check all</th>
                            <th>SL</th>
                            <th>Catagory Name</th>
                            <th>Added By</th>
                            <th>Image</th>
                            <th>Created AT</th>
                            <th>Action</th>
                        </tr>



                        @foreach($catagories as $key=>$catagory)

                        <tr>
                            <td>
                                <input type="checkbox" name="mark[]" class="checkme" value="{{ $catagory->id }}">
                            </td>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $catagory->catagory_name }}</td>
                            <td>{{ App\Models\User::find( $catagory->added_by ) ->name }}</td>
                            <td><img width="50"src="{{ asset('uploads/catagory')}}/{{ $catagory->catagory_image }}" alt=""></td>
                            <td>{{ $catagory->created_at->diffForHumans()}}</td>

                            <td>
                             <div class="d-flex">
                                <a href="{{ route('catagory.edit',$catagory->id) }}" class="btn btn-success shadow btn-xs sharp mr-1">
                                    <i class="fa fa-pencil">
                                    </i></a>
                                <a href="{{ route('catagory.delete',$catagory->id) }}" class="btn btn-danger shadow btn-xs sharp mr-1">
                                    <i class="fa fa-trash">
                                    </i></a>
                             </div>
                            </td>

                        </tr>
                        @endforeach


                    </table>
                    @if ($catagories_count !=0)
                    <button type="submit" class="btn btn-danger">Delete All</button>
                    @endif
                </form>

                </div>
            </div>


                //// Trash-catagory//////

            <div class="card mt-5">
                <div class="card-header">
                    <h3> Trash Catagory List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th><input type="checkbox" class="checkall2">check all</th>
                            <th>SL</th>
                            <th>Catagory Name</th>
                            <th>Added By</th>
                            <th>Image</th>
                            <th>Created AT</th>
                            <th>Action</th>
                        </tr>

                        @forelse( $trash_catagories as $key=>$catagory)

                        <tr>
                            <td>
                                <input type="checkbox" name="mark[]" class="checkme2" value="{{ $catagory->id }}">
                            </td>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $catagory->catagory_name }}</td>
                            <td>{{ App\Models\User::find( $catagory->added_by ) ->name }}</td>
                            <td><img width="50"src="{{ asset('uploads/catagory')}}/{{ $catagory->catagory_image }}" alt=""></td>
                            <td>{{ $catagory->created_at->diffForHumans()}}</td>

                            <td>
                                <a href="{{ route('catagory.restore',$catagory->id) }}" class="btn btn-success">restore</a>
                                <a href="{{ route('catagory.force_delete',$catagory->id) }}" class="btn btn-danger">Delete</a>
                            </td>

                        </tr>
                        @empty

                        <tr>
                            <td colspan="5" class="text-center">No Data Found</td>
                        </tr>

                        @endforelse

                    </table>
                </div>
            </div>
        </div>


        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Add Catagory</h3>
                </div>

                <div class="card-body">
                    <form action="{{url('/catagory/insert')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mt-3">
                            <label for="" class="form-label">Catagory Name</label>
                            <input type="text" class="form-control" name="catagory_name">
                            @error('catagory_name')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div class="mt-3">
                            <label for="" class="form-label">Catagory Image</label>
                            <input type="file" class="form-control" name="catagory_image">
                            @error('catagory_image')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Add Catarory</button>

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
