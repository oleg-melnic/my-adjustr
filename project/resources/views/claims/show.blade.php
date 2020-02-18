@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Claims Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('claims-update') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')
              <input type="hidden" name="itemId" value="{{ $item->getIdentity() }}">

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Edit Claim') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('home') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('From User') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('zipcode') ? ' has-danger' : '' }}">
                      {{ $item->getUser()->getName() }}
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Zipcode') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('zipcode') ? ' has-danger' : '' }}">
                      {{ $item->getZipcode() }}
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Insurance Provider') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('provider') ? ' has-danger' : '' }}">
                      {{ $item->getProvider() }}
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Type of property') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('property') ? ' has-danger' : '' }}">
                      {{ $item->getProperty() }}
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Type of damages sustained') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('damages') ? ' has-danger' : '' }}">
                        {{ $item->getDamages() }}
                    </div>
                  </div>
                </div>
                  <div class="row">
                      <label class="col-sm-2 col-form-label">{{ __('Professional') }}</label>
                      <div class="col-sm-7">
                          <div class="form-group{{ $errors->has('state') ? ' has-danger' : '' }}">
                              {{ $item->getProfessional()->getName() }}
                          </div>
                      </div>
                  </div>
                <div class="row">
                    <label class="col-sm-2 col-form-label">{{ __('Text') }}</label>
                    <div class="col-sm-7">
                        <div class="form-group{{ $errors->has('text') ? ' has-danger' : '' }}">
                            {{ $item->getText() }}
                        </div>
                    </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('State') }}</label>
                  <div class="col-sm-7">
                      <div class="form-group{{ $errors->has('state') ? ' has-danger' : '' }}">
                          {{ $item->getState()->getName() }}
                      </div>
                      <div class="form-group{{ $errors->has('state') ? ' has-danger' : '' }}">
                          <div class="progress">
                              <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
    <script>
    </script>
@endpush
