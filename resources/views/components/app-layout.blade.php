@props(['title' => 'Dashboard', 'subtitle' => ''])

<x-layouts.app :title="$title" :subtitle="$subtitle">
    {{ $slot }}
</x-layouts.app>
