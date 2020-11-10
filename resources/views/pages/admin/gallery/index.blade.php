@extends('layouts.admin')

@section('title', 'Galeri')
    
@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-flex align-items-center justify-content-center mb-3 flex-wrap">
            <div class="mr-auto mb-3 mb-md-2">
                <h1 class="h3 mb-0 text-gray-800">Gallery</h1>
            </div>
            <div class="mb-3 mb-md-2">
                <form action="{{ route('gallery.index') }}" method="GET" class="form-inline">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Show</span>
                        </div>
                        <input type="number" class="form-control" placeholder="Input limit..." name="limit" autocomplete="off" min="1" value="{{ $limit ?? '' }}">
                        <input type="text" class="form-control" placeholder="Search item..." name="s" autocomplete="off" value="{{ $search ?? '' }}">
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary" type="submit" id="button-addon2"><i class="fas fa-fw fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="mx-md-2 mb-3 mb-md-2">
                <a href="{{ route('gallery-trash') }}" class="btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-trash fa-sm text-white-50"></i> Recycle Bin Gallery
                </a>
            </div>
            <div class="mb-md-2">
                <a href="{{ route('gallery.create') }}" class="btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Gallery
                </a>
            </div>
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
                    {{ $items->links() }}
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
