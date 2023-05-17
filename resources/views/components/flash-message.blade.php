<div>
    @if (session()->has('success'))
    <p x-data="{ open: true }" x-init="setTimeout(()=> open =false, 3000)" x-show="open" {{ $attributes->merge(['class' => 'alert alert-success']) }} role="alert">
            {{ session('success') }}
    </p>
    @endif
    @if (session()->has('error'))
    <p x-data="{ open: true }" x-init="setTimeout(()=> open =false, 3000)" x-show="open" {{ $attributes->merge(['class' => 'alert alert-danger']) }} role="alert">
            {{ session('error') }}
    </p>
    @endif
</div>