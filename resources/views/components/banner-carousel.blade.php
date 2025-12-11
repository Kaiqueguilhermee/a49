@props(['banners', 'showPromo' => true, 'promoText' => 'Ganhe 10 rodadas grátis'])

<section id="image-carousel" class="splide" aria-label="Carrossel de Banners">
    <div class="splide__track">
        @if($showPromo)
            <div class="splide-banner">
                {{ $promoText }} 
                <span style="margin-left: 10px">
                    <i class="fa-solid fa-fire"></i>
                </span>
            </div>
        @endif
        <ul class="splide__list">
            @foreach($banners as $banner)
                <li class="splide__slide">
                    <a href="{{ $banner->link }}">
                        <img src="{{ asset('storage/' . $banner->image) }}" alt="Banner" loading="lazy">
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</section>
