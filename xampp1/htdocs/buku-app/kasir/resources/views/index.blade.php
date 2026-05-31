@extends('layouts.app')

@section('content')
<div class="row">
    <!-- Daftar Produk -->
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <strong>Daftar Produk</strong>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($products as $product)
                        <div class="col-md-4 mb-3">
                            <div class="card h-100">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text mb-1">
                                        Harga: <strong>Rp {{ number_format($product->price, 0, ',', '.') }}</strong>
                                    </p>
                                    <p class="card-text mb-3">
                                        Stok: {{ $product->stock }}
                                    </p>
                                    <form action="{{ route('pos.add') }}" method="post" class="mt-auto">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="number" name="quantity" class="form-control mb-2" value="1" min="1" max="{{ $product->stock }}">
                                        <button type="submit" class="btn btn-sm btn-success w-100">+ Tambah</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Keranjang Belanja -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-success text-white">
                <strong>Keranjang Belanja</strong>
            </div>
            <div class="card-body">
                @if(empty($cart))
                    <p class="text-center text-muted">Keranjang masih kosong</p>
                @else
                    <ul class="list-group mb-3">
                        @php $total = 0; @endphp
                        @foreach($cart as $item)
                            @php $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; @endphp
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $item['name'] }}</strong><br>
                                    {{ $item['quantity'] }} x Rp {{ number_format($item['price'], 0, ',', '.') }}
                                </div>
                                <div class="text-end">
                                    Rp {{ number_format($subtotal, 0, ',', '.') }}<br>
                                    <a href="{{ route('pos.remove', $item['id']) }}" class="text-danger small">hapus</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    <div class="border-top pt-2 mb-3">
                        <h5>Total: Rp {{ number_format($total, 0, ',', '.') }}</h5>
                    </div>

                    <form action="{{ route('pos.checkout') }}" method="post">
                        @csrf
                        <div class="mb-2">
                            <input type="text" name="cashier" class="form-control" placeholder="Nama kasir" required>
                        </div>
                        <div class="mb-2">
                            <input type="number" name="payment" class="form-control" placeholder="Jumlah pembayaran (Rp)" required>
                        </div>
                        <button class="btn btn-primary w-100">Bayar & Simpan Transaksi</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
