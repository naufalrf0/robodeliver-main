<x-admin-layout :title="'Manajemen Merchant - Robodeliver'" :metaDescription="'Manajemen Merchant Admin Robodeliver.'">
    <div class="container-fluid">
        {{-- Merchant Counts --}}
        <div class="row mb-3">
            <div class="col-xl-6 col-sm-12 mb-3">
                <div class="card text-white bg-success o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fa fa-fw fa-store"></i>
                        </div>
                        <div class="mr-5">
                            <h5>Total Merchant: {{ $totalMerchants }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-sm-12 mb-3">
                <div class="card text-white bg-warning o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fa fa-fw fa-hourglass-half"></i>
                        </div>
                        <div class="mr-5">
                            <h5>Merchant Pending: {{ $pendingMerchants }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Merchant Table --}}
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5>Manajemen Merchant</h5>
            </div>
            <div class="card-body">
                @if ($merchants->isEmpty())
                    <p class="text-center">Tidak ada data merchant.</p>
                @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Merchant</th>
                                <th>Alamat</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($merchants as $merchant)
                                <tr>
                                    <td>{{ $merchant->name }}</td>
                                    <td>{{ $merchant->address }}</td>
                                    <td>
                                        @if ($merchant->status === 'pending')
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @elseif ($merchant->status === 'active')
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-danger">Ditolak</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.merchants.show', $merchant->id) }}" class="btn btn-info btn-sm">Detail</a>

                                        @if ($merchant->status === 'pending')
                                            {{-- Accept Button --}}
                                            <form action="{{ route('admin.merchants.accept', $merchant->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">Terima</button>
                                            </form>

                                            {{-- Reject Button --}}
                                            <form action="{{ route('admin.merchants.reject', $merchant->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $merchants->links() }}
                @endif
            </div>
        </div>
    </div>
</x-admin-layout>
