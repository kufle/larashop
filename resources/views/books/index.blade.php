@extends("layouts.global")

@section("title")| List Book @endsection
@section("pageTitle")List Book @endsection

@section("content")
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
<div class="row">
    <div class="col-lg-12">
        <div class="card mb-0">
            <div class="card-body">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a href="{{route('books.index')}}" class="nav-link {{Request::get('status')==NULL && Request::path()=='books' ? 'active' : ''}}">All</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('books.index',['status'=>'publish'])}}" class="nav-link {{Request::get('status')=='publish' ? 'active' : ''}}">Publish</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('books.index',['status'=>'draft'])}}" class="nav-link {{Request::get('status')=='draft' ? 'active' : ''}}">Draft</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('books.trash')}}" class="nav-link {{Request::path()=='trash' ? 'active' : ''}}">Trash</a>
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
                <div class="float-left">
                    <a href="{{route('books.create')}}" class="btn btn-success"><i class="fas fa-plus"></i></a>
                </div>
                <div class="float-right">
                    <form action="{{route('books.index')}}">
                    @csrf
                        <div class="input-group">
                            <input class="form-control" type="text" value="{{Request::get('keyword')}}" name="keyword" placeholder="Search Title">
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
                            <th><b>Cover</b></th>
                            <th><b>Title</b></th>
                            <th><b>Author</b></th>
                            <th><b>Status</b></th>
                            <th><b>Categories</b></th>
                            <th><b>Stock</b></th>
                            <th><b>Price</b></th>
                            <th><b>Action</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $book)
                        <tr>
                            <td>
                                @if($book->cover)
                                    <img src="{{asset('storage/'.$book->cover)}}" alt="" width="70px">
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>{{$book->title}}</td>
                            <td>{{$book->author}}</td>
                            <td>
                                @if($book->status == "DRAFT")
                                <span class="badge bg-dark text-white">{{$book->status}}</span>
                                @else
                                <span class="badge badge-success">{{$book->status}}</span>
                                @endif
                            </td>
                            <td>
                                <ul class="pl-3">
                                @foreach($book->categories as $category)
                                    <li>{{$category->name}}</li>
                                @endforeach
                                </ul>
                            </td>
                            <td>{{$book->stock}}</td>
                            <td>{{$book->price}}</td>
                            <td>
                                <div class="d-flex">
                                <a href="{{route('books.edit',['id'=>$book->id])}}" class="btn btn-info btn-sm mr-2" data-toggle="tooltip" data-placement="top" title="Edit Book"><i class="fas fa-pencil-alt"></i></a>
                                <form action="{{route('books.destroy',['id'=>$book->id])}}" method="POST" onsubmit="return confirm('Move Book To Trash ?')">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Move To Trash ?"><i class="fas fa-trash"></i></button>
                                </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="10">
                                {{$books->appends(Request::all())->links()}}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection