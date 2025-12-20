@php
    // $stories is expected from controller
    if(!isset($stories)) $stories = collect();
@endphp

<div class="stories-container block md:hidden">
    <div class="stories-scroll" style="display:flex; gap:10px; overflow-x:auto; padding:10px;">
        @foreach($stories as $story)
            @php
                $imgs = $story->images ?? [];
                // build absolute URLs for images so JS can open them directly
                $imgs_urls = array_map(function($u) {
                    return str_starts_with($u, 'http') ? $u : asset('storage/'.ltrim($u, '/'));
                }, $imgs);
                // cover fallback
                $cover_url = !empty($story->cover) ? (str_starts_with($story->cover, 'http') ? $story->cover : asset('storage/'.ltrim($story->cover, '/'))) : (count($imgs_urls) ? $imgs_urls[0] : null);
            @endphp

            <div class="story-bubble" tabindex="0" role="button" data-images='{{ json_encode($imgs_urls) }}' title="{{ $story->title }}" style="flex:0 0 auto; text-align:center;">
                <div style="width:64px; height:64px; border-radius:50%; background:#eee; display:flex; align-items:center; justify-content:center; overflow:hidden; border:3px solid #ff7a59;">
                    @if($cover_url)
                        <img src="{{ $cover_url }}" alt="{{ $story->title }}" style="width:100%; height:100%; object-fit:cover;">
                    @else
                        <span style="font-size:24px; color:#999;">S</span>
                    @endif
                </div>
                <div style="font-size:12px; margin-top:6px; color:#333; max-width:70px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">{{ $story->title }}</div>
            </div>
        @endforeach
    </div>

    <!-- Modal viewer (created/used by JS) -->
    <div id="stories-modal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.85); z-index:1200; align-items:center; justify-content:center;">
        <button id="stories-close" style="position:absolute; right:16px; top:16px; background:transparent; border:none; color:#fff; font-size:28px;">&times;</button>
        <div style="max-width:95%; max-height:90%; display:flex; align-items:center; justify-content:center; position:relative;">
            <button id="stories-prev" style="position:absolute; left:8px; background:transparent; border:none; color:#fff; font-size:32px;">‹</button>
            <img id="stories-image" src="" alt="" style="max-width:100%; max-height:100%; border-radius:8px;">
            <button id="stories-next" style="position:absolute; right:8px; background:transparent; border:none; color:#fff; font-size:32px;">›</button>
        </div>
    </div>

    <style>
        .story-bubble:focus { outline: 2px solid rgba(255,122,89,0.6); }
        .stories-scroll::-webkit-scrollbar { height:6px; }
        .stories-scroll::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.2); border-radius: 3px; }
    </style>

    <script>
        (function(){
            function qs(sel, ctx){ return (ctx||document).querySelector(sel); }
            function qsa(sel, ctx){ return Array.from((ctx||document).querySelectorAll(sel)); }

            var modal = qs('#stories-modal');
            var img = qs('#stories-image');
            var closeBtn = qs('#stories-close');
            var prevBtn = qs('#stories-prev');
            var nextBtn = qs('#stories-next');

            var currentList = [];
            var currentIndex = 0;

            function openViewer(list, index){
                currentList = list || [];
                currentIndex = index || 0;
                if(!currentList.length) return;
                img.src = currentList[currentIndex];
                modal.style.display = 'flex';
            }

            function closeViewer(){ modal.style.display = 'none'; img.src = ''; }
            function showIndex(i){ if(i<0) i = currentList.length-1; if(i>=currentList.length) i=0; currentIndex = i; img.src = currentList[currentIndex]; }

            qsa('.story-bubble').forEach(function(el){
                el.addEventListener('click', function(){
                    var imgs = JSON.parse(el.getAttribute('data-images') || '[]');
                    if(imgs.length) openViewer(imgs,0);
                });
            });

            closeBtn.addEventListener('click', closeViewer);
            modal.addEventListener('click', function(e){ if(e.target === modal) closeViewer(); });
            prevBtn.addEventListener('click', function(){ showIndex(currentIndex-1); });
            nextBtn.addEventListener('click', function(){ showIndex(currentIndex+1); });
            document.addEventListener('keydown', function(e){ if(e.key === 'Escape') closeViewer(); if(e.key === 'ArrowRight') showIndex(currentIndex+1); if(e.key === 'ArrowLeft') showIndex(currentIndex-1); });
        })();
    </script>
</div>
