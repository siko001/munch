<div class="carousel-wrap row ">
    <div class="owl-carousel client_owl-carousel">
        @foreach ($allcommentsfromusers as $comment)
            <div class="item">
                <div class="box">
                    <div class="detail-box">
                        <p>
                            {{ $comment->description }}
                        </p>
                        <h6>
                            {{ $comment->name }}
                        </h6>
                        <h3>
                            {{ $comment->user->name }}
                        </h3>
                        <h3>
                            @if ($comment->rating >= 1 && $comment->rating <= 5)
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $comment->rating)
                                        ⭐
                                    @else
                                        ☆
                                    @endif
                                @endfor
                            @else
                                N/A
                            @endif
                        </h3>
                        {{ $comment->date }}
                    </div>
                    <div class="img-box">
                        <img src="{{ $comment->user->profile_picture }}" alt="" class="box-img">
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
