@extends('layouts.admin')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Ubah Status Transaksi An. {{ $item->name }}</h1>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('transaction.update', $item->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    @if ($item->transaction_status === 'PENDING')
                        <div class="form-group">
                            <label for="transaction_status">Status</label>
                            <input type="text" class="form-control" name="transaction_status" placeholder="transaction_status" value="{{ $item->transaction_status }}" id="transaction_status" disabled>
                        </div>
                    @else
                        <div class="form-group">
                            <label for="transaction_status">Status</label>
                            <select id="transaction_status" name="transaction_status" class="form-control" required>
                                <option value="IN_CART" {{ $item->transaction_status ==='IN_CART' ? 'selected' : '' }}>IN CART</option>
                                <option value="PENDING" {{ $item->transaction_status ==='PENDING' ? 'selected' : '' }}>Pending</option>
                                <option value="SUCCESS" {{ $item->transaction_status ==='SUCCESS' ? 'selected' : '' }}>Success</option>
                                <option value="CANCEL" {{ $item->transaction_status ==='CANCEL' ? 'selected' : '' }}>Cancel</option>
                                <option value="FAILED" {{ $item->transaction_status ==='FAILED' ? 'selected' : '' }}>Failed</option>
                            </select>
                        </div>
                    @endif
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fas fa-fw fa-save"></i> Ubah
                    </button>
                </form>
            </div>
        </div>

        

    </div>
    <!-- /.container-fluid -->
@endsection
