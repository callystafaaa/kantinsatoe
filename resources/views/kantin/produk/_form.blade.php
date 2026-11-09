<div class="mb-3">
    <label class="form-label">Nama produk</label>
    <input type="text" name="nama_produk"
           class="form-control @error('nama_produk') is-invalid @enderror"
           value="{{ old('nama_produk', $produk->nama_produk ?? '') }}">
    @error('nama_produk')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Deskripsi</label>
    <textarea name="deskripsi" rows="3" class="form-control">{{ old('deskripsi', $produk->deskripsi ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label">Harga (Rp)</label>
    <input type="number" name="harga"
           class="form-control @error('harga') is-invalid @enderror"
           value="{{ old('harga', $produk->harga ?? '') }}">
    @error('harga')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<button class="btn btn-coklat">Simpan</button>
<a href="{{ route('kantin.produk.index') }}" class="btn btn-outline-secondary">Batal</a>