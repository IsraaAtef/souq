
@extends('layout.dashboard')

@section('title', 'Product')



@section('content')
            <!--begin::App Content Header-->
            <div class="app-content-header">
                <!--begin::Container-->
                <div class="container-fluid">
                    <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Product</h3>
                        </div>
                        <div class="col-sm-12">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                    <!--end::Row-->
                </div>
                @if(session('success'))
                  <div class="alert alert-success">
                    {{ session('success')}}
                  </div>
                @endif
                @if(session('error'))
                  <div class="alert alert-danger">
                    {{ session('error')}}
                  </div>
                @endif
                <!--end::Container-->
            </div>
            <!--end::App Content Header-->
            <!--begin::App Content-->
            <div class="app-content">
                <!--begin::Container-->
                <div class="container-fluid">
                     <!--begin::Row-->
            <div class="row">
              <div class="col-md-12">
                <div class="card mb-4">
                  <div class="card-header bg-white py-3">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap=3">
                    <h3 class="card-title mb-0 fw-semibold">Products  Table</h3>
                    <div class="d-flex gap-2">
                    <form action="{{ route('dashboard.products.index') }}" method="GET" class="d-flex gap-2">
                      @csrf
                      <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Search Products....">
                      <button type="submit" class="btn btn-primary">Search</button>

                    </form>
                      <a href="{{ route('dashboard.products.create') }}" class="btn btn-success px-4">+ Add</a>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th style="width: 10px">#</th>
                          <th>Name</th>
                          <th>Price</th>
                          <th>Store</th>
                          <th>Category</th>
                          <th>Description</th>
                          <th style="width: 40px">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($products as $product)
                          <tr class="align-middle">
                          <td>{{ $product->id }}</td>
                          <td>
                           <img src="{{ $product->image_url  }}" height="50" alt="">  
                          {{ $product->name }}</td>
                          <td>
                             {{ $product->price}}     
                          </td>
                          <td>
                            {{ $product->store_id }}
                          </td>
                          <td>
                             {{ $product->category_id }}     
                          </td>
                          <td>
                             {{ $product->description}}     
                          </td>
                          <td class="d-flex gap-2">
                            <a href="{{ route('dashboard.products.edit', $product->id) }}" class="btn btn-info px-4">Edit</a>
                          
                          <form action="{{ route('dashboard.products.destroy',$product->id) }}" method="post" class="d-flex gap-2">
                            @csrf
                            @method('DELETE')
                          <button type="submit" class="btn btn-danger">DELETE</button>
                          </form>
                          </td>
                        </tr>  
                        @empty
                        <tr class="align-middle">
                          <td colspan="5">
                            لا يوجد منتجات
                          </td>
                        </tr>   
                        @endforelse
                                        
                      </tbody>
                    </table>
                  </div><!--
                 /.card-body
                  <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-end">
                      <li class="page-item">
                        <a class="page-link" href="#">&laquo;</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#">1</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#">2</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#">3</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#">&raquo;</a>
                      </li>
                    </ul>
                  </div>-->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
            </div>
                <!--end::Container-->
            </div>

            <!--end::App Content-->
            @if ($products->hasPages())
             <div class="card-footer clearfix">
            <div class="float-end">
                {{ $products->links() }}
            </div>

            @endif
          </div>
</div>


         

            @endsection
       