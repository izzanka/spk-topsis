@extends('layout.app')

@section('content')

<div class="mt-2">
    <span class="fs-4">Ubah Data Nilai Alternatif</span>
    <hr>
    <div class="row">
        <div class="col-4">
            <form action="{{ route('alternatif.values.update', $alternatif_criteria->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="code" class="form-label">Kode Alternatif</label>
                    <div class="input-group">
                        <input type="text" class="rounded-1 form-control" id="code" value="{{ $alternatif_criteria->alternatif->code }}" disabled>
                    </div>
                </div>

                {{-- <div class="mb-3">
                    <label for="name" class="form-label">Nama Alternatif</label>
                    <div class="input-group">
                        <input type="text" class="rounded-1 form-control" id="name" value="{{ $alternatif_criteria->alternatif->name }}" disabled>
                    </div>
                </div> --}}

                @foreach($criterias as $criteria)

                    @php
                        $criteria_name = Illuminate\Support\Str::slug(strtolower($criteria->name), '_');
                        $sub_criterias = App\Models\SubCriteria::where('criteria_id', $criteria->id)->get();
                    @endphp

                    @if($sub_criterias->isNotEmpty())
                        <div class="mb-3">
                            <label for="{{ $criteria_name }}" class="form-label">{{ $criteria->name }} <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <select class="form-select @error($criteria_name) is-invalid @enderror" name="{{ $criteria_name }}">
                                    <option selected disabled value="">Pilih Sub Kriteria {{ $criteria->name }}...</option>
                                    @php
                                        $select = '';
                                        foreach ($sub_criterias as $key => $sub_criteria) {
                                            if($alternatif_criteria[$criteria_name] == $sub_criteria->value){
                                                $select = 'selected';
                                            }else{
                                                $select = '';
                                            }
                                            echo "<option $select value=" . $sub_criteria->value .">" . $sub_criteria->name . "</option>";
                                        }
                                    @endphp
                                    {{-- @foreach ($sub_criterias as $sub_criteria)
                                        <option value="{{ $sub_criteria->value }}">{{ $sub_criteria->name }}</option>
                                    @endforeach --}}
                                </select>
                                @error($criteria_name)
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                    @else
                    {{-- <div class="mb-3">
                        <label for="{{ $criteria_name }}" class="form-label">{{ $criteria->name }} <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" class="rounded-1 form-control @error($criteria_name) is-invalid @enderror" id="{{ $criteria_name }}" value="{{ $alternatif_criteria[$criteria_name] }}" name="{{ $criteria_name }}">
                            @error($criteria_name)
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div> --}}
                    @endif



                @endforeach

                <div class="mb-5">
                    <button class="btn btn-success btn-sm" type="submit"><i class="bi bi-download me-1"></i> Simpan</button>
                    <a class="btn btn-secondary btn-sm" href="{{ route('alternatif.values.index') }}"><i class="bi bi-skip-backward me-1"></i> Kembali</a>
                </div>

            </form>
        </div>
    </div>

</div>


@endsection
