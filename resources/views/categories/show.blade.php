@extends("layouts.global")

@section("title")| Detail Category @endsection
@section("pageTitle")Detail Category @endsection

@section("content")
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <label for="category"><b>Category Name</b></label><br>
                {{$category->name}}
                <br><br>

                <label for="slug"><b>Slug</b></label><br>
                {{$category->slug}}
                <br><br>

                <label for="image"><b>Image</b></label><br>
                @if($category->image)
                <img src="{{asset('storage/'.$category->image)}}" alt="" width="120px">
                @else
                N/A
                @endif
            </div>
        </div>
    </div>
</div>
@endsection