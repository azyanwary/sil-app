@props(['status'])

@php
    $colorClass = match($status) {
        'aktif', 'disetujui' => 'bg-green-100 text-green-800',
        'dalam_renovasi', 'diverifikasi' => 'bg-amber-100 text-amber-800',
        'tutup_sementara', 'ditolak' => 'bg-red-100 text-red-800',
        'diajukan' => 'bg-blue-100 text-blue-800',
        'selesai' => 'bg-gray-100 text-gray-800',
        default => 'bg-gray-100 text-gray-800',
    };
@endphp

<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $colorClass }}">
    {{ __($status) }}
</span>
