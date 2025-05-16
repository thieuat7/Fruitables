<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ secure_asset('css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(() => {
        const avatarFile = $("#avatarFile");
        avatarFile.change(function(e) {
            const imgURL = URL.createObjectURL(e.target.files[0]);
            $("#avatarPreview").attr("src", imgURL).css("display", "block");
        });
    });
    </script>
</head>

<body class="sb-nav-fixed">
    @extends('admin.layout.header')

    <div id="layoutSidenav">
        @extends('admin.layout.sidebar')
        <div id="layoutSidenav_content">
            <div class="container-fluid px-4">
                <h1 class="mt-4">Manage User</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active"><a href="/admin">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="/admin/user">User</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
                <div class=" mt-5">
                    <div class="row">
                        <div class="col-md-6 col-12 mx-auto">
                            <h3>Create a User</h3>
                            <hr />
                            <form method="post" action="/admin/user/create" enctype="multipart/form-data"
                                class="row g-3 p-3">
                                @csrf
                                <div class="col-md-6">
                                    <label for="user_email" class="form-label">Email:</label>
                                    <input type="email" class="form-control @error('user_email') is-invalid @enderror"
                                        id="user_email" name="user_email" placeholder="Nhập email">
                                    @error('user_email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="user_password" class="form-label">Password:</label>
                                    <input type="password"
                                        class="form-control @error('user_password') is-invalid @enderror"
                                        id="user_password" name="user_password" placeholder="Nhập mật khẩu">
                                    @error('user_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="user_phone" class="form-label">Phone number:</label>
                                    <input type="text" class="form-control" id="user_phone" name="user_phone"
                                        placeholder="Nhập số điện thoại">
                                </div>

                                <div class="col-md-6">
                                    <label for="user_name" class="form-label">Full name:</label>
                                    <input type="text" class="form-control @error('user_name') is-invalid @enderror"
                                        id="user_name" name="user_name" placeholder="Nhập họ và tên">
                                    @error('user_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <label for="user_address" class="form-label">Address:</label>
                                    <input type="text" class="form-control" id="user_address" name="user_address"
                                        placeholder="Nhập địa chỉ">
                                </div>

                                <div class="col-md-6">
                                    <label for="user_role" class="form-label">Role:</label>
                                    <select class="form-select" id="user_role" name="user_role">
                                        <option value="1">ADMIN</option>
                                        <option value="3">USER</option>
                                        <option value="2">SHIPPED</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="avatarFile" class="form-label">Avatar:</label>
                                    <input class="form-control" type="file" id="avatarFile" name="user_avatar"
                                        accept=".png, .jpg, .jpeg">
                                </div>
                                <div class="col-12 mt-3 text-center">
                                    <img id="avatarPreview" src="" alt="Avatar Preview"
                                        style="display: none; max-width: 100%; max-height: 400px; border-radius: 8px;">
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @extends('admin.layout.footer')
        </div>



    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>

    <script src="{{ secure_asset('js/scripts.js') }}"></script>
    <script src="{{ secure_asset('js/chart-area-demo.js') }}"></script>
    <script src="{{ secure_asset('js/chart-bar.js') }}"></script>
    <script src="{{ secure_asset('js/datatables-simple-demo.js') }}"></script>


</html>