@extends('layout.app')

@section('content')

<div class="mt-2">
    <span class="fs-4">Ubah Sub Kriteria</span>
    <hr>
    <div class="row">
        <div class="col-4">
            <form action="{{ route("sub_criterias.update", $sub_criteria->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="criteria_id" class="form-label">Kriteria <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <select class="form-select" disabled>
                            @php
                                $select = '';
                                foreach ($criterias as $criteria) {
                                    if($criteria->id == $sub_criteria->criteria_id){
                                        $select = 'selected';
                                    }else{
                                        $select = '';
                                    }
                                    echo "<option $select>".$criteria->name."</option>";
                                }
                            @endphp
                        </select>
                    </div>
                </div>
                {{-- <div class="mb-3">
                    <label for="name" class="form-label">Nama Sub Kriteria <span class="text-danger">*</span></label>
                    <div class="input-group">
                      <input type="text" class="rounded-1 form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $sub_criteria->name }}">
                      @error('name')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                      @enderror
                    </div>
                </div> --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Sub Kriteria <span class="text-danger">*</span></label>
                    <div class="input-group">
                      {{-- <input type="text" class="rounded-1 form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}"> --}}
                      <textarea name="name" id="name" cols="30" rows="5" class="form-control @error('name') is-invalid @enderror">{{ $sub_criteria->name }}</textarea>
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
                      <input type="text" class="rounded-1 form-control @error('value') is-invalid @enderror" id="value" name="value" value="{{ $sub_criteria->value }}">
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
