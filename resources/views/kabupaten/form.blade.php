@extends('template.base')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Form Kabupaten</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Kabupaten</h6>
        </div>
        <div class="card-body">
            <form action="{{ url('kabupaten/simpan') }}" method="POST">
                @csrf
                <input type="hidden" name="kodekabupaten" value="{{ $data['kodekabupaten'] }}">
                <div class="form-group">
                    <label for="namakabupaten">Nama Kabupaten</label>
                    <input type="text" class="form-control" id="namakabupaten" name="namakabupaten" value="{{ old('namakabupaten', $data['namakabupaten'] ?? '') }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ url('kabupaten') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
