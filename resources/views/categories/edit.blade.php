@extends("layouts.global")
@section("title")| Edit Category @endsection
@section("pageTitle")Edit Category @endsection

@section("content")
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                @if(session('status'))
                <div class="alert alert-success alert-dismissible show fade">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>x</span>
                        </button>
                        {{session('status')}}
                    </div>
                </div>
                @endif
                <form action="{{route('categories.update',['id'=>$category->id])}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">

                    <div class="form-group">
                        <label for="category">Category</label>
                        <input type="text" class="form-control" name="name" value="{{$category->name}}">
                    </div>

                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control" name="slug" value="{{$category->slug}}">
                    </div>
                    
                    @if($category->image)
                        <img src="{{asset('storage/'.$category->image)}}" alt="">
                    @else
                        N/A
                    @endif
                    <br>
                    <small class="text-muted">*kosongkan jika tidak merubah image</small>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" name="image">
                    </div>

                    <input type="submit" class="btn btn-primary" value="Update">

                </form>
            </div>
        </div>
    </div>
</div>
@endsection