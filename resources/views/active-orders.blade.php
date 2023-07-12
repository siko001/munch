<x-layout>
    <section class="book_section layout_padding">
        <div class="container">
            <div class="heading_container text-center">
                <h2 style="margin: 0 auto;">Profile</h2>
            </div>
            @if (Session::has('success'))
                <div class="alert alert-success text-center mt-5">
                    {{ Session::get('success') }}
                </div>
            @elseif (Session::has('failure'))
                <div class="alert alert-danger text-center mt-5">
                    {{ Session::get('failure') }}
                </div>
            @endif
            <x-subnav>
            </x-subnav>


            <div class="card-body" id="profile-settings">
                <table>
                    <thead>
                        <th colspan="3"><a href="#" class="column-heading " data-column="id">ID <span
                                    class="sort-arrow"></span></a></th>
                        <th colspan="3"><a href="#" class="column-heading " data-column="time">Time Placed
                                <span class="sort-arrow"></span></a></th>
                        <th colspan="3"><a href="#" class="column-heading " data-column="price">Price <span
                                    class="sort-arrow"></span></a></th>
                        <th colspan="3"><a href="#" class="column-heading " data-column="status">Status <span
                                    class="sort-arrow"></span></a></th>
                    </thead>
                    <tbody>
                        @foreach ($activeOrder as $activeorder)
                            @unless ($activeorder->status === 'Order Completed' || $activeorder->status === 'Order Cancelled!')
                                <tr>
                                    <td colspan="3">
                                        <a href="#" class="open-overlay-orders"
                                            data-id="{{ $activeorder->order_number }}" data-info="user"
                                            data-status="{{ $activeorder->status }}">
                                            {{ $activeorder->order_number }}
                                        </a>
                                    </td>
                                    <td colspan="3">{{ $activeorder->time }}</td>
                                    <td colspan="3">{{ $activeorder->total_excluding_vat }}</td>
                                    <td style="background:{{ $activeorder->status == 'Order Cancelled' || $activeorder->status == 'Order Cancelled!' ? 'red' : '' }}"
                                        colspan="3">
                                        {{ $activeorder->status }}
                                    </td>
                                </tr>
                            @endunless
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </section>
    <x-cardOverlay>
    </x-cardOverlay>
</x-layout>
