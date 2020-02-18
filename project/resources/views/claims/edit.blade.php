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
                      <input class="form-control" type="text" value="{{ $item->getUser()->getName() }}" readonly/>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Zipcode') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('zipcode') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('zipcode') ? ' is-invalid' : '' }}" name="zipcode" id="input-zipcode" type="text" placeholder="{{ __('Zipcode') }}" value="{{ $item->getZipcode() }}" required="true" aria-required="true"/>
                      @if ($errors->has('zipcode'))
                        <span id="zipcode-error" class="error text-danger" for="input-zipcode">{{ $errors->first('zipcode') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Insurance Provider') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('provider') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('provider') ? ' is-invalid' : '' }}" name="provider" id="input-provider" type="text" placeholder="{{ __('Provider') }}" value="{{ $item->getProvider() }}" required="true" aria-required="true"/>
                      @if ($errors->has('provider'))
                        <span id="provider-error" class="error text-danger" for="input-provider">{{ $errors->first('provider') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Type of property') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('property') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('property') ? ' is-invalid' : '' }}" name="property" id="input-property" type="text" placeholder="{{ __('Property') }}" value="{{ $item->getProperty() }}" required="true" aria-required="true"/>
                      @if ($errors->has('property'))
                        <span id="property-error" class="error text-danger" for="input-property">{{ $errors->first('property') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Type of damages sustained') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('damages') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('damages') ? ' is-invalid' : '' }}" name="damages" id="input-damages" type="text" placeholder="{{ __('Type of damages') }}" value="{{ $item->getDamages() }}" required="true" aria-required="true"/>
                      @if ($errors->has('damages'))
                        <span id="damages-error" class="error text-danger" for="input-damages">{{ $errors->first('damages') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                  <div class="row">
                      <label class="col-sm-2 col-form-label">{{ __('Professional') }}</label>
                      <div class="col-sm-7">
                          <div class="form-group{{ $errors->has('state') ? ' has-danger' : '' }}">
                              <select class="form-control custom-select" data-style="btn btn-link" id="professional-select" name="professional">
                                  <option value="">choose a professional</option>
                                  @foreach($professionals as $professional)
                                    <option value="{{ $professional->getIdentity() }}" @if($item->getProfessional() && $professional->getIdentity() === $item->getProfessional()->getIdentity())selected @endif>{{ $professional->getName() }}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>
                  </div>
                <div class="row">
                    <label class="col-sm-2 col-form-label">{{ __('Text') }}</label>
                    <div class="col-sm-7">
                        <div class="form-group{{ $errors->has('text') ? ' has-danger' : '' }}">
                            <textarea id="editor" name="text" style="min-height: 300px; width: 100%">{{ $item->getText() }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('State') }}</label>
                  <div class="col-sm-7">
                      <div class="form-group{{ $errors->has('state') ? ' has-danger' : '' }}">
                          <select class="form-control custom-select" data-style="btn btn-link" id="state-select" name="state">
                              <option value="1" @if($item->getState()->getState() === 1)selected @endif>Active</option>
                              <option value="2" @if($item->getState()->getState() === 2)selected @endif>Denied</option>
                              <option value="3" @if($item->getState()->getState() === 3)selected @endif>Not filled</option>
                              <option value="4" @if($item->getState()->getState() === 4)selected @endif>Closed</option>
                          </select>
                      </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Save Post') }}</button>
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
