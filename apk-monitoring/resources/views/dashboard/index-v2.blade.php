@extends('layout.master')

@section('title','Dashboard')

@section('page-title','Dashboard Monitoring')
@section('page-subtitle','Real-time monitoring sensor PLC')

@section('content')

{{-- CARD SENSOR --}}
<div class="grid grid-cols-3 gap-8 mt-8 start-card">

    {{-- SUHU --}}
    <div class="relative bg-gradient-to-br from-[#0e1633] to-[#090f25]
                p-6 rounded-2xl border border-orange/20
                hover:shadow-[0_0_35px_rgba(255,138,0,0.25)]
                transition-all duration-300">

        <div class="flex justify-between items-start mb-4">
            <p class="text-sm text-textMuted">Suhu</p>
            <div class="w-8 h-8 rounded-lg bg-orange/10 grid place-items-center">🌡</div>
        </div>

        <h2 class="text-[42px] font-semibold text-orange leading-none">
            <span id="tempVal">31.5</span>
            <span class="text-xl font-normal text-textMuted">°C</span>
        </h2>

        <p class="mt-3 text-green text-sm">↗ Normal</p>
    </div>

    {{-- CAHAYA --}}
    <div class="relative bg-gradient-to-br from-[#0e1633] to-[#090f25]
                p-6 rounded-2xl border border-yellow/20
                hover:shadow-[0_0_35px_rgba(255,199,0,0.25)]
                transition-all duration-300">

        <div class="flex justify-between items-start mb-4">
            <p class="text-sm text-textMuted">Intensitas Cahaya</p>
            <div class="w-8 h-8 rounded-lg bg-yellow/10 grid place-items-center">☀</div>
        </div>

        <h2 class="text-[42px] font-semibold text-yellow leading-none">
            <span id="lightVal">559</span>
            <span class="text-xl font-normal text-textMuted">Lux</span>
        </h2>

        <p class="mt-3 text-green text-sm">↗ Normal</p>
    </div>

    {{-- KELEMBAPAN --}}
    <div class="relative bg-gradient-to-br from-[#0e1633] to-[#090f25]
                p-6 rounded-2xl border border-blue-400/20
                hover:shadow-[0_0_35px_rgba(96,165,250,0.25)]
                transition-all duration-300">

        <div class="flex justify-between items-start mb-4">
            <p class="text-sm text-textMuted">Kelembapan</p>
            <div class="w-8 h-8 rounded-lg bg-blue-400/10 grid place-items-center">💧</div>
        </div>

        <h2 class="text-[42px] font-semibold text-blue-400 leading-none">
            <span id="humVal">57.1</span>
            <span class="text-xl font-normal text-textMuted">%</span>
        </h2>

        <p class="mt-3 text-green text-sm">↗ Normal</p>
    </div>

</div>

{{-- CHART --}}
<div class="grid grid-cols-2 gap-8 mt-10">

    <div class="bg-gradient-to-br from-[#0e1633] to-[#090f25]
                rounded-2xl p-6 border border-orange/10">
        <div class="flex items-center gap-2 mb-4">
            <span class="text-orange">🌡</span>
            <span class="text-sm font-medium">Trend Suhu</span>
        </div>
        <div class="h-[280px]">
            <canvas id="tempChart"></canvas>
        </div>
    </div>

    <div class="bg-gradient-to-br from-[#0e1633] to-[#090f25]
                rounded-2xl p-6 border border-yellow/10">
        <div class="flex items-center gap-2 mb-4">
            <span class="text-yellow">☀</span>
            <span class="text-sm font-medium">Trend Intensitas Cahaya</span>
        </div>
        <div class="h-[280px]">
            <canvas id="lightChart"></canvas>
        </div>
    </div>
    <div class="bg-gradient-to-br from-[#0e1633] to-[#090f25] rounded-2xl p-6 border border-blue/10 col-span-2">
        <div class="flex items-center gap-2 mb-4">
            <span class="text-blue">☀</span>
            <span class="text-sm font-medium">Trend Kelembapan</span>
        </div>
        <div class="h-[280px]">
            <canvas id="humidityChart"></canvas>
        </div>
    </div>


</div>

@endsection

