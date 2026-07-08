@extends('common.layout.admin_layout')
@section('content')
    <style>
        .card-footer{
            text-align: end;
        }
    </style>
    <div class="content-wrapper" style="min-height: 1342.88px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Profile</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-5 col-sm-3">
                        <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link @if($session['password'] == false) active @endif" id="vert-tabs-profile-tab" data-toggle="pill" href="#vert-tabs-profile" role="tab" aria-controls="vert-tabs-profile" aria-selected="false">Profile</a>
                            <a class="nav-link @if($session['password'] == true) active @endif" id="vert-tabs-messages-tab" data-toggle="pill" href="#vert-tabs-messages" role="tab" aria-controls="vert-tabs-messages" aria-selected="false">Update Password</a>
                        </div>
                    </div>
                    <div class="col-7 col-sm-9">
                        <div class="tab-content" id="vert-tabs-tabContent">
                            @include('messages')
                            <div class="tab-pane fade show @if($session['password'] == false) show active @endif" id="vert-tabs-profile" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">
                                <form action="{{route('common.profile_update')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                                    {{csrf_field()}}
                                    <div class="card-body">
                                        <div class="form-group" id="show_image_div">
                                            <label for="exampleInputEmail1">Preview Image</label>
                                            <img src="{{ $user->image_url }}" id="image_show" alt="No Profile Picture Found" style="width: 150px;height: 150px;object-fit: cover;">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputFile">Profile Picture</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="image" id="exampleInputFile" onchange="base64Img(this);">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">First Name</label>
                                            <input type="text" class="form-control" name="first_name" id="exampleInputEmail1" placeholder="Enter Name" value="{{$user['first_name']}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Last Name</label>
                                            <input type="text" class="form-control" name="last_name" id="exampleInputEmail1" placeholder="Enter Name" value="{{$user['last_name']}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email</label>
                                            <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Enter email" value="{{$user['email']}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Phone</label>
                                            <input type="text" class="form-control" name="phone" id="exampleInputPassword1" placeholder="Phone" value="{{$user['phone']}}">
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-success">UPDATE</button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade @if($session['password'] == true) show active @endif" id="vert-tabs-messages" role="tabpanel" aria-labelledby="vert-tabs-messages-tab">
                                <form action="{{route('common.password_update')}}" method="post">
                                    {{csrf_field()}}
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Old Password</label>
                                            <input type="text" class="form-control" name="old_password" id="exampleInputEmail1" placeholder="Enter Old Password">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">New Password</label>
                                            <input type="text" class="form-control" name="new_password" id="exampleInputEmail1" placeholder="Enter New Password">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Confirm Password</label>
                                            <input type="text" class="form-control" name="confirm_password" id="exampleInputPassword1" placeholder="Enter Confirm Password">
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-success">UPDATE</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @push('scripts')
        <script>
            window.onload = passwordTab();
            function passwordTab() {
                var session = '<?php echo json_encode($session) ?>';
                var data = JSON.parse(session);
                if (data.password_error != null || data.password_success != null){
                    $("#vert-tabs-messages-tab").addClass('active');
                    $("#vert-tabs-profile-tab").removeClass('active');
                    $("#vert-tabs-messages").addClass('show');
                    $("#vert-tabs-profile").removeClass('show');
                    $("#vert-tabs-messages").addClass('active');
                    $("#vert-tabs-profile").removeClass('active');
                }
            }
        </script>
    @endpush
@endsection
