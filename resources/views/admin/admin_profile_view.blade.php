@extends('admin.admin_master')
@section('admin')

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="card">
                        <img class="mt-5 card-img-top" src="{{ (!empty($adminData->profile_image)) ? url('upload/admin_images/'.$adminData->profile_image) : url('upload/admin_images/default.png') }}" style="width:20%;height=20%;margin:0 auto;" alt="Card image cap">
                        <div class="card-body" style="margin:0 auto;">
                            <h4 class="card-title">Name - {{ $adminData -> name }}</h4>
                            <h4 class="card-title">Username - {{ $adminData -> username }}</h4>
                            <h4 class="card-title">Email - {{ $adminData -> email }}</h4>
                            <a href="{{ route('edit.profile',$adminData->id) }}" class="btn btn-primary btn-sm" >Edit</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    
@endsection