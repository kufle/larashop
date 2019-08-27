@extends("layouts.global")
@section("title")| Users List @endsection
@section("pageTitle")Users List @endsection

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
                <div class="table-responsive">
                <div class="float-left">
                    <a href="{{route('users.create')}}" class="btn btn-success"><i class="fas fa-plus"></i></a>
                </div>
                <div class="float-right">
                    <form action="{{route('users.index')}}">
                        
                    <div class="input-group">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="active" value="ACTIVE">
                            <label class="form-check-label" for="active">Active</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="inactive" value="INACTIVE">
                            <label class="form-check-label" for="inactive">Inactive</label>
                        </div>
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
                        <th>Image</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Roles</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $index => $user)
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>
                            @if($user->avatar)
                            <img src="{{asset('storage/'.$user->avatar)}}" alt="" width="70px">
                            @else
                            N/A
                            @endif
                            </td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->username}}</td>
                            <td>
                            @foreach(json_decode($user->roles) as $role)
                            {{$role}}<br>
                            @endforeach
                            </td>
                            <td>{{$user->phone}}</td>
                            <td>
                                <span class="badge {{$user->status=='ACTIVE' ? 'badge-success' : 'badge-danger'}}">
                                    {{$user->status}}
                                </span>
                            </td>
                            <td>{{$user->email}}</td>
                            <td>
                               <div class="d-flex">
                                <a class="btn btn-primary btn-sm" href="{{route('users.show',['id'=>$user->id])}}"><i class="fas fa-eye"></i></a>&nbsp;
                                <a class="btn btn-info btn-sm" href="{{route('users.edit',['id'=>$user->id])}}"><i class="fas fa-pencil-alt"></i></a>&nbsp;
                                <form onsubmit="return confirm('Delete this user permanently?')" action="{{route('users.destroy',['id'=>$user->id])}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="submit" value="&#xf2ed" class="fa btn btn-danger btn-sm">
                                </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="9">
                                {{$users->appends(Request::all())->links()}}
                            </td>
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection