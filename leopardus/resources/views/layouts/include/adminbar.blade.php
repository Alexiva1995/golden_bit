<div class="admin-panel">
    <ul class="list pull-right" role="tablist"> 
        <li>
            <a href="{{ route('admin.index') }}">Panel de administración</a>
        </li> 
        <li class="dropdown"> 
            <a href="#" class="dropdown-toggle" id="drop4" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> {{ Auth::user()->display_name }} <span class="caret"></span> </a> 
            <ul class="dropdown-menu dropdown-menu-right" id="menu1" aria-labelledby="drop4"> 
                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="icon-key" style="margin-left: -10px;margin-right: 15px;"></i> Cerrar Sesión </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                  </li>
            </ul> 
        </li> 
    </ul>
    <div class="clearfix"></div>
</div>