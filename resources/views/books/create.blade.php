@extends("layouts.global")

@section("title")| Create Books @endsection
@section("pageTitle") Create Books @endsection

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
                <form action="{{route('books.store')}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Title">
                    </div>

                    <div class="form-group">
                        <label for="cover">Cover</label>
                        <input type="file" class="form-control" name="cover">
                    </div>

                    <div class="form-group">
                        <label for="title">Description</label>
                        <textarea name="description" class="form-control" placholder="Give a description about this Book"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select name="categories[]" multiple id="categories" class="form-control">

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="number" class="form-control" name="stock" min="0" value="0">
                    </div>

                    <div class="form-group">
                        <label for="author">Author</label>
                        <input type="text" class="form-control" name="author" placeholder="Book Author">
                    </div>

                    <div class="form-group">
                        <label for="publisher">Publisher</label>
                        <input type="text" class="form-control" name="publisher" placeholder="Publisher">
                    </div>

                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" class="form-control" name="price" placeholder="Price">
                    </div>

                    <button class="btn btn-primary" name="save_action" value="PUBLISH">Publish</button>
                    <button class="btn btn-secondary" name="save_action" value="DRAFT">Save as Draft</button>

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
</script>
@endsection