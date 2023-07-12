<x-layout>

    <section class="book_section layout_padding">
        <div class="container">
            <div class="heading_container text-center">
                <h2 style="margin: 0 auto;">Profile</h2>
            </div>

            <x-ordersubnav>
            </x-ordersubnav>
            <div class="card-body" id="profile-settings">
                <table>
                    <thead>
                        <th colspan="3"><a href="#" class="column-heading " data-column="id">Order ID <span
                                    class="sort-arrow"></span></a></th>
                        <th colspan="3"><a href="#" class="column-heading " data-column="date">Date <span
                                    class="sort-arrow"></span></a></th>
                        <th colspan="3"><a href="#" class="column-heading " data-column="Price">Price <span
                                    class="sort-arrow"></span></a></th>
                        <th colspan="3"><a href="#" class="column-heading " data-column="delivery">Delivery
                                Method <span class="sort-arrow"></span></a></th>
                        <th colspan="3"><a href="#" class="column-heading " data-column="status">Status <span
                                    class="sort-arrow"></span></a></th>
                    </thead>
                    <tbody>
                        <!-- Table body content here -->

                        @foreach ($orders as $order)
                            @if ($order->status == 'Order Completed' || $order->status == 'Order Cancelled!')
                                <tr>
                                    <td colspan="3"><a href="#" class="open-overlay-orders"
                                            data-id="{{ $order->order_number }}" data-info="staff"
                                            data-status="{{ $order->status }}"
                                            data-final="true">{{ $order->order_number }}
                                        </a></td>
                                    <td colspan="3">{{ $order->date }}</td>
                                    <td colspan="3">{{ $order->total_excluding_vat }}</td>
                                    <td colspan="3">{{ $order->delivery_method }}</td>
                                    <td style="background:{{ $order->status == 'Order Cancelled' || $order->status == 'Order Cancelled!' ? 'red' : '' }}"
                                        colspan="3">{{ $order->status }}</td>

                                </tr>
                            @else
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </section>
    <x-cardOverLay>
    </x-cardOverLay>

</x-layout>
