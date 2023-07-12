<div class="row">
    @foreach ($activeDeal as $deal)
        <div class="col-md-6">
            <div class="col-md-12">
                <h2 class="mt-5">Today's Deal</h2>
            </div>
            <div class="box">
                <div class="img-box">
                    <img src="{{ asset('storage' . $deal->img) }}" alt="">
                </div>
                <div class="detail-box">
                    <div class="deal-text">
                        <h2>{{ $deal->name }}</h2>
                        <h2>{{ $deal->discount }}% Of</h2>
                        <h4>Code: {{ $deal->coupon_code }}</h4>
                        <h4> {{ $deal->description }}</h4>
                    </div>

                    @php
                        $dealIsApplied = $cartItem->contains(function ($item) {
                            return $item->options->deal_applied;
                        });
                        
                    @endphp
                    @if ($dealIsApplied)
                        <div class="deal-button">

                            @if ($deal->type === 'total_price')
                                <a href="#"
                                    onclick="event.preventDefault(); swal('{{ $deal->name }} already applied', 'The 75euro deal has already been applied to one or more items in the cart.', 'warning');"
                                    disabled>Apply Deal
                                </a>
                            @else
                                <a href="#"
                                    onclick="event.preventDefault(); swal('{{ $deal->name }} already applied', 'The {{ $deal->type }} deal has already been applied to one or more {{ $deal->type }}s in the cart.', 'warning');"
                                    disabled>Apply Deal
                                </a>
                            @endif

                        </div>
                    @else
                        <div class="deal-button">
                            <a href="/deal/{{ $deal->type }}">
                                Apply Deal
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($allDealsExcludingNow as $deal)
        <div class="col-md-6">
            <div class="col-md-12">
                <h2 class="mt-5">Upcoming Deals</h2>
            </div>
            <div class="box">
                <div class="img-box">
                    <img src="{{ asset('storage' . $deal->img) }}" alt="">
                </div>
                <div class="detail-box">
                    <div class="deal-text">
                        <h2>{{ $deal->name }}</h2>
                        <h2>{{ $deal->discount }}% Off</h2>
                        <h4>Code: {{ $deal->coupon_code }}</h4>
                        <h4> {{ $deal->description }}</h4>
                        <h2> When? {{ $deal->start_date }}</h2>
                    </div>
                    <div class="deal-button">
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
</div>
