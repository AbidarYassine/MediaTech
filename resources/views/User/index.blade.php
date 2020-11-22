@extends('admin.include.default')
@section('style')
<style>
</style>
@endsection
@section('content')
<div class="col-md-12">
    <div class="row">
        <div class="col-md-6">
            <a data-toggle="modal" data-target="#Adduser" class="btn btn-success">
                <i class="fas fa-plus fa-1x mr-1"></i>Add new User
            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-header bg-primary text-white">All Users</div>
        <div class="card-body">
            <table id="table_user" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>email</th>
                        <th>Created_at</th>
                        <th class="text-center">Action</th>
                    </tr>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->created_at}}</td>
                        <td>
                            <a class="btn_delete btn btn-danger btn-sm" href="{{route('user.delete',$user->id)}}">delete</a>
                            <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editUser" data-id="{{$user->id}}" data-name="{{$user->name}}" data-email="{{$user->email}}">edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
@include('User.include.addUser')
@section('script')
<script>
    $(document).ready(function() {
        let item1 = '<li class="breadcrumb-item active">User</li>';
        var item2 = '<li class="breadcrumb-item active">Index</li>';
        $("#list_breadcrumb").append(item1);
        $("#list_breadcrumb").append(item2);

        // $(document).on('submit', '#form_add_user', function(e) {
        //     e.preventDefault();
        //     let name = $("#name").val();
        //     let email = $("#email").val();
        //     let password = $("#password").val();

        //     $.ajax({
        //         url: "{{route('user.store')}}",
        //         method: "POST",
        //         data: {
        //             '_token': "{{csrf_token()}}",
        //             "name": name,
        //             'email': email,
        //             'password': password,
        //         },
        //         success: function(data) {
        //             console.log(data);
        //         },
        //         error: function(reject) {
        //             console.log(reject);
        //             var response = $.parseJSON(reject.responseText);
        //             $.each(response.errors, function(key, val) {
        //                 $("#" + key + "_error").text(val[0]);
        //             });
        //         },
        //     });
        // });
        $("#table_user").DataTable();

        $('.btn_delete').on('click', function(event) {
            event.preventDefault();
            const url = $(this).attr('href');
            console.log(url);
            Swal.fire({
                title: 'Are you shure to delete User ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'delete'
            }).then((result) => {
                if (result.value) {
                    window.location.href = url;
                    Swal.fire(
                        'deleting!',
                        'User has been deleted successfly',
                        'success'
                    )
                }
            })
        });
    });
</script>
@endsection
