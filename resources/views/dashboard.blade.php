<x-admin-layout :title="'Dashboard - Robodeliver'" :metaDescription="'Temukan makanan dan restoran terbaik bersama Robodeliver.'" :metaAuthor="'Robodeliver Inc.'">
    <div class="container-fluid">
        <div class="row">
            @role('merchant')
                <div class="card mb-4">
                    <div class="card-body">
                        <h4>Welcome, {{ $merchant->name }}!</h4>
                        <p>
                            Your merchant status is
                            @if ($merchant->status === 'active')
                                <span class="badge bg-success">Active</span>.
                            @elseif ($merchant->status === 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>.
                            @else
                                <span class="badge bg-danger">Rejected</span>.
                            @endif
                        </p>
                    </div>
                </div>

                {{-- Summary Cards --}}
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <h5>Balance</h5>
                                <h3>Rp{{ number_format($balance, 0, ',', '.') }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <h5>Total Products</h5>
                                <h3>{{ $totalProducts }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-info text-white">
                            <div class="card-body">
                                <h5>Total Orders</h5>
                                <h3>{{ $merchantOrders }}</h3>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Products Table --}}
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5>Your Products</h5>
                    </div>
                    <div class="card-body">
                        @if ($products->isEmpty())
                            <p class="text-center">You have not added any products yet.</p>
                        @else
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                                            <td>{{ Str::limit($product->description, 50) }}</td>
                                            <td>
                                                <a href="{{ route('merchant.products.edit', $product->id) }}"
                                                    class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('merchant.products.destroy', $product->id) }}"
                                                    method="POST" class="d-inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif

                        {{-- Pagination --}}
                        <div class="mt-3">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            @endrole

            @role('admin')
                {{-- Admin Dashboard --}}
                <div class="row mb-4">
                    {{-- Summary Cards --}}
                    <div class="col-md-3">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <h5>Total Users</h5>
                                <h3>{{ $totalUsers }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <h5>Total Orders</h5>
                                <h3>{{ $totalOrders }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-info text-white">
                            <div class="card-body">
                                <h5>Total Merchants</h5>
                                <h3>{{ $totalMerchants }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-warning text-dark">
                            <div class="card-body">
                                <h5>Pending Merchants</h5>
                                <h3>{{ $pendingMerchants }}</h3>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Latest Merchants --}}
                <div class="card mt-4">
                    <div class="card-header bg-primary text-white">
                        <h5>Latest Merchants</h5>
                    </div>
                    <div class="card-body">
                        @if ($merchants->isEmpty())
                            <p class="text-center">No merchants found.</p>
                        @else
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($merchants as $merchant)
                                        <tr>
                                            <td>{{ $merchant->id }}</td>
                                            <td>{{ $merchant->name }}</td>
                                            <td>{{ $merchant->address }}</td>
                                            <td>
                                                @if ($merchant->status === 'active')
                                                    <span class="badge bg-success">Active</span>
                                                @elseif ($merchant->status === 'pending')
                                                    <span class="badge bg-warning text-dark">Pending</span>
                                                @else
                                                    <span class="badge bg-danger">Rejected</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.merchants.show', $merchant->id) }}"
                                                    class="btn btn-info btn-sm">Details</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif

                        {{-- Pagination --}}
                        <div class="mt-3">
                            {{ $merchants->links() }}
                        </div>
                    </div>
                </div>
            @else
                {{-- Message if not admin --}}
                <div class="alert alert-danger">
                    <p>You do not have access to this dashboard.</p>
                </div>
            @endrole


            {{-- Customer Dashboard --}}
            @role('customer')
                {{-- Merchant Status Card --}}
                @if ($merchant)
                    <div class="col-xl-12 col-sm-12 mb-3">
                        <div class="card">
                            <div class="card-body">
                                @if ($merchant->status === 'pending')
                                    <h5 class="card-title">Status Merchant</h5>
                                    <p class="card-text text-warning">Status pengajuan merchant Anda sedang ditinjau. Mohon
                                        tunggu informasi selanjutnya.</p>
                                @elseif ($merchant->status === 'active')
                                    <h5 class="card-title">Status Merchant</h5>
                                    <p class="card-text text-success">Merchant Anda sudah aktif! Kelola merchant Anda
                                        melalui
                                        dashboard.</p>
                                    <a href="{{ route('merchant.dashboard') }}" class="btn btn-primary">Kelola Merchant</a>
                                @elseif ($merchant->status === 'rejected')
                                    <h5 class="card-title">Status Merchant</h5>
                                    <p class="card-text text-danger">Pengajuan merchant Anda ditolak. Silakan periksa alasan
                                        penolakan dan ajukan kembali.</p>
                                    <a href="{{ route('merchant.edit', $merchant->id) }}" class="btn btn-warning">Ajukan
                                        Ulang</a>
                                @else
                                    <p class="card-text">Status merchant Anda tidak diketahui. Silakan hubungi tim dukungan
                                        untuk informasi lebih lanjut.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
                {{-- Balance Card --}}
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card dashboard text-white bg-primary o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fa fa-fw fa-wallet"></i>
                            </div>
                            <div class="mr-5">
                                <h5>Saldo: Rp{{ number_format($wallet->balance ?? 0, 0, ',', '.') }}</h5>
                            </div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="#" data-bs-toggle="modal"
                            data-bs-target="#topUpModal">
                            <span class="float-left">Top-Up Saldo</span>
                            <span class="float-right">
                                <i class="fa fa-angle-right"></i>
                            </span>
                        </a>
                    </div>
                </div>

                {{-- Recent Transactions Card --}}
                <div class="col-xl-8 col-sm-12 mb-3">
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <h5 class="text-white">Transaksi Terbaru</h5>
                        </div>
                        <div class="card-body">
                            @if ($transactions->isEmpty())
                                <p class="text-center">Belum ada transaksi.</p>
                            @else
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Jenis Transaksi</th>
                                            <th>Jumlah</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transactions as $transaction)
                                            <tr>
                                                <td>{{ $transaction->created_at->format('d M Y, H:i') }}</td>
                                                <td>
                                                    @if ($transaction->transaction_type === 'top_up')
                                                        <span class="badge bg-primary">Top-Up</span>
                                                    @elseif ($transaction->transaction_type === 'payment')
                                                        <span class="badge bg-info">Pembayaran</span>
                                                    @elseif ($transaction->transaction_type === 'refund')
                                                        <span class="badge bg-secondary">Pengembalian Dana</span>
                                                    @endif
                                                </td>
                                                <td>Rp{{ number_format($transaction->amount, 0, ',', '.') }}</td>
                                                <td>
                                                    @if ($transaction->transaction_status === 'success')
                                                        <span class="badge bg-success">Berhasil</span>
                                                    @elseif ($transaction->transaction_status === 'pending')
                                                        <span class="badge bg-warning text-dark pending-transaction"
                                                            data-bs-toggle="modal" data-bs-target="#qrCodeModal"
                                                            data-reference="{{ $transaction->reference }}">
                                                            Menunggu
                                                        </span>
                                                    @elseif ($transaction->transaction_status === 'failed')
                                                        <span class="badge bg-danger">Gagal</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            @endrole
        </div>

        {{-- Modal for Top-Up --}}
        @role('customer')
            <div class="modal fade" id="topUpModal" tabindex="-1" aria-labelledby="topUpModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="topUpModalLabel">Top-Up Saldo</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="topUpForm">
                                @csrf
                                <div class="form-group">
                                    <label for="topUpAmount">Masukkan Nominal</label>
                                    <input type="number" class="form-control" id="topUpAmount" name="amount"
                                        placeholder="e.g. 100000" required>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3 w-100">Generate QR Code</button>
                            </form>
                            <div id="qrCodeContainer" class="text-center mt-4" style="display: none;">
                                <h5>Scan atau Klik QR Code</h5>
                                <a id="qrCodeLink" href="#" target="_blank">
                                    <img id="qrCodeImage" src="" alt="QR Code"
                                        style="max-width: 100%; height: auto;">
                                </a>
                                <p id="qrCodeMessage" class="mt-3"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endrole

        {{-- QR Code Modal for Pending Transactions --}}
        <div class="modal fade" id="qrCodeModal" tabindex="-1" aria-labelledby="qrCodeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="qrCodeModalLabel">QR Code Pembayaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <div id="qrCodeContainer">
                            <img id="qrCodePendingImage" src="" alt="QR Code"
                                style="max-width: 100%; height: auto;">
                        </div>
                        <a id="qrCodePendingLink" href="#" target="_blank" class="btn btn-primary mt-3">Bayar
                            Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle QR Code Generation for Pending Transactions
            const pendingTransactions = document.querySelectorAll('.pending-transaction');
            pendingTransactions.forEach(transaction => {
                transaction.addEventListener('click', async function() {
                    const reference = this.getAttribute('data-reference');
                    try {
                        const response = await fetch(`{{ url('/payment/qr/') }}/${reference}`);
                        const data = await response.json();
                        if (data.status === 'success') {
                            const qrImage =
                                'https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=' +
                                encodeURIComponent(data.qrData);
                            document.getElementById('qrCodePendingImage').src = qrImage;
                            document.getElementById('qrCodePendingLink').href = data.qrData;
                        } else {
                            alert(data.message || 'Gagal memuat QR Code.');
                        }
                    } catch (error) {
                        console.error('Error fetching QR code:', error);
                        alert('Terjadi kesalahan saat memuat QR Code.');
                    }
                });
            });

            // Handle QR Code Generation for Top-Up
            document.getElementById('topUpForm').addEventListener('submit', async function(event) {
                event.preventDefault();
                const amountInput = document.getElementById('topUpAmount').value;
                if (!amountInput || parseInt(amountInput) < 1000) {
                    alert('Nominal minimal adalah Rp1.000.');
                    return;
                }
                try {
                    const response = await fetch('{{ route('topup.generate') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({
                            amount: amountInput
                        }),
                    });
                    const data = await response.json();
                    if (data.status === 'success') {
                        const qrImage =
                            'https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=' +
                            encodeURIComponent(data.qrData);
                        document.getElementById('qrCodeImage').src = qrImage;
                        document.getElementById('qrCodeLink').href = data.qrData;
                        document.getElementById('qrCodeContainer').style.display = 'block';
                    } else {
                        alert(data.message || 'Gagal menghasilkan QR Code.');
                    }
                } catch (error) {
                    console.error('Error generating QR Code:', error);
                    alert('Terjadi kesalahan saat menghasilkan QR Code.');
                }
            });
        });
    </script>
</x-admin-layout>
