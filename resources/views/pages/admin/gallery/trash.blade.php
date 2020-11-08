@extends('layouts.admin')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Trashed Gallery</h1>
        </div>

        <div class="row">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Travel</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->travel_package->title }}</td>
                                    <td>
                                        <img src="{{ Storage::url($item->images) }}" alt="gambar" style="width: 150px" class="img-thumbnail">
                                    </td>
                                    <td>
                                        <a href="{{ route('gallery-restore', $item->id) }}" class="btn btn-info">
                                            <i class="fa fa-trash-restore"></i>
                                        </a>
                                        <a href="{{ route('gallery-kill', $item->id) }}" class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Data Kosong</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        

    </div>
    <!-- /.container-fluid -->
@endsection

@push('addon-script')
    <!-- Library Sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        const btnDeletes = document.querySelectorAll('.btn-danger')
        btnDeletes.forEach(btnDelete => {
            btnDelete.addEventListener('click', function (e) {
                e.preventDefault();
                const urlToRedirect = e.currentTarget.getAttribute('href')
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = urlToRedirect
                    }
                })
            })
        })

        @if (session('status') && session('status') === 'success')
            Swal.fire(
                "Deleted!",
                "Your item has been deleted.",
                "success"
            )
        @endif
    </script>
@endpush
