@extends("layouts.global")

@section("title")| Edit Book @endsection
@section("pageTitle")Edit Book @endsection

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
                <form action="{{route('books.update',['id'=>$book->id])}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Title" value="{{$book->title}}">
                    </div>

                    @if($book->cover)
                        <img src="{{asset('storage/'.$book->cover)}}" alt="" width="120px">
                    @else
                        N/A
                    @endif
                    <br>
                    <small class="text-muted">*Kosongkan jika tidak mengubah gambar</small>
                    <div class="form-group">
                        <label for="cover">Cover</label>
                        <input type="file" class="form-control" name="cover">
                    </div>

                    <div class="form-group">
                        <label for="title">Description</label>
                        <textarea name="description" class="form-control" placholder="Give a description about this Book">{{$book->description}}</textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select name="categories[]" multiple id="categories" class="form-control">
                            
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="number" class="form-control" name="stock" min="0" value="{{$book->stock}}">
                    </div>

                    <div class="form-group">
                        <label for="author">Author</label>
                        <input type="text" class="form-control" name="author" placeholder="Book Author" value="{{$book->author}}">
                    </div>

                    <div class="form-group">
                        <label for="publisher">Publisher</label>
                        <input type="text" class="form-control" name="publisher" placeholder="Publisher" value="{{$book->publisher}}">
                    </div>

                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" class="form-control" name="price" placeholder="Price" value="{{$book->price}}">
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option {{$book->status=='PUBLISH' ? 'selected' : '' }} value="PUBLISH">PUBLISH</option>
                            <option {{$book->status=="DRAFT" ? "selected" : ""}} value="DRAFT">DRAFT</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary" value="PUBLISH">Update</button>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section("footer-script")
<script>
    $("#categories").select2({
        ajax: {
            url: 'http://localhost/larashop/public/ajax/categories/search',
            processResults: function (data){
                return {
                    results: data.map(function(item){
                        return {id: item.id, text: item.name}
                    })
                }
            }
        }
    });

    var categories = {!! $book->categories !!}
        categories.forEach(function(category) {
            var option = new Option(category.name, category.id,true,true);
            $("#categories").append(option).trigger('change');
        });
</script>
@endsection