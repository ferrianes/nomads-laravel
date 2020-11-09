@extends('layouts.admin')

@section('title', 'Galeri')
    
@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Gallery</h1>
            <a href="{{ route('gallery-trash') }}" class="btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-trash fa-sm text-white-50"></i> Recycle Bin Gallery
            </a>
            <a href="{{ route('gallery.create') }}" class="btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Gallery
            </a>
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
                                        <a href="{{ route('gallery.edit', $item->id) }}" class="btn btn-info">
                                            <i class="fa fa-pencil-alt"></i>
                                        </a>
                                        <form action="{{ route('gallery.destroy', $item->id) }}" method="POST" class="d-inline delete">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
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
    <script>
        const btnDeletes = document.querySelectorAll('.btn-danger')
        btnDeletes.forEach(btnDelete => {
            btnDelete.addEventListener('click', function (e) {
                e.preventDefault();
                const form = this.parentElement
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You will move this item to trash",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit()
                    }
                })
            })
        })

        @switch(session('status'))
            @case('delete-success')
                Swal.fire(
                    "Deleted!",
                    "Your item has been moved to trash.",
                    "success"
                )
                @break
            @case('edit-success')
                Swal.fire(
                    "Edited!",
                    "Your item has been edited.",
                    "success"
                )
                @break
            @case('add-success')
                Swal.fire(
                    "Added!",
                    "Your item has been added.",
                    "success"
                )
                @break
            @default
                
        @endswitch
    </script>
@endpush
