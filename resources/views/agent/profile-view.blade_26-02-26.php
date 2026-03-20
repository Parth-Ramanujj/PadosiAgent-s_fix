@extends('layouts.app')

@section('content')
<div class="profile_view_outer profile-view-wrapper">
    @include('layouts.header')

    <div class="profile-banner">
        @if(auth()->check() && auth()->user()->agent && auth()->user()->agent->id == $agent->id)
            <a href="{{ route('agent.dashboard') }}" class="back-btn">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>
            <a href="{{ route('agent.edit-profile') }}" class="edit-profile-banner-btn">
                <i class="fas fa-edit"></i> Edit Profile
            </a>
        @else
            <a href="{{ url()->previous() }}" class="back-btn">
                <i class="fas fa-arrow-left"></i> Back
            </a>
            <div class="match-badge">
                <i class="fas fa-star"></i> 96% Match
            </div>
        @endif
    </div>

    <div class="container pb-5">
        @include('agent.partials.profile-content')
    </div>
</div>
@endsection
