@include('kunjungan.partials.highlight-styles')

<x-table-list>
    <x-slot name="header">
        <tr>
            <th style="width: 3%; text-align: center;">#</th>
            <th style="width: 10%; white-space: nowrap;">Kode Tamu</th>
            <th style="width: 10%; white-space: nowrap;">Tanggal</th>
            <th style="width: 13%;">Nama Tamu</th>
            <th style="width: 10%;">Email</th>
<th style="width: 13%;">No. Telepon</th>
            <th style="width: 13%;">Instansi</th>
            <th style="width: 16%;">Keperluan</th>
            <th style="width: 6%; text-align: center;">Aksi</th>
        </tr>
    </x-slot>

    @forelse ($kunjungans as $index => $kunjungan)
        @php
            // Parse tanggal untuk pengecekan yang lebih robust
            $tanggalKunjungan = \Carbon\Carbon::parse($kunjungan->tanggal);
            $isToday = $tanggalKunjungan->isToday();
        @endphp
        {{-- UPDATED VERSION - FIX KOLOM NOMOR --}}
        <tr>
            <td style="text-align: center; background: white !important; color: #000 !important;">
                {{ $kunjungans->firstItem() + $index }}
            </td>
            <td style="white-space: nowrap;">
                <strong>{{ $kunjungan->kode_tamu }}</strong>
            </td>
            <td style="white-space: nowrap;">
                @if($isToday)
                    <!-- Layout untuk hari ini - vertikal seperti yang lain -->
                    <div>
                        <span class="today-badge">
                            🔥 Hari Ini
                        </span>
                        <br>
                        <small class="text-muted">
                            {{ $tanggalKunjungan->format('d/m/Y') }}
                        </small>
                    </div>
                @else
                    <!-- Layout normal -->
                    <div>
                        {{ $tanggalKunjungan->format('d/m/Y') }}
                        <br>
                        <small class="text-muted">
                            {{ $tanggalKunjungan->diffForHumans() }}
                        </small>
                    </div>
                @endif
            </td>
            <td>
                @if($isToday)
                    <div class="d-flex align-items-center gap-2">
                        <div class="status-indicator status-today"></div>
                        <span class="fw-semibold">{{ $kunjungan->nama }}</span>
                    </div>
                @else
                    {{ $kunjungan->nama }}
                @endif
            </td>
            <td style="word-break: break-word;">
    {{ $kunjungan->email ?? '-' }}
</td>
<td style="word-break: break-word;">
    {{ $kunjungan->no_telp ?? '-' }}
</td>
            <td>{{ $kunjungan->instansi }}</td>
            <td style="word-wrap: break-word;">{{ $kunjungan->keperluan }}</td>
            <td style="text-align: center;">
                <div class="d-flex gap-1 justify-content-center">
                    @can('manage kunjungan')
                        <x-tombol-aksi href="{{ route('kunjungan.edit', $kunjungan->id) }}" type="edit" />
                    @endcan

                    @can('delete kunjungan')
                        <x-tombol-aksi href="{{ route('kunjungan.destroy', $kunjungan->id) }}" type="delete" />
                    @endcan
                </div>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="9" class="text-center">
                <div class="alert alert-danger mb-0">
                    Data Kunjungan belum tersedia.
                </div>
            </td>
        </tr>
    @endforelse
</x-table-list>
