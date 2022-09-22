@extends('admin.admin_master')
@section('admin')

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="card">
                        <img class="card-img-top mt-5" src="{{ asset('backend/assets/images/small/img-1.jpg') }}" style="width:20%;height=20%;margin:0 auto;"  alt="Card image cap">
                        <div class="card-body" style="margin:0 auto;">
                            <h4 class="card-title">Name - {{ $adminData -> name }}</h4>
                            <h4 class="card-title">Username - {{ $adminData -> username }}</h4>
                            <h4 class="card-title">Email - {{ $adminData -> email }}</h4>
                            
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection