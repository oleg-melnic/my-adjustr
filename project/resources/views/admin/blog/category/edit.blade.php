@extends('layouts.app', ['activePage' => 'blog-category-management', 'titlePage' => __('Blog Categories Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('blog-category-update') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')
              <input type="hidden" name="categoryId" value="{{ $item->getIdentity() }}">

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Edit Blog Category') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('blog-category-management') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Title') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" id="input-title" type="text" placeholder="{{ __('Title') }}" value="{{ $item->getTitle() }}" required="true" aria-required="true"/>
                      @if ($errors->has('title'))
                        <span id="title-error" class="error text-danger" for="input-title">{{ $errors->first('title') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Alias') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('alias') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('alias') ? ' is-invalid' : '' }}"
                               style="width: 90%; float: left;"
                               name="alias"
                               id="input-alias"
                               type="text"
                               placeholder="{{ __('Alias') }}"
                               value="{{ $item->getAlias() }}"
                               required="true"
                               aria-required="true"
                               @if ($item->isLockAlias())readonly style="background-color:#f6f6f5;"@endif
                        />
                        <img src=@if ($item->isLockAlias())
                                "/material/img/lock_on22.png"
                            @else
                                "/material/img/lock_off22.png"
                            @endif
                            style="padding-top: 10px; cursor:pointer; float: right;" onclick="lockLabelInput(this);"/>
                        <input type="hidden" value="{{ $item->isLockAlias() }}" name="lockalias" id="lock_alias_field"/>
                      @if ($errors->has('alias'))
                        <span id="alias-error" class="error text-danger" for="input-alias">{{ $errors->first('alias') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Text') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('text') ? ' has-danger' : '' }}">
                        <textarea id="editor" name="text" style="min-height: 500px;">{{ $item->getText() }}</textarea>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Save Category') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
    <script src="{{ asset('material') }}/js/translit.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
    <script>
        $('document').ready(function(){
            Translit.setToLower(true);
            Translit.set('input[name="title"]', 'input[name="alias"]');
        });

        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            });

        function lockLabelInput(obj) {
            if($('input[name="alias"]').length > 0 && $('input[name="alias"]').val() == "") {
                alert('Empty alias!');
                return;
            }

            var label_field = $('input[name="alias"]');

            if (obj.src.toString().indexOf('lock_off') != -1) {
                obj.src = "/material/img/lock_on22.png";
                label_field.css({'background-color' : '#f6f6f5'}).attr('readonly', true);
                $('#lock_alias_field').val('1');
                $('.button_tr').each(function(){
                    $(this).attr('disabled','disabled');
                });
            } else {
                obj.src = "/material/img/lock_off22.png";
                label_field.css({'background-color' : 'transparent'}).attr('readonly', false);
                $('#lock_alias_field').val('0');
                $('.button_tr').each(function(){
                    $(this).removeAttr('disabled');
                });
            }
        }
    </script>
@endpush
