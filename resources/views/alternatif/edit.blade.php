@extends('layout.app')

@section('content')

<div class="mt-2">
    <span class="fs-4">Ubah Alternatif</span>
    <hr>
    <div class="row">
        <div class="col-4">
            <form action="{{ route("alternatifs.update", $alternatif->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="code" class="form-label">Kode</label>
                    <div class="input-group">
                      <input type="text" class="rounded-1 form-control" id="code" value="{{ $alternatif->code }}" disabled>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Alternatif <span class="text-danger">*</span></label>
                    <div class="input-group">
                      <input type="text" class="rounded-1 form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $alternatif->name ?? old('name')}}">
                      @error('name')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                      @enderror
                    </div>
                </div>
                <button class="btn btn-success btn-sm" type="submit"><i class="bi bi-download me-1"></i> Simpan</button>
                <a class="btn btn-secondary btn-sm" href="{{ route('alternatifs.index') }}"><i class="bi bi-skip-backward me-1"></i> Kembali</a>
            </form>
        </div>
    </div>

</div>


@endsection
