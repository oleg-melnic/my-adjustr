<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="https://creative-tim.com/" class="simple-text logo-normal">
      {{ __('My Adjustr') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
        <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('home') }}">
              <i class="material-icons">dashboard</i>
                <p>{{ __('Dashboard') }}</p>
            </a>
        </li>
        @role('admin')
        <li class="nav-item {{ ($activePage == 'faq-management' || $activePage == 'faq-category-management') ? ' active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#faqSubmenu" aria-expanded="true">
                <i class="material-icons">help</i>
                <p>{{ __('FAQ') }}
                    <b class="caret"></b>
                </p>
            </a>
            <div class="collapse{{ ($activePage == 'faq-management' || $activePage == 'faq-category-management') ? ' show' : '' }}" id="faqSubmenu">
                <ul class="nav">
                    <li class="nav-item{{ $activePage == 'faq-management' ? ' active' : '' }}">
                        <a class="nav-link" href="{{ route('faq-management') }}">
                            <span class="sidebar-mini"> Q </span>
                            <span class="sidebar-normal">{{ __('Questions') }} </span>
                        </a>
                    </li>
                    <li class="nav-item{{ $activePage == 'faq-category-management' ? ' active' : '' }}">
                        <a class="nav-link" href="{{ route('faq-category-management') }}">
                            <span class="sidebar-mini"> C </span>
                            <span class="sidebar-normal">{{ __('Categories') }} </span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item {{ ($activePage == 'blog-management' || $activePage == 'blog-category-management') ? ' active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#blogSubmenu" aria-expanded="true">
                <i class="material-icons">list</i>
                <p>{{ __('Blog') }}
                    <b class="caret"></b>
                </p>
            </a>
            <div class="collapse{{ ($activePage == 'blog-management' || $activePage == 'blog-category-management') ? ' show' : '' }}" id="blogSubmenu">
                <ul class="nav">
                    <li class="nav-item{{ $activePage == 'blog-management' ? ' active' : '' }}">
                        <a class="nav-link" href="{{ route('blog-management') }}">
                            <span class="sidebar-mini"> P </span>
                            <span class="sidebar-normal">{{ __('Posts') }} </span>
                        </a>
                    </li>
                    <li class="nav-item{{ $activePage == 'blog-category-management' ? ' active' : '' }}">
                        <a class="nav-link" href="{{ route('blog-category-management') }}">
                            <span class="sidebar-mini"> C </span>
                            <span class="sidebar-normal">{{ __('Categories') }} </span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        @endrole
        <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('profile.edit') }}">
                <i class="material-icons">account_box</i>
                <p>{{ __('User profile') }}</p>
            </a>
        </li>
        @role('admin')
        <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
            <a class="nav-link" href="/users">
                <i class="material-icons">people</i>
                <p>{{ __('User Management') }}</p>
            </a>
        </li>
{{--        <li class="nav-item{{ $activePage == 'roles' ? ' active' : '' }}">--}}
{{--            <a class="nav-link" href="/roles">--}}
{{--                <i class="material-icons">people</i>--}}
{{--                <p>{{ __('Roles Management') }}</p>--}}
{{--            </a>--}}
{{--        </li>--}}
        @endrole
    </ul>
  </div>
</div>
