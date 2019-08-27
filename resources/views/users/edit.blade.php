@extends("layouts.global")
@section("title") | Edit User @endsection
@section("pageTitle") Edit User @endsection

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
                <form enctype="multipart/form-data" action="{{route('users.update',['id'=>$user->id])}}" method="POST">
                    @csrf
                    <input type="hidden" value="PUT" name="_method">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control {{$errors->first('name') ? 'is-invalid' : ''}}" name="name" id="name" placeholder="Full Name" value="{{old('name') ? old('name') : $user->name}}">
                        <div class="invalid-feedback">
                            {{$errors->first('name')}}
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username" id="name" placeholder="Username" value="{{$user->username}}" disabled>
                    </div>

                    <div class="form-group">
                      <label class="d-block">Roles</label>
                      <div class="form-check form-check-inline {{$errors->first('roles') ? 'is-invalid' : ''}}">
                        <input {{ in_array("ADMIN",json_decode($user->roles)) ? "checked" : "" }} class="form-check-input" type="checkbox" name="roles[]" id="ADMIN" value="ADMIN">
                        <label class="form-check-label" for="administrator">Administrator</label>
                      </div>
                      <div class="form-check form-check-inline {{$errors->first('roles') ? 'is-invalid' : ''}}">
                        <input {{ in_array("STAFF",json_decode($user->roles)) ? "checked" : "" }} class="form-check-input" type="checkbox" name="roles[]" id="STAFF" value="STAFF">
                        <label class="form-check-label" for="staff">Staff</label>
                      </div>
                      <div class="form-check form-check-inline {{$errors->first('roles') ? 'is-invalid' : ''}}">
                        <input {{ in_array("CUSTOMER",json_decode($user->roles)) ? "checked" : "" }} class="form-check-input" type="checkbox" name="roles[]" id="CUSTOMER" value="CUSTOMER">
                        <label class="form-check-label" for="customer">Customer</label>
                      </div>
                      <div class="invalid-feedback">
                        {{$errors->first('roles')}}
                      </div>
                    </div>

                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" class="form-control {{$errors->first('phone') ? 'is-invalid' : ''}}" name="phone" id="phone" placeholder="Phone Number" value="{{old('phone') ? old('phone') : $user->phone}}">
                        <div class="invalid-feedback">
                            {{$errors->first('phone')}}
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Address</label>
                        <textarea class="form-control {{$errors->first('address') ? 'is-invalid' : ''}}" name="address" id="address">{{old('address') ? old('address') : $user->address}}</textarea>
                        <div class="invalid-feedback">
                            {{$errors->first('address')}}
                        </div>
                    </div>

                    @if($user->avatar)
                    <img src="{{asset('storage/'.$user->avatar)}}" alt="" width="37">
                    @else
                    No Image
                    @endif
                    <div class="form-group">
                        <label>Avatar</label>
                        <input type="file" class="form-control" name="avatar" id="avatar">
                    </div>
                    <small class="text-muted">Kosongkan jika tidak ingin mengubah avatar</small>
                    <hr class="my-3">

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control {{$errors->first('email') ? 'is-invalid' : ''}}" name="email" id="email" placeholder="example@mail.com" value="{{old('email') ? old('email') : $user->email}}">
                        <div class="invalid-feedback">
                            {{$errors->first('email')}}
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control {{$errors->first('password') ? 'is-invalid' : ''}}" name="password" id="password">
                        <div class="invalid-feedback">
                            {{$errors->first('password')}}
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Password Confirmation</label>
                        <input type="password" class="form-control {{$errors->first('password_confirmation') ? 'is-invalid' : ''}}" name="password_confirmation" id="password_confirmation">
                        <div class="invalid-feedback">
                            {{$errors->first('password_confirmation')}}
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <div class="form-check form-check-inline">
                            <input {{$user->status=='ACTIVE' ? "checked" : ""}} class="form-check-input" type="radio" name="status" id="active" value="ACTIVE">
                            <label class="form-check-label" for="active">Active</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input {{$user->status=='INACTIVE' ? "checked" : ""}} class="form-check-input" type="radio" name="status" id="inactive" value="INACTIVE">
                            <label class="form-check-label" for="inactive">Inactive</label>
                        </div>
                    </div>
                    
                    <input type="submit" class="btn btn-primary" value="Save">
                </form>
            </div>
        </div>
    </div>
</div>

@endsection