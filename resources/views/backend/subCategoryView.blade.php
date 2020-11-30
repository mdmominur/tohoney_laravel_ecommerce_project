@extends('backend.master')
@section('content')
    <h4 class="header-title mb-4">View sub category Page</h4>
    <p style="color:red">
        @if(session('delete'))
            {{session('delete')}}
        @endif
    </p>
    <p style="color:green">
        @if(session('msg'))
            {{session('msg')}}
        @endif
    </p>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">Serial</th>
            <th scope="col">Sub Category name</th>
            <th scope="col">Category</th>
            <th scope="col">Created At</th>
            <th colspan="10" scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @forelse($subCat as $key => $sub_cat)
            <tr>
                <td>{{$subCat->firstItem() + $key}}</td>
                <td>{{$sub_cat->subCategory}}</td>
                <td>{{$sub_cat->getCategories->Category_name ?? 'Category not found'}}</td>
                <td>{{$sub_cat->created_at}}</td>
                <td>{{$sub_cat->created_at}}</td>
                <td><a class="btn btn-primary" href="{{url('subCategoryUpdate')}}\{{$sub_cat->id}}">Edit</a></td>
                <td><a class="btn btn-danger" href="{{url('subCategoryDelete')}}\{{$sub_cat->id}}">Delete</a></td>
            </tr>
        @empty
            <tr>
                <td colspan="10">No Data Available</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    {{$subCat->links()}}

@endsection
