@extends('layouts.admin')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Ubah Galeri {{ $item->travel_package->title }}</h1>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('gallery.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="title">Paket Travel</label>
                        <input type="text" class="form-control" value="{{ $item->travel_package->title }}" id="title" disabled>
                        <input type="hidden" name="travel_packages_id" value="{{ $item->travel_packages_id }}">
                    </div>
                    <div class="form-group">
                        <label for="customFile">Image</label>
                        <div class="custom-file">
                            <input type="file" name="images" class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile">Choose Image</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fas fa-fw fa-save"></i> Ubah
                    </button>
                </form>
            </div>
        </div>

        

    </div>
    <!-- /.container-fluid -->
@endsection

@push('addon-script')
    <script>
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });

        @if ($errors->any())
            Swal.fire(
                "Failed!",
                "Your item has been failed to edit.",
                "error"
            )
        @endif
    </script>
@endpush

