@extends('back.layouts.page-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : "Profile")
@section('content')

@livewire('author-profile-header')
<hr>
<div class="row">
  <div class="card">
    <ul class="nav nav-tabs" data-bs-toggle="tabs">
      <li class="nav-item">
        <a href="#tabs-profile" class="nav-link active" data-bs-toggle="tab"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
          <!-- SVG icon code with class="me-2" -->
          Personal Detail</a>
      </li>
      <li class="nav-item">
        <a href="#tabs-password" class="nav-link" data-bs-toggle="tab"><!-- Download SVG icon from http://tabler-icons.io/i/user -->
          <!-- SVG icon code with class="me-2" -->
          Change Password</a>
      </li>
      {{-- <li class="nav-item ms-auto">
        <a href="#tabs-settings-ex2" class="nav-link" title="Settings" data-bs-toggle="tab"><!-- Download SVG icon from http://tabler-icons.io/i/settings -->
          <!-- SVG icon code -->
        </a>
      </li> --}}
    </ul>
    <div class="card-body">
      <div class="tab-content">
        <div class="tab-pane active show" id="tabs-profile">
          <div>
            @livewire('author-personal-detail')
          </div>
        </div>
        <div class="tab-pane" id="tabs-password">
          <div>Fringilla egestas nunc quis tellus diam rhoncus ultricies tristique enim at diam, sem nunc amet, pellentesque id egestas velit sed</div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection