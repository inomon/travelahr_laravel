<form action="/go-travel" method="get">
    <div class="form-row">
        <div class="col-12 col-md-7 mb-2 mb-md-0">
            <input type="hidden" name="country" value="JP">
            <select name="city" class="form-control form-control-lg">
                <option value="Kyoto" {{ isset($selectedCity) && $selectedCity === 'Kyoto' ? 'selected' : '' }}>Kyoto</option>
                <option value="Nagoya" {{ isset($selectedCity) && $selectedCity === 'Nagoya' ? 'selected' : '' }}>Nagoya</option>
                <option value="Osaka" {{ isset($selectedCity) && $selectedCity === 'Osaka' ? 'selected' : '' }}>Osaka</option>
                <option value="Sapporo" {{ isset($selectedCity) && $selectedCity === 'Sapporo' ? 'selected' : '' }}>Sapporo</option>
                <option value="Tokyo" {{ isset($selectedCity) && $selectedCity === 'Tokyo' ? 'selected' : '' }}>Tokyo</option>
                <option value="Yokohama" {{ isset($selectedCity) && $selectedCity === 'Yokohama' ? 'selected' : '' }}>Yokohama</option>
            </select>
        </div>
        <div class="col-12 col-md-5">
            <button type="submit" class="btn btn-block btn-lg btn-primary"><i class="icon-plane"></i></button>
        </div>
    </div>
</form>
