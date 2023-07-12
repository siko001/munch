<x-layout>
    <section class="book_section layout_padding">
        <div class="container">
            @if (Session::has('success'))
                <div class="alert alert-success text-center mt-5">
                    {{ Session::get('success') }}
                </div>
            @elseif (Session::has('failure'))
                <div class="alert alert-danger text-center mt-5">
                    {{ Session::get('failure') }}
                </div>
            @endif
            <x-ordersubnav>
            </x-ordersubnav>
            <div class="card-body">
                <table>
                    <thead>
                        <th colspan="3"><a href="#" class="column-heading " data-column="id">ID <span
                                    class="sort-arrow"></span></a></th>

                        <th class="full-width-th" colspan="3"><a href="#" class="column-heading "
                                data-column="time">Time In <span class="sort-arrow"></span></a></th>

                        <th class="full-width-th" colspan="3"><a href="#" class="column-heading "
                                data-column="delivery">Delivery Method <span class="sort-arrow"></span></a></th>
                        <th class="full-width-th" class="underline" colspan="1"><a href="#"
                                class="column-heading " data-column="deliverBy">To Deliver By <span
                                    class="sort-arrow"></span></a></th>
                        <th class="full-width-th" class="underline" colspan="1">Status</th>
                        <th class="full-width-th" class="underline" colspan="1">Payment</th>
                    </thead>
                    <tbody>
                        <!-- Table body content here -->
                        @foreach ($orders as $order)
                            @unless ($order->status === 'Order Completed' || $order->status === 'Order Cancelled!')
                                <tr>
                                    <td colspan="3"><a href="#" class="open-overlay-orders"
                                            data-id="{{ $order->order_number }}" data-info="staff"
                                            data-status="{{ $order->status }}">{{ $order->order_number }}
                                        </a></td>
                                    <td colspan="3">{{ $order->time }}</td>
                                    <td colspan="3">{{ $order->delivery_method }}</td>
                                    <td colspan="1">{{ $order->time_to_deliver }}</td>
                                    <td style="background:{{ $order->status == 'Order Cancelled' || $order->status == 'Order Cancelled!' ? 'red' : '' }}"
                                        colspan="1">{{ $order->status }}</td>

                                    <td colspan="1">{{ $order->payment }}</td>
                                </tr>
                            @endunless
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <x-cardOverLay>
    </x-cardOverLay>
</x-layout>
