@extends("layouts.default")
@section("title","My Orders - beloved")
@section("content")
    <main class="container" style="max-width: 1000px;">
        <section>
            <style>
                .orders-container {
                    background: #ffffff;
                    min-height: 100vh;
                    padding: 20px 0;
                }

                .page-header {
                    margin-bottom: 2rem;
                }

                .page-title {
                    font-size: 2rem;
                    font-weight: 700;
                    color: #333;
                    margin-bottom: 0.5rem;
                }

                .page-subtitle {
                    color: #6c757d;
                    font-size: 1rem;
                }

                .order-card {
                    background: white;
                    border: 1px solid #e9ecef;
                    border-radius: 12px;
                    padding: 24px;
                    margin-bottom: 20px;
                    transition: box-shadow 0.2s;
                }

                .order-card:hover {
                    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
                }

                .order-header {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    margin-bottom: 16px;
                    flex-wrap: wrap;
                    gap: 12px;
                }

                .order-number {
                    font-size: 1.25rem;
                    font-weight: 600;
                    color: #333;
                }

                .order-date {
                    color: #6c757d;
                    font-size: 0.9rem;
                }

                .status-badge {
                    padding: 6px 12px;
                    border-radius: 20px;
                    font-size: 11px;
                    font-weight: 600;
                    text-transform: uppercase;
                    letter-spacing: 0.5px;
                }

                .status-pending {
                    background: #fff3cd;
                    color: #856404;
                    border: 1px solid #ffeaa7;
                }

                .status-processing {
                    background: #cce5ff;
                    color: #0066cc;
                    border: 1px solid #99d6ff;
                }

                .status-shipped {
                    background: #d4edda;
                    color: #155724;
                    border: 1px solid #c3e6cb;
                }

                .status-delivered {
                    background: #d1ecf1;
                    color: #0c5460;
                    border: 1px solid #bee5eb;
                }

                .status-cancelled {
                    background: #f8d7da;
                    color: #721c24;
                    border: 1px solid #f5c6cb;
                }

                .order-info {
                    display: grid;
                    grid-template-columns: 1fr 1fr 1fr;
                    gap: 20px;
                    margin-bottom: 16px;
                }

                .info-item {
                    text-align: center;
                }

                .info-label {
                    font-size: 0.85rem;
                    color: #6c757d;
                    margin-bottom: 4px;
                }

                .info-value {
                    font-weight: 600;
                    color: #333;
                    font-size: 1rem;
                }

                .order-actions {
                    display: flex;
                    gap: 12px;
                    justify-content: flex-end;
                    flex-wrap: wrap;
                }

                .btn-view-details {
                    background: #ff90df;
                    color: white;
                    border: none;
                    border-radius: 8px;
                    padding: 8px 16px;
                    font-weight: 600;
                    text-decoration: none;
                    font-size: 0.9rem;
                    transition: background-color 0.2s;
                }

                .btn-view-details:hover {
                    background: #e4c2e4;
                    color: white;
                    text-decoration: none;
                }
                

                .empty-state {
                    text-align: center;
                    padding: 60px 20px;
                    color: #6c757d;
                }

                .empty-state-icon {
                    font-size: 4rem;
                    color: #dee2e6;
                    margin-bottom: 1rem;
                }

                .empty-state-title {
                    font-size: 1.5rem;
                    font-weight: 600;
                    color: #333;
                    margin-bottom: 0.5rem;
                }

                .empty-state-text {
                    font-size: 1rem;
                    margin-bottom: 2rem;
                }

                .btn-shop-now {
                    background: #000;
                    color: white;
                    border: none;
                    border-radius: 8px;
                    padding: 12px 24px;
                    font-weight: 600;
                    text-decoration: none;
                    display: inline-block;
                    transition: background-color 0.2s;
                }

                .btn-shop-now:hover {
                    background: #333;
                    color: white;
                    text-decoration: none;
                }

                @media (max-width: 768px) {
                    .order-header {
                        flex-direction: column;
                        align-items: flex-start;
                    }

                    .order-info {
                        grid-template-columns: 1fr;
                        gap: 12px;
                    }

                    .info-item {
                        text-align: left;
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                    }

                    .order-actions {
                        justify-content: flex-start;
                        width: 100%;
                    }
                }
            </style>

            <div class="orders-container">
                <!-- Page Header -->
                <div class="page-header">
                    <h1 class="page-title">My Orders</h1>
                    <p class="page-subtitle">Track and manage your orders</p>
                </div>

                <!-- Alert Messages -->
                @if(session()->has("success"))
                    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                        {{session()->get("success")}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session()->has("error"))
                    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                        {{session()->get("error")}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Orders List -->
                @if($orders->count() > 0)
                    @foreach($orders as $order)
                        <div class="order-card">
                            <div class="order-header">
                                <div>
                                    <div class="order-number">
                                        Order #{{ $order->order_number ?? str_pad($order->id, 6, '0', STR_PAD_LEFT) }}
                                    </div>
                                    <div class="order-date">
                                        Placed on {{ $order->created_at->format('F j, Y') }}
                                    </div>
                                </div>
                                <span class="status-badge status-{{ strtolower($order->payment_status ?? 'processing') }}">
                                    {{ ucfirst($order->payment_status ?? 'Processing') }}
                                </span>
                            </div>

                            <div class="order-info">
                                <div class="info-item">
                                    <div class="info-label">Total Amount</div>
                                    <div class="info-value">${{ number_format($order->total_price, 2) }}</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Items</div>
                                    <div class="info-value">
                                        {{ is_array(json_decode($order->quantity)) ? array_sum(json_decode($order->quantity)) : 1 }} items
                                    </div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Delivery to</div>
                                    <div class="info-value">{{ Str::limit($order->address, 20) }}</div>
                                </div>
                            </div>

                            <div class="order-actions">
                                <a href="{{ route('orders.details', $order->id) }}" class="btn-view-details">
                                    View Details
                                </a>
                            </div>
                        </div>
                    @endforeach

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $orders->links() }}
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="order-card">
                        <div class="empty-state">
                            <div class="empty-state-icon">
                                <i class="fas fa-shopping-bag"></i>
                            </div>
                            <h3 class="empty-state-title">No Orders Yet</h3>
                            <p class="empty-state-text">
                                You haven't placed any orders yet. Start shopping to see your orders here.
                            </p>
                            <a href="{{ route('home') }}" class="btn-shop-now">Start Shopping</a>
                        </div>
                    </div>
                @endif
            </div>
        </section>
    </main>
@endsection
