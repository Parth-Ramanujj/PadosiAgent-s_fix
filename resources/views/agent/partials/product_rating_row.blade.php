@php
    $expertise = $agent->productExpertise
        ->where('segment_type', $segment)
        ->where('product_name', $product)
        ->first();
    $level = $expertise ? $expertise->expertise_level : 0;
@endphp

<div class="product-rating-row" data-product="{{ $product }}">
    <div class="product-name-wrapper">
        <span class="product-name">{{ $product }}</span>
        @if(isset($is_custom) && $is_custom)
            <i class="fas fa-times remove-custom-product-inline" onclick="removeCustomProduct(this)" title="Remove product"></i>
            <input type="hidden" name="custom_products[{{ $segment }}][{{ $product }}]" value="1">
        @endif
    </div>
    <div class="star-rating" data-segment="{{ $segment }}" data-product="{{ $product }}">
        @for($i = 1; $i <= 5; $i++)
            <i class="fas fa-star {{ $i <= $level ? 'active' : '' }}" data-value="{{ $i }}" onclick="setProductRating('{{ $segment }}', '{{ $product }}', {{ $i }}, this)"></i>
        @endfor
        <input type="hidden" name="expertise[{{ $segment }}][{{ $product }}]" value="{{ $level }}">
    </div>
</div>
