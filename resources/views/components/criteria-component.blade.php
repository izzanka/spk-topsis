<li class="nav-item"><a href="{{ route('criterias.index') }}" class="nav-link btn {{ request()->route()->named('criterias.index') || request()->route()->named('criterias.create') || request()->route()->named('criterias.edit') ? 'active' : '' }}">Kriteria <span class="badge text-bg-secondary">{{ $count_criteria }}</span></a></li>
