@extends('layout.app')

@section('content')

<div class="mt-2">
    <span class="fs-4">Data Sub Kriteria</span>
    <hr>
    @include('layout.alert')
    <div class="card rounded-1 mb-5">
        <div class="card-header">
            <div class="row">
                {{-- <div class="col-3">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control rounded-1" placeholder="Pencarian...">
                        <button class="btn btn-primary"><i class="bi bi-search me-1"></i> Cari</button>
                    </div>
                </div> --}}
                <div class="col-5">
                    <a class="btn btn-sm btn-success" href="{{ route('sub_criterias.create') }}"><i class="bi bi-plus"></i> Tambah Data Sub Kriteria</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">
                                No
                            </th>
                            <th scope="col" class="text-center">
                                Nama Kriteria
                            </th>
                            <th scope="col" class="text-center">
                                Nama Sub Kriteria
                            </th>
                            <th scope="col" class="text-center">
                                Nilai
                            </th>
                            <th scope="col" class="text-center">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sub_criterias as $sub_criteria)
                            <tr>
                                <td class="text-center">
                                    {{ ($sub_criterias->currentPage() - 1) * $sub_criterias->perPage() + $loop->iteration }}
                                </td>
                                <td class="text-center">
                                    {{ $sub_criteria->criteria->name }}
                                </td>
                                <td class="text-center">
                                    <small>
                                        {{ $sub_criteria->name }}
                                    </small>
                                </td>
                                <td class="text-center">
                                    {{ $sub_criteria->value }}
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-warning btn-sm" href="{{ route('sub_criterias.edit', $sub_criteria->id) }}"><i class="bi bi-pencil-square me-1"></i> Ubah</a>
                                    <a class="btn btn-danger btn-sm" href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $sub_criteria->id }}').submit();"><i class="bi bi-trash me-1"></i> Hapus</a>
                                </td>
                                <form id="delete-form-{{ $sub_criteria->id }}" action="{{ route('sub_criterias.destroy', $sub_criteria->id) }}" method="POST" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">
                                    Tidak ada data sub kriteria.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div>
                {{ $sub_criterias->links() }}
            </div>
        </div>
    </div>
</div>


@endsection
