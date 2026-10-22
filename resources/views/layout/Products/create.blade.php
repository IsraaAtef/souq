
@extends('layout.dashboard')

@section('title', 'Product Create')



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
                <!--begin::Quick Example-->
                <div class="card card-primary card-outline mb-4">
                  <!--begin::Header-->
                  <div class="card-header">
                    <div class="card-title">Product Create</div>
                  </div>
                  <!--end::Header-->
                  <!--begin::Form-->
                  <form action="{{ route('dashboard.products.store') }}" method="post">
                    <!--begin::Body-->
                    @csrf
                    <div class="card-body">
                      @include('layout.products._form')
                    </div>
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <!--end::Footer-->
                  </form>
                  <!--end::Form-->
                </div>
                </div>
                <!--end::Container-->
            </div>

          </div>
</div>


         

            @endsection
       