<div class="find-agents-list">
@if(($shouldGateGuest ?? false) === true)
<div class="no-agents-found p-4" style="background-color: #f8f9fa; border-radius: 8px; border: 1px solid #e9ecef; margin-top: 20px;">
    <h3 style="color: #0f5634; font-size: 20px; font-weight: 600; margin-bottom: 15px;">Complete Your Details to View Agents</h3>
    <p style="font-size: 15px; color: #495057; margin-bottom: 20px;">Please complete the form popup to see the best matching agents in your area.</p>
    <button type="button" class="all-btn" onclick="showQuickRegisterPopup()">Complete Details</button>
</div>
@else
<!-- Title -->
@if(!(request('ServiceType') == 'Claim Assistance' && !request()->filled('InsuranceCompany')))
<div class="find-agents-list-title mb-2">
    <h3>{{ $agents->total() }} Insurance Agent{{ $agents->total() != 1 ? 's' : '' }} Available</h3>
</div>
@endif

@if(request('ServiceType') == 'Claim Assistance' && !request()->filled('InsuranceCompany'))
<div class="no-agents-found p-4" style="background-color: #f8f9fa; border-radius: 8px; border: 1px solid #e9ecef; margin-top: 20px;">
    <h3 style="color: #d9534f; font-size: 20px; font-weight: 600; margin-bottom: 15px;">Complete Required Filters to View Agents</h3>
    <p style="font-size: 15px; color: #495057; margin-bottom: 15px;">For Claim Assistance service, please select the following required filters to see matching agents:</p>
    <ul style="list-style-type: none; padding-left: 0; margin-bottom: 15px;">
        <li style="font-size: 15px; color: #212529; font-weight: 600;"><i class="fas fa-building text-secondary me-2"></i> Insurance Company</li>
    </ul>
    <p style="font-size: 13px; color: #6c757d; margin-bottom: 0;">* Complaint Type is optional and can be used to further refine your search</p>
</div>
@elseif($agents->isEmpty())
<!-- No Agents found  -->
<div class="no-agents-found p-4" style="background-color: #fff5f5; border-radius: 8px; border: 1px solid #feb2b2; margin-top: 20px; text-align: center;">
    <h3 style="color: #c53030; font-size: 20px; font-weight: 600; margin-bottom: 15px;">No Agents Found</h3>
    <p style="font-size: 15px; color: #4a5568; margin-bottom: 15px;">
        @if(request()->filled('pincode'))
            We couldn't find any agents serving the pincode <strong>{{ request('pincode') }}</strong> with your selected filters.
        @else
            No agents found matching your current filters.
        @endif
    </p>
    <a href="{{ route('find.agents') }}" class="all-btn no-interceptor text-decoration-none" style="display: inline-block; background-color: #273c8e;">Clear All Filters</a>
</div>
@else
<div id="agents-list">
<!-- Agents list -->
@foreach($agents as $agent)
    @include('partials.agent-card', ['agent' => $agent])
@endforeach

    <div id="load-more-wrapper" class="w-100">
        @if($agents->hasMorePages())
        <div class="find-more-agent-btn text-center">
            <a href="{{ $agents->nextPageUrl() }}" 
               class="all-btn no-interceptor text-decoration-none">
               Find More Agents
            </a>
        </div>
        @endif
    </div>
</div>
@endif
@endif
</div>