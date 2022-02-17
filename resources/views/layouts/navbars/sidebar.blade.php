<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text logo-mini">{{ _('WD') }}</a>
            <a href="#" class="simple-text logo-normal">{{ _('White Dashboard') }}</a>
        </div>
        <ul class="nav">
            <li @if ($pageSlug == 'dashboard') class="active " @endif>
                <a href="{{ route('home') }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ _('Dashboard') }}</p>
                </a>
            </li>
            <li>
                <a data-toggle="collapse" href="#laravel-examples" aria-expanded="true">
                    <i class="tim-icons icon-single-02" ></i>
                    <span class="nav-link-text" >{{ __('Usuários') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse show" id="laravel-examples">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'profile') class="active " @endif>
                            <a href="{{ route('profile.edit')  }}">
                                <i class="tim-icons icon-single-02"></i>
                                <p>{{ _('User Profile') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'users') class="active " @endif>
                            <a href="{{ route('user.index')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ _('User Management') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a data-toggle="collapse" href="#noticias">
                    <i class="tim-icons icon-world" ></i>
                    <span class="nav-link-text" >{{ __('Noticias') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse show" id="noticias">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'noticia') class="active " @endif>
                            <a href="{{ route('noticia.add')  }}">
                                <i class="tim-icons icon-caps-small"></i>
                                <p>{{ _('Cadastrar Notícia') }}</p>
                            </a>
                        </li>

                        <li @if ($pageSlug == 'noticias') class="active " @endif>
                            <a href="{{ route('noticia.index')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ _('Noticia Management') }}</p>
                            </a>
                        </li>
                       
                    </ul>
                </div>
            </li>
       
     
   
         
        
           
           
        </ul>
    </div>
</div>
