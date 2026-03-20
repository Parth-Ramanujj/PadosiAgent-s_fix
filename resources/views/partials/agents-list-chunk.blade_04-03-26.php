<div class="pagination-response">
    @foreach($agents as $agent)
        @include('partials.agent-card', ['agent' => $agent])
    @endforeach

    <div id="load-more-wrapper" class="w-100">
        @if($agents->hasMorePages())
        <div class="find-more-agent-btn text-center">
            <a href="{{ $agents->nextPageUrl() }}" 
               class="all-btn no-interceptor text-decoration-none position-relative"
               hx-get="{{ $agents->nextPageUrl() }}"
               hx-target="#load-more-wrapper"
               hx-select=".pagination-response"
               hx-swap="outerHTML">
               <span class="htmx-indicator-content">
                   <i class="fas fa-spinner fa-spin me-2"></i> Loading...
               </span>
               <span class="default-content">Find More Agents</span>
            </a>
        </div>
        @endif
    </div>
</div>
