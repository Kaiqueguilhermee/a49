@props(['placeholder' => 'Digite o que você procura...', 'value' => ''])

<form action="{{ url('/') }}" method="GET" class="search-bar-form">
    <div class="input-group input-search-group">
        <input 
            type="text" 
            name="search" 
            value="{{ $value }}" 
            class="form-control" 
            placeholder="{{ $placeholder }}" 
            aria-label="Pesquisar" 
            aria-describedby="search-icon"
        >
        <span class="input-group-text" id="search-icon">
            <i class="fa-duotone fa-magnifying-glass"></i>
        </span>
    </div>
</form>
