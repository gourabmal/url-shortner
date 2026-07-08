@extends('common.layout.admin_layout')
@section('content')
    <div class="content-wrapper" style="min-height: 357px;">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Site Information</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('superadmin.dashboard')}}">Dashboard</a> </li>
                            <li class="breadcrumb-item">CMS </li>
                            <li class="breadcrumb-item "><a href="{{route('superadmin.information')}}">Site Information</a></li>
                            <li class="breadcrumb-item active">@if(empty($siteInfo)) Add @else Edit @endif</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        @include('messages')
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">@if(empty($siteInfo)) Add @else Edit @endif</h3>
                            </div>
                            <form action="{{route('superadmin.information_save')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                                {{csrf_field()}}
                                <input type="hidden" name="id" value="{{$siteInfo['id']}}">
                                <div class="card-body">
                                    @if(!empty($siteInfo) && $siteInfo['is_image'] == 'Yes')
                                        <div class="form-group" id="show_image_div">
                                            <label for="exampleInputEmail1">Preview Image</label>
                                            <img src="{{ $siteInfo['image_url'] }}" id="image_show" style="width: 120px;height: 50px;">
                                        </div>
                                    @endif
                                    <div class="form-group" style="display: none;">
                                        <label for="exampleInputEmail1">Key</label>
                                        <input type="text" class="form-control" name="key" id="exampleInputEmail1" placeholder="Enter Key" value="{{$siteInfo['key']}}" @if(!empty($siteInfo)) readonly @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Title</label>
                                        <input type="text" class="form-control" name="title" id="exampleInputEmail1" placeholder="Enter Title" value="{{$siteInfo['title']}}" @if(!empty($siteInfo)) readonly @endif>
                                    </div>
                                    @if(!empty($siteInfo) && $siteInfo['is_image'] == 'No')
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Value</label>
                                            <input type="text" class="form-control" name="value" id="exampleInputEmail1" @if(!empty($siteInfo) && $siteInfo['is_image'] == 'No') value="{{$siteInfo['value']}}" @endif placeholder="Enter Value">
                                        </div>
                                    @endif
                                    @if(!empty($siteInfo) && $siteInfo['is_image'] == 'Yes')
                                        <div class="form-group">
                                            <label for="exampleInputFile">Image</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="image" id="exampleInputFile" onchange="base64Img(this);">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    </div>
    @push('scripts')
        <script>
            /*** Image Value Start ***/
            showHide = (value) => {
                if (value == 'Yes'){
                    document.getElementById('image_div').style.display = 'block';
                    document.getElementById('value_div').style.display = 'none';
                }else {
                    document.getElementById('image_div').style.display = 'none';
                    document.getElementById('value_div').style.display = 'block';
                }
            }
            /*** Image Value End ***/
        </script>
    @endpush
@endsection
