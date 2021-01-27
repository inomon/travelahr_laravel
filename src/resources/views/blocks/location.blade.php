<div class="row no-gutters">
    <div class="col-lg-6 {{ ($index % 2 == 0 ? 'order-lg-2' : '') }} text-white showcase-img" style="background-image: url('{{ $venue['photo']['photo_link'] }}'); background-position: center;"></div>
    <div class="col-lg-6 {{ ($index % 2 == 0 ? 'order-lg-1' : '') }} my-auto showcase-text">
        <h2>
            <span class="category-icon-link">
                <img class="img-fluid" alt="{{ $venue['name'] }}" src="{{$venue['category_icon_link']}}" />
            </span>
            {{ $venue['name'] }}
        </h2>
        <p class="lead mb-0">
            @isset($venue['location']['address'])
                {{ $venue['location']['address'] }}
            @endisset
            &nbsp;
            @isset($venue['location']['crossStreet'])
                {{ $venue['location']['crossStreet'] }}
            @endisset
        </p>
        <div class="mapping-pin mt-5">
            <a target="window" class="stretched-link" href="https://www.google.com/maps/search/{{ $venue['map_query'] }}"> Look for this on Google Maps <i class="fa fa-map-marker-alt"></i> </a>
        </div>
    </div>
</div>
