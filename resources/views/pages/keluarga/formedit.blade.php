 {{-- P3-P502 --}}
                                        <div class="btn-group" role="group"
                                            aria-label="Button group with nested dropdown">
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-secondary dropdown-toggle btn-sm"
                                                    data-toggle="dropdown" aria-expanded="false">
                                                    P3-P502
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" style="display: flex; justify-content: space-between"
                                                        href="{{ route('set.session', ['id' => $d->id, 'form' => 'p3']) }}"
                                                        data-id="{{ $d->id }}"
                                                        data-id_survey="{{ $d->id_survey }}">P3
                                                        @if (\App\Models\Desa\P3\P3::where('id_survey', $d->id_survey)->exists())
                                                            <i class="fas fa-check text-success ml-2"></i>
                                                        @endif
                                                    </a>
                                                    <a class="dropdown-item" style="display: flex; justify-content: space-between"
                                                        href="{{ route('desa-p3Pegawai.fromP2', $d->id_survey) }}">
                                                        Pegawai
                                                        @if (
                                                            \App\Models\Desa\P3\PegawaiLainnya::whereHas('p3', function ($q) use ($d) {
                                                                $q->where('id_survey', $d->id_survey);
                                                            })->exists())
                                                            <i class="fas fa-check text-success ml-2"></i>
                                                        @endif
                                                    </a>
                                                    <a class="dropdown-item" style="display: flex; justify-content: space-between"
                                                        href="{{ route('desa-p3Bpd.fromP2', $d->id_survey) }}">
                                                        BPD
                                                        @if (
                                                            \App\Models\Desa\P3\AnggotaBpd::whereHas('p3', function ($q) use ($d) {
                                                                $q->where('id_survey', $d->id_survey);
                                                            })->exists())
                                                            <i class="fas fa-check text-success ml-2"></i>
                                                        @endif
                                                    </a>
                                                    <a class="dropdown-item" style="display: flex; justify-content: space-between"
                                                        href="{{ route('set.session', ['id' => $d->id, 'form' => 'p4']) }}">P4
                                                        @if (\App\Models\Desa\P4\P4::where('id_survey', $d->id_survey)->exists())
                                                            <i class="fas fa-check text-success ml-2"></i>
                                                        @endif
                                                    </a>
                                                    <a class="dropdown-item" style="display: flex; justify-content: space-between"
                                                        href="{{ route('set.session', ['id' => $d->id, 'form' => 'p5']) }}"
                                                        data-id="{{ $d->id }}"
                                                        data-id_survey="{{ $d->id_survey }}">P5
                                                        @if (\App\Models\Desa\P5\P5::where('id_survey', $d->id_survey)->exists())
                                                            <i class="fas fa-check text-success ml-2"></i>
                                                        @endif
                                                    </a>
                                                    <a class="dropdown-item" style="display: flex; justify-content: space-between"
                                                        href="{{ route('desa-p501.fromP2', $d->id_survey) }}">
                                                        Peraturan Desa
                                                        @if (
                                                            \App\Models\Desa\P5\P501::whereHas('p5', function ($q) use ($d) {
                                                                $q->where('id_survey', $d->id_survey);
                                                            })->exists())
                                                            <i class="fas fa-check text-success ml-2"></i>
                                                        @endif
                                                    </a>
                                                    <a class="dropdown-item" style="display: flex; justify-content: space-between"
                                                        href="{{ route('desa-p502.fromP2', $d->id_survey) }}">
                                                        Peraturan KepDes
                                                        @if (
                                                            \App\Models\Desa\P5\P502::whereHas('p5', function ($q) use ($d) {
                                                                $q->where('id_survey', $d->id_survey);
                                                            })->exists())
                                                            <i class="fas fa-check text-success ml-2"></i>
                                                        @endif
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- P503-P8 --}}
                                        <div class="btn-group" role="group"
                                            aria-label="Button group with nested dropdown">
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-secondary dropdown-toggle btn-sm"
                                                    data-toggle="dropdown" aria-expanded="false">
                                                    P503-P8
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" style="display: flex; justify-content: space-between"
                                                        href="{{ route('desa-p503.fromP2', $d->id_survey) }}">
                                                        SK KepDes
                                                        @if (
                                                            \App\Models\Desa\P5\P503::whereHas('p5', function ($q) use ($d) {
                                                                $q->where('id_survey', $d->id_survey);
                                                            })->exists())
                                                            <i class="fas fa-check text-success ml-2"></i>
                                                        @endif
                                                    </a>
                                                    <a class="dropdown-item" style="display: flex; justify-content: space-between"
                                                        href="{{ route('set.session', ['id' => $d->id, 'form' => 'p601']) }}"
                                                        data-id="{{ $d->id }}"
                                                        data-id_survey="{{ $d->id_survey }}">P601
                                                        @if (\App\Models\Desa\P6\P601::where('id_survey', $d->id_survey)->exists())
                                                            <i class="fas fa-check text-success ml-2"></i>
                                                        @endif
                                                    </a>
                                                    <a class="dropdown-item" style="display: flex; justify-content: space-between"
                                                        href="{{ route('set.session', ['id' => $d->id, 'form' => 'p602']) }}"
                                                        data-id="{{ $d->id }}"
                                                        data-id_survey="{{ $d->id_survey }}">P602
                                                        @if (\App\Models\Desa\P6\P602::where('id_survey', $d->id_survey)->exists())
                                                            <i class="fas fa-check text-success ml-2"></i>
                                                        @endif
                                                    </a>
                                                    <a class="dropdown-item" style="display: flex; justify-content: space-between"
                                                        href="{{ route('set.session', ['id' => $d->id, 'form' => 'p603']) }}"
                                                        data-id="{{ $d->id }}"
                                                        data-id_survey="{{ $d->id_survey }}">P603
                                                        @if (\App\Models\Desa\P6\P603::where('id_survey', $d->id_survey)->exists())
                                                            <i class="fas fa-check text-success ml-2"></i>
                                                        @endif
                                                    </a>
                                                    <a class="dropdown-item" style="display: flex; justify-content: space-between"
                                                        href="{{ route('set.session', ['id' => $d->id, 'form' => 'p7']) }}"
                                                        data-id="{{ $d->id }}"
                                                        data-id_survey="{{ $d->id_survey }}">P7
                                                        @if (\App\Models\Desa\P7\P7::where('id_survey', $d->id_survey)->exists())
                                                            <i class="fas fa-check text-success ml-2"></i>
                                                        @endif
                                                    </a>
                                                    <a class="dropdown-item" style="display: flex; justify-content: space-between"
                                                        href="{{ route('desa-p705.fromP2', $d->id_survey) }}">
                                                        P705
                                                        @if (
                                                            \App\Models\Desa\P7\P705::whereHas('p7', function ($q) use ($d) {
                                                                $q->where('id_survey', $d->id_survey);
                                                            })->exists())
                                                            <i class="fas fa-check text-success ml-2"></i>
                                                        @endif
                                                    </a>
                                                    <a class="dropdown-item" style="display: flex; justify-content: space-between"
                                                        href="{{ route('set.session', ['id' => $d->id, 'form' => 'p8']) }}"
                                                        data-id="{{ $d->id }}"
                                                        data-id_survey="{{ $d->id_survey }}">P8
                                                        @if (\App\Models\Desa\P8\P8::where('id_survey', $d->id_survey)->exists())
                                                            <i class="fas fa-check text-success ml-2"></i>
                                                        @endif
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- P9-P10 --}}
                                        <div class="btn-group" role="group"
                                            aria-label="Button group with nested dropdown">
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-secondary dropdown-toggle btn-sm"
                                                    data-toggle="dropdown" aria-expanded="false">
                                                    P9-P10
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" style="display: flex; justify-content: space-between"
                                                        href="{{ route('set.session', ['id' => $d->id, 'form' => 'p9']) }}"
                                                        data-id="{{ $d->id }}"
                                                        data-id_survey="{{ $d->id_survey }}">P9
                                                        @if (\App\Models\Desa\P9\P9::where('id_survey', $d->id_survey)->exists())
                                                            <i class="fas fa-check text-success ml-2"></i>
                                                        @endif
                                                    </a>
                                                    <a class="dropdown-item" style="display: flex; justify-content: space-between"
                                                        href="{{ route('desa-p914.fromP2', $d->id_survey) }}">
                                                        P914
                                                        @if (
                                                            \App\Models\Desa\P9\P914::whereHas('p9', function ($q) use ($d) {
                                                                $q->where('id_survey', $d->id_survey);
                                                            })->exists())
                                                            <i class="fas fa-check text-success ml-2"></i>
                                                        @endif
                                                    </a>
                                                    <a class="dropdown-item" style="display: flex; justify-content: space-between"
                                                        href="{{ route('desa-p923.fromP2', $d->id_survey) }}">
                                                        P923
                                                        @if (
                                                            \App\Models\Desa\P9\P923::whereHas('p9', function ($q) use ($d) {
                                                                $q->where('id_survey', $d->id_survey);
                                                            })->exists())
                                                            <i class="fas fa-check text-success ml-2"></i>
                                                        @endif
                                                    </a>
                                                    <a class="dropdown-item" style="display: flex; justify-content: space-between"
                                                        href="{{ route('desa-p932.fromP2', $d->id_survey) }}">
                                                        P932
                                                        @if (
                                                            \App\Models\Desa\P9\P932::whereHas('p9', function ($q) use ($d) {
                                                                $q->where('id_survey', $d->id_survey);
                                                            })->exists())
                                                            <i class="fas fa-check text-success ml-2"></i>
                                                        @endif
                                                    </a>
                                                    <a class="dropdown-item" style="display: flex; justify-content: space-between"
                                                        href="{{ route('desa-p941.fromP2', $d->id_survey) }}">
                                                        P941
                                                        @if (
                                                            \App\Models\Desa\P9\P941::whereHas('p9', function ($q) use ($d) {
                                                                $q->where('id_survey', $d->id_survey);
                                                            })->exists())
                                                            <i class="fas fa-check text-success ml-2"></i>
                                                        @endif
                                                    </a>
                                                    <a class="dropdown-item" style="display: flex; justify-content: space-between"
                                                        href="{{ route('set.session', ['id' => $d->id, 'form' => 'p10']) }}"
                                                        data-id="{{ $d->id }}"
                                                        data-id_survey="{{ $d->id_survey }}">P10
                                                        @if (\App\Models\Desa\P10\P10::where('id_survey', $d->id_survey)->exists())
                                                            <i class="fas fa-check text-success ml-2"></i>
                                                        @endif
                                                    </a>
                                                </div>
                                            </div>
                                        </div>