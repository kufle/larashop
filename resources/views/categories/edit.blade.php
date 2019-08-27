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
                        <input type="text" class="form-control {{$errors->first('name') ? 'is-invalid' : ''}}" name="name" value="{{old('name') ? old('name') : $category->name}}">
                        <div class="invalid-feedback">
                            {{$errors->first('name')}}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control {{$errors->first('slug') ? 'is-invalid' : ''}}" name="slug" value="{{old('slug') ? old('slug') : $category->slug}}">
                        <div class="invalid-feedback">
                            {{$errors->first('slug')}}
                        </div>
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
                        <input type="file" class="form-control {{$errors->first('image') ? 'is-invalid' : ''}}" name="image">
                        <div class="invalid-feedback">
                            {{$errors->first('image')}}
                        </div>
                    </div>

                    <input type="submit" class="btn btn-primary" value="Update">

                </form>
            </div>
        </div>
    </div>
</div>
@endsection