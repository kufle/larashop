@extends("layouts.global")

@section("title")| Create Categories @endsection
@section("pageTitle")Create Categories @endsection

@section("content")
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                @if(session('status'))
                <div class="alert alert-success alert-dismissible show fade">
                    <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>×</span>
                    </button>
                    {{session('status')}}
                    </div>
                </div>
                @endif
                <form method="POST" enctype="multipart/form-data" action="{{route('categories.store')}}">
                    @csrf
                    
                    <div class="form-group">
                        <label for="name">Category Name</label>
                        <input type="text" class="form-control" name="name">
                    </div>

                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" name="image">
                    </div>

                    <input type="submit" class="btn btn-primary" value="Save">
                    
                </form>
            </div>
        </div>
    </div>
</div>
@endsection