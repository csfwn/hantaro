<x-filament-widgets::widget>
    <x-filament::section>
        <div >

            <!-- Title -->
            <div style="margin-bottom: 14px;">
                <h2 style="font-size: 18px; font-weight: 600; color: #1f2937; ">Total Orders</h2>
                <p style="font-size: 13px; color: #9ca3af;">Total customer orders this months</p>
            </div>

            <hr style="border: none; border-top: 1px solid #e5e7eb; margin-bottom: 16px;">

            <!-- Order Rows -->
            @foreach ($orders as $order)
                <div style="margin-bottom: 30px;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 6px;">
                        <span style="font-size: 14px; color: #4b5563;">{{ $order['label'] }}</span>
                        <span style="font-size: 14px; font-weight: 600; color: #374151;">{{ number_format($order['count']) }}</span>
                    </div>
                    <!-- Background bar -->
                    <div style="width: 100%; background-color: #f3f4f6; border-radius: 9999px; height: 8px;">
                        <!-- Filled bar -->
                        <div style="height: 8px; border-radius: 9999px; background-color: #f97316; width: {{ $order['percentage'] }}%;"></div>
                    </div>
                </div>
            @endforeach

            <hr style="border: none; border-top: 1px solid #e5e7eb; margin: 16px 0;">

            <!-- Total -->
            <div style="display: flex; flex-direction: column; align-items: center; padding: 8px 0;">
                <span style="font-size: 35px; font-weight: 700; color: #1f2937;">{{ number_format($total) }}</span>
                <span style="font-size: 13px; color: #9ca3af; margin-top: 4px;">Orders</span>
            </div>

        </div>
    </x-filament::section>
</x-filament-widgets::widget>