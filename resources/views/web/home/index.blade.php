@extends('layouts.web')

@section('title', config('setting')['software_name'].' - Cassino Online | Jogos de Slot e Apostas em Futebol')

@section('seo')
    <link rel="canonical" href="{{ url()->current() }}" />
    <meta name="description" content="Bem-vindo à {{ config('setting')['software_name'] }} - o melhor cassino online com uma ampla seleção de jogos de slot, apostas em jogos de futebol e uma experiência de aposta fácil e divertida. Jogue Fortune Tiger, Fortune OX e muito mais!">
    <meta name="keywords" content="{{ config('setting')['software_name'] }}, cassino online, jogos de slot, apostas em futebol, Fortune Tiger, Fortune OX">

    <meta property="og:locale" content="pt_BR" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ config('setting')['software_name'] }} - Apostas Online | Jogos de Slot e Apostas em Futebol" />
    <meta property="og:description" content="Bem-vindo à {{ config('setting')['software_name'] }} - o melhor cassino online com uma ampla seleção de jogos de slot, apostas em jogos de futebol e uma experiência de aposta fácil e divertida. Jogue Fortune Tiger, Fortune OX e muito mais!" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:site_name" content="{{ config('setting')['software_name'] }} - Apostas Online | Jogos de Slot e Apostas em Futebol" />
    <meta property="og:image" content="{{ asset('/assets/images/banner-1.png') }}" />
    <meta property="og:image:secure_url" content="{{ asset('/assets/images/banner-1.png') }}" />
    <meta property="og:image:width" content="1024" />
    <meta property="og:image:height" content="571" />

    <meta name="twitter:title" content="{{ config('setting')['software_name'] }} - Apostas Online | Jogos de Slot e Apostas em Futebol">
    <meta name="twitter:description" content="Bem-vindo à {{ config('setting')['software_name'] }} - o melhor cassino online com uma ampla seleção de jogos de slot, apostas em jogos de futebol e uma experiência de aposta fácil e divertida. Jogue Fortune Tiger, Fortune OX e muito mais!">
    <meta name="twitter:image" content="{{ asset('/assets/images/banner-1.png') }}"> <!-- Substitua pelo link da imagem que deseja exibir -->
    <meta name="twitter:url" content="{{ url('/') }}"> <!-- Substitua pelo link da sua página -->
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/splide-core.min.css') }}">
@endpush

@section('content')
    <div class="container-fluid">

        <div class="">
            @include('includes.navbar_top')
            @include('includes.navbar_left')

            <div class="page__content">
                <!-- Banner Carousel -->
                <x-banner-carousel 
                    :banners="\App\Models\Banner::where('type', 'carousel')->get()" 
                    :showPromo="true"
                    promoText="Ganhe 10 rodadas grátis"
                />

                <!-- Search Bar -->
                <x-search-bar 
                    placeholder="Digite o que você procura..." 
                    :value="request('search', '')"
                />

                <!-- Jogos da Casa -->
                @if(count($gamesExclusives) > 0)
                    <x-section-title 
                        title="Jogos da Casa" 
                        :link="url('/games?tab=exclusives')"
                        icon="fa-regular fa-gamepad-modern"
                    />

                    <div class="row row-cols-3 row-cols-md-6 mt-3">
                        @foreach(\App\Models\Banner::where('type', 'home')->get() as $banner)
                            <div class="col">
                                <a href="{{ $banner->link }}">
                                    <img src="{{ asset('storage/'.$banner->image) }}" alt="" class="img-fluid rounded-4 w-full">
                                </a>
                            </div>
                        @endforeach
                    </div>

                    <div class="d-steam-cards js-steamCards">
                        @foreach($gamesExclusives as $gamee)
                            <a href="{{ route('web.vgames.show', ['game' => $gamee->uuid]) }}" class="d-steam-card-wrapper">
                                <div class="d-steam-card js-steamCard" style="background-image: url('{{ asset('storage/'.$gamee->cover) }}')"></div>
                            </a>
                        @endforeach
                    </div>
                @endif

                <!-- +Jogados Da Semana -->
                @if(isset($topTrendGames) && count($topTrendGames) > 0)
                    <x-section-title 
                        title="+Jogados Da Semana" 
                        :link="url('/games?tab=all')"
                    />

                    <x-game-grid 
                        :games="$topTrendGames" 
                        :scrollable="true"
                        :showPrizes="true"
                        columns="3"
                    />
                @endif

                <!-- Jogos por Provider -->
                @if(count($providers) > 0)
                    @foreach($providers as $provider)
                        @if($provider->games->where('status', 1)->count() > 0)
                            <x-section-title 
                                :title="$provider->name" 
                                :link="url('/games?provider='.$provider->code.'&tab=fivers')"
                            />

                            <x-game-grid 
                                :games="$provider->games->where('status', 1)" 
                                columns="3"
                            />
                        @endif
                    @endforeach
                @endif

                <!-- Todos os Jogos -->
                @if(count($games) > 0)
                    <x-section-title 
                        title="Todos os Jogos" 
                        :link="url('/games?tab=all')"
                    />

                    <x-game-grid 
                        :games="$games" 
                        columns="3"
                    />
                @endif

                <!-- Jogos Vibra -->
                @if(count($gamesVibra) > 0)
                    <x-section-title 
                        title="Jogos Vibra" 
                        :link="url('/games?tab=vibra')"
                    />

                    <x-game-grid 
                        :games="$gamesVibra" 
                        columns="3"
                    />
                @endif

                <!-- FAQ -->
                <x-section-title 
                    title="F.A.Q" 
                    :link="url('como-funciona')"
                    icon="fa-light fa-circle-info"
                    linkText="Saiba mais"
                />

                @include('web.home.sections.faq')

                @include('includes.footer')
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/splide.min.js') }}"></script>
    <script>
        document.addEventListener( 'DOMContentLoaded', function () {
            var elemento = document.getElementById('splide-soccer');

            if (elemento) {
                new Splide( '#splide-soccer', {
                    type   : 'loop',
                    drag   : 'free',
                    focus  : 'center',
                    autoplay: 'play',
                    perPage: 3,
                    arrows: false,
                    pagination: false,
                    breakpoints: {
                        640: {
                            perPage: 1,
                        },
                    },
                    autoScroll: {
                        speed: 1,
                    },
                }).mount();
            }

            new Splide( '#image-carousel', {
                arrows: false,
                pagination: false,
                type    : 'loop',
                autoplay: 'play',
            }).mount();
        } );
    </script>
@endpush
