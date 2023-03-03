@extends ('master')

@section ('content')

<div>
    <div>
        <a href="{{ route('students.store') }}" class="text-light">
            <button class="btn btn-danger fs-5 btn-lg my-4 mx-3">
                << </button>
        </a>
    </div>

    <div class="mx-4">
        <h2> Update </h2>
    </div>

    <div class="container my-5 fs-5 fw-bold">
        <form method="post" action="{{ route('students.update', $student->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-5">
                <label>Name</label>
                <div>
                    <input type="text" name="upd_name" class="form-control" autocomplete="off" placeholder="Enter your first name" value="{{ $student->std_name }}" />
                </div>
                <span class="fs-6 text-danger fst-italic">
                    @error('std_name')

                    {{$message}}

                    @enderror
                </span>
            </div>
            <div class="mb-5">
                <label>Email</label>
                <div>
                    <input type="text" name="upd_email" class="form-control" autocomplete="off" placeholder="Enter your email" value="{{ $student->std_email }}" />
                </div>
                <span class="fs-6 text-danger fst-italic">
                    @error('std_email')

                    {{$message}}

                    @enderror
                </span>
            </div>
            <div class="mb-5">
                <label>Number</label>
                <div>
                    <input type="number" name="upd_number" class="form-control" autocomplete="off" placeholder="123 456 7890" value="{{ $student->std_number }}" />
                </div>
                <span class="fs-6 text-danger fst-italic">
                    @error('std_number')

                    {{$message}}

                    @enderror
                </span>
            </div>
            <div class="mb-5">
                <label>Password</label>
                <div>
                    <input type="password" name="upd_password" class="form-control" autocomplete="off" placeholder="Enter a password" />
                </div>
                <span class="fs-6 text-danger fst-italic">
                    @error('std_password')

                    {{$message}}

                    @enderror
                </span>
            </div>
            <div class="mb-5">
                <input type="hidden" name="hidden_id" value="{{ $student->id }}" />
                <input type="submit" value="Submit" class="btn btn-danger fs-4 btn-lg" />
            </div>
        </form>
    </div>
</div>


@endsection('content')