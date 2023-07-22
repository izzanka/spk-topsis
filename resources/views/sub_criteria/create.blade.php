@extends('layout.app')

@section('content')

<div class="mt-2">
    <span class="fs-4">Tambah Sub Kriteria</span>
    <hr>
    @include('layout.alert')
    <div class="row">
        <div class="col-4">
            <form action="{{ route("sub_criterias.store") }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="criteria_id" class="form-label">Kriteria <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <select class="round-1 form-select @error('criteria_id') is-invalid @enderror" name="criteria_id">
                            <option selected disabled value="">Pilih Kriteria...</option>
                            @foreach ($criterias as $criteria)
                                <option value="{{ $criteria->id }}">{{ $criteria->name }}</option>
                            @endforeach
                        </select>
                        @error('criteria_id')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Sub Kriteria <span class="text-danger">*</span></label>
                    <div class="input-group">
                      {{-- <input type="text" class="rounded-1 form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}"> --}}
                      <textarea name="name" id="name" cols="30" rows="5" class="form-control @error('name') is-invalid @enderror">{{ old('name') }}</textarea>
                      @error('name')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                      @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="value" class="form-label">Nilai <span class="text-danger">*</span></label>
                    <div class="input-group">
                      <input type="text" class="rounded-1 form-control @error('value') is-invalid @enderror" id="value" name="value" value="{{ old('value') }}">
                      @error('value')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                      @enderror
                    </div>
                </div>
                <button class="btn btn-success btn-sm" type="submit"><i class="bi bi-download me-1"></i> Simpan</button>
                <a class="btn btn-secondary btn-sm" href="{{ route('sub_criterias.index') }}"><i class="bi bi-skip-backward me-1"></i> Kembali</a>
            </form>
        </div>
    </div>

</div>


@endsection
