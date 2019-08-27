@extends("layouts.global")
@section("title")| List Categories @endsection
@section("pageTitle")List Categories @endsection

@section("content")
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
<div class="row">
    <div class="col-12">
    <div class="card mb-0">
        <div class="card-body">
        <ul class="nav nav-pills">
            <li class="nav-item">
            <a class="nav-link active" href="{{route('categories.index')}}">Published</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="{{route('categories.trash')}}">Trash</a>
            </li>
        </ul>
        </div>
    </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <div class="float-left">
                        <a href="{{route('categories.create')}}" class="btn btn-success"><i class="fas fa-plus"></i></a>
                    </div>
                    <div class="float-right">
                        <form action="{{route('categories.index')}}">
                            <div class="input-group">
                                <input type="text" class="form-control" name="keyword" placeholder="Search" value="{{Request::get('keyword')}}">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="clearfix mb-3"></div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th>No</th>
                            <th>Categories Name</th>
                            <th>Slug</th>
                            <th>Image</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $index => $categorie)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$categorie->name}}</td>
                                <td>{{$categorie->slug}}</td>
                                @if($categorie->image)
                                <td><img src="{{asset('storage/'.$categorie->image)}}" alt="" width="70px"></td>
                                @else
                                <td>N/A</td>
                                @endif
                                <td>
                                    <div class="d-flex">
                                        <a href="{{route('categories.show',['id'=>$categorie->id])}}" class="btn btn-primary btn-sm mr-2"><i class="fas fa-eye"></i></a>
                                        <a href="{{route('categories.edit',['id'=>$categorie->id])}}" class="btn btn-info btn-sm mr-2"><i class="fas fa-pencil-alt"></i></a>
                                        <form action="{{route('categories.destroy',['id'=>$categorie->id])}}" method="POST" onsubmit="return confirm('Move Category to Trash ?')">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="10">{{$categories->appends(Request::all())->links()}}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection