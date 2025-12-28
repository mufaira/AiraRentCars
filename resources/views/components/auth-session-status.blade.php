@props(['status'])

@if ($status)
    <div class="font-medium text-sm text-green-400 bg-green-400/10 border border-green-400/20 rounded-lg px-4 py-3 mb-4">
        {{ $status }}
    </div>
@endif
