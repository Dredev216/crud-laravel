@extends('master')

@section('content')


<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" name="usr_delete" id="usr_delete" />
                <h5> Are you sure you want to delete this user? </h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary">Yes</button>
            </div>
        </div>
    </div>
</div>


<div>
    <div>
        <a href="{{ route ('students.create') }}" class="text-light">
            <button class="btn btn-danger fs-5 btn-lg my-5 mx-4"> Add user </button>
        </a>
    </div>

    <div class="input-group mb-4 w-50 mx-4">
        <button class="btn btn-danger text-light sm-4 btn-lg" type="button" id="searchbtn">Search</button>
        <input id="search" type="text" class="form-control" placeholder="Search..." aria-describedby="search">
    </div>
</div>
<div class="container">
    <table class="table mx-4 fs-5">
        <thead>
            <tr>
                <th scope="col"> Sr No. </th>
                <th scope="col"> Name </th>
                <th scope="col"> Email </th>
                <th scope="col"> Number </th>
                <th scope="col"> Action </th>
            </tr>
        </thead>
        <tbody id="displayTable">
            @if(count($data) > 0)
            @foreach ($data as $row)
            <tr>
                <td>{{ $row -> id }}</td>
                <td>{{ $row -> std_name }}</td>
                <td>{{ $row -> std_email }}</td>
                <td>{{ $row -> std_number }}</td>
                <td>
                    <a href="{{ route('students.edit', $row->id) }}" class="btn btn-success text-light fw-bold">Edit</a>
                    @method('Delete')
                    <button type="submit" class="btn btn-danger text-light fw-bold" onclick="deleteData('{{ $row -> id }}')">
                        Delete
                    </button>
            </tr>
            @endforeach
            @else

            <div class="d-flex justify-content-center text-danger fw-bolder fs-4 mb-4">
                No data found...
            </div>

            @endif
        </tbody>
    </table>
</div>
{!! $data -> links() !!}

@endsection

@section('scripts')

<script>
    $(document).ready(function() {
        $("#search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#displayTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

    function deleteData(data) {
        Swal.fire({
            title: 'Are you sure?',
            text: "User " + data + " wil be deleted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {

                let url = "{{ route('students.destroy', ':id') }}"
                url = url.replace(':id', data)

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                        '_method': "DELETE",
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function() {
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success',
                            $(location).prop('href', '{{ route("students.index") }}')
                        )
                    }
                })


            }
        })
    }
</script>

@endsection