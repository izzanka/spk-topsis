@extends('layout.app')

@section('content')

<div class="mt-2">
    <span class="fs-4">Ubah Kriteria</span>
    <hr>
    <div class="row">
        <div class="col-4">
            <form action="{{ route("criterias.update", $criteria->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="code" class="form-label">Kode</label>
                    <div class="input-group">
                      <input type="text" class="rounded-1 form-control" id="code" value="{{ $criteria->code }}" disabled>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Kriteria <span class="text-danger">*</span></label>
                    <div class="input-group">
                      <input type="text" class="rounded-1 form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $criteria->name }}">
                      @error('name')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                      @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="attribute" class="form-label">Atribut <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <select class="form-select" name="attribute">
                            @php
                                $select = '';
                                foreach ($attributes as $attribute) {
                                    if($criteria->attribute == $attribute){
                                        $select = 'selected';
                                    }else{
                                        $select = '';
                                    }
                                    echo "<option $select value=".$attribute.">".$attribute."</option>";
                                }
                            @endphp
                        </select>
                        @error('attribute')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="weight" class="form-label">Bobot <span class="text-danger">*</span></label>
                    <div class="input-group">
                      <input type="text" class="rounded-1 form-control @error('weight') is-invalid @enderror" id="weight" name="weight" value="{{ $criteria->weight }}">
                      @error('weight')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                      @enderror
                    </div>
                </div>
                <button class="btn btn-success btn-sm" type="submit"><i class="bi bi-download me-1"></i> Simpan</button>
                <a class="btn btn-secondary btn-sm" href="{{ route('criterias.index') }}"><i class="bi bi-skip-backward me-1"></i> Kembali</a>
            </form>
        </div>
    </div>

</div>


@endsection
