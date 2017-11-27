<ul class="nav navbar-nav">
     <li class="@if(Request::path() == 'backend/dashboard') active @endif"><a title="{{ trans('backend.nav.dashboard') }}" alt="{{ trans('backend.nav.dashboard') }} " href="{{ route('dashboard') }}"> {{ trans('backend.nav.dashboard') }} <span class="sr-only">(current)</span></a></li>
     
     <li class="dropdown">
         <a href="#" alt="{{ trans('backend.nav.participants.menu') }}" title="{{ trans('backend.nav.participants.menu') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ trans('backend.nav.participants.menu') }} <span class="caret"></span></a>
         <ul class="dropdown-menu" role="menu">
             <li class="dropdown-submenu">
                 <a tabindex="-1" href="#" alt="{{ trans('backend.nav.participants.register_log') }}" title="{{ trans('backend.nav.participants.register_log') }}">{{ trans('backend.nav.participants.register_log') }} <span class="sr-only">(current)</span></a>
                 <ul class="dropdown-menu">
                    @foreach ($castings as $casting)
                     <li class="@if(Request::get('casting_id') == $casting->id) active @endif">
                        <a href="{{ route('applicants.index',['casting_id'=>$casting->id]) }}" alt="{{trans('backend.applicant.index.tab_title_'.$casting->key.'')}}" title="{{trans('backend.applicant.index.tab_title_'.$casting->key.'')}}">{{trans('backend.applicant.index.tab_title_'.$casting->key.'')}} <span class="sr-only">(current)</span></a>      
                     </li>
                    @endforeach
                 </ul>
             </li>
             <li class="@if(Request::path() == 'backend/precandidates') active @endif">
                 <a href="{{ route('precandidates.index') }}" alt="{{ trans('backend.nav.participants.precandidate') }}" title="{{ trans('backend.nav.participants.precandidate') }}">{{ trans('backend.nav.participants.precandidate') }} <span class="sr-only">(current)</span></a>
             </li>
             <li class="@if(Request::path() == 'backend/misses') active @endif">
                 <a href="{{ route('misses.index') }}" alt="{{ trans('backend.nav.participants.candidates') }}" title="{{ trans('backend.nav.participants.candidates') }}">{{ trans('backend.nav.participants.candidates') }} <span class="sr-only">(current)</span></a>
             </li>
         </ul>
     </li>
     
     <li class="dropdown">
         <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" alt="{{ trans('backend.nav.members.menu') }}" title="{{ trans('backend.nav.members.menu') }}">{{ trans('backend.nav.members.menu') }} <span class="caret"></span></a>
         <ul class="dropdown-menu" role="menu">
             <li class="@if(Request::path() == 'backend/clients') active @endif">
                 <a href="{{ route('clients.index') }}" alt="{{ trans('backend.nav.members.list') }}" title="{{ trans('backend.nav.members.list') }}">{{ trans('backend.nav.members.list') }} <span class="sr-only">(current)</span></a>
             </li>
              <li class="@if(Request::path() == 'backend/activities') active @endif"><a href="{{ route('activities.index') }}" alt="{{ trans('backend.nav.members.activities') }}" title="{{ trans('backend.nav.members.activities') }}">{{ trans('backend.nav.members.activities') }}<span class="sr-only">(current)</span></a></li>
         </ul>
     </li>
     
     <li class="dropdown">
         <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" alt="{{ trans('backend.nav.config.menu') }}" title="{{ trans('backend.nav.config.menu') }}">{{ trans('backend.nav.config.menu') }} <span class="caret"></span></a>
         <ul class="dropdown-menu" role="menu">
            <li class="@if(Request::path() == 'backend/config') active @endif"><a href="{{ route('config.index') }}" alt="{{ trans('backend.nav.config.config') }}" title="{{ trans('backend.nav.config.config') }}">{{ trans('backend.nav.config.config') }}  <span class="sr-only">(current)</span></a></li>
             <li class="@if(Request::path() == 'backend/users') active @endif"><a href="{{ route('users.index') }}" alt="{{ trans('backend.nav.config.users') }}" title="{{ trans('backend.nav.config.users') }}">{{ trans('backend.nav.config.users') }} <span class="sr-only">(current)</span></a></li>
             <li class="@if(Request::path() == 'backend/memberships') active @endif"><a href="{{ route('memberships.index') }}" alt="{{ trans('backend.nav.config.membership') }}" title="{{ trans('backend.nav.config.membership') }}">{{ trans('backend.nav.config.membership') }}  <span class="sr-only">(current)</span></a></li>
             <li class="@if(Request::path() == 'backend/countries') active @endif"><a href="{{ route('countries.index') }}" alt="{{ trans('backend.nav.config.countries') }}" title="{{ trans('backend.nav.config.countries') }}">{{ trans('backend.nav.config.countries') }}  <span class="sr-only">(current)</span></a></li>
         </ul>
     </li>
 </ul>