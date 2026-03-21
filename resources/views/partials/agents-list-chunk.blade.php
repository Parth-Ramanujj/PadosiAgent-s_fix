<div hx-swap-oob="beforeend:#agents-list">
    @foreach($agents as $agent)
        @include('partials.agent-card', ['agent' => $agent])
    @endforeach
</div>

<div hx-swap-oob="outerHTML:#load-more-wrapper">
    @if($agents->hasMorePages())
    <div class="find-more-agent-btn text-center">
        <a class="all-btn no-interceptor text-decoration-none position-relative"
           hx-get="{{ $agents->nextPageUrl() }}"
           hx-indicator=".htmx-indicator-content">
           <span class="htmx-indicator htmx-indicator-content">
               <i class="fas fa-spinner fa-spin me-2"></i> Loading...
           </span>
           <span class="default-content">Find More Agents</span>
        </a>
    </div>
    @else
    <div></div>
    @endif
</div>
