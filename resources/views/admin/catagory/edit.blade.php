@extends('layouts.dashboard')


@section('content')

<section>
     <div class="container-fluid">
         <div class="row">
            <div class="col-lg-8 m-auto">
                <div class="card">
                    <div class="card-header">
                        <h3>Edit Catagory</h3>
                    </div>

                    <div class="card-body">
                        <form action="{{url('/catagory/update')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mt-3">
                                <label for="" class="form-label">Catagory Name</label>
                                <input type="hidden" class="form-control" name="id" value="{{$Catagory_info->id}}">
                                <input type="text" class="form-control" name="catagory_name" value="{{$Catagory_info->catagory_name}}">
                                @error('catagory_name')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>

                            <div class="mt-3">
                                <label for="" class="form-label">Catagory Image</label>
                                <input type="file" class="form-control" name="catagory_image" >

                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Update Catarory</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
         </div>
     </div>
</section>

@endsection
