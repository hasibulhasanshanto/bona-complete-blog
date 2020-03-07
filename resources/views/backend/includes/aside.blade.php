<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">
            <div class="image">
                <img src="{{ Storage::disk('public')->url('profile/'.Auth::user()->image) }}" width="50" height="50" alt="User" />
            </div>
            <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</div>
                <div class="email">{{ Auth::user()->email }}</div>
                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        <li>
                            @if ( Auth::user()->role_id == 1 )
                            <a href="{{ route('admin.settings')}}"><i class="material-icons">person</i>Profile</a>
                            @elseif(Auth::user()->role_id == 2)
                                <a href="{{ route('author.settings')}}"><i class="material-icons">person</i>Profile</a>
                            @else
                                <a href="#"><i class="material-icons">person</i>Profile</a>
                            @endif
                        </li> 
                        <li role="separator" class="divider"></li> 
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                        class="material-icons">input</i>
                                    Log Out
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li> 
                        
                        {{-- <li><a href="{{ route('logout') }}"><i class="material-icons">input</i>Log Out</a></li> --}}
                    </ul>
                </div>
            </div>
        </div>
        <!-- #User Info -->
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="header">MAIN NAVIGATION</li>

                {{-- Admin Dashboard Operation --}}
                @if (Request::is('admin*'))
                    <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                        <a href="{{ route('admin.dashboard')}}">
                            <i class="material-icons">dashboard</i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="{{ Request::is('admin/tag*') ? 'active' : '' }}">
                        <a href="{{ route('admin.tag.index')}}">
                            <i class="material-icons">label</i>
                            <span>All Tags</span>
                        </a> 
                    </li> 
                    
                    <li class="{{ Request::is('admin/category*') ? 'active' : '' }}">
                        <a href="{{ route('admin.category.index')}}">
                            <i class=" material-icons">shop_two</i>
                            <span>All Category</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('admin/post*') ? 'active' : '' }}">
                        <a href="{{ route('admin.post.index')}}">
                            <i class=" material-icons">art_track</i>
                            <span>All Post</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('admin/pending/post') ? 'active' : '' }}">
                        <a href="{{ route('admin.post.pending')}}">
                            <i class=" material-icons">grid_off</i>
                            <span>Pending Post</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('admin/favorite') ? 'active' : '' }}">
                        <a href="{{ route('admin.favorite.index')}}">
                            <i class=" material-icons">favorite</i>
                            <span>Favorite Post</span>
                        </a>
                    </li>

                    <li class="{{ Request::is('admin/comments') ? 'active' : '' }}">
                        <a href="{{ route('admin.comment.index')}}">
                            <i class=" material-icons">comment</i>
                            <span>Comments</span>
                        </a>
                    </li>

                    <li class="{{ Request::is('admin/subscriber') ? 'active' : '' }}">
                        <a href="{{ route('admin.subscriber.index')}}">
                            <i class=" material-icons">subscriptions</i>
                            <span>Subscribers</span>
                        </a>
                    </li> 
                    <li class="{{ Request::is('admin/authors*') ? 'active' : '' }}">
                        <a href="{{ route('admin.author.index')}}">
                            <i class="material-icons">message</i>
                            <span>Author's Post</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('admin/allauthors*') ? 'active' : '' }}">
                        <a href="{{ route('admin.allauthors.index')}}">
                            <i class="material-icons">face</i>
                            <span>All Authors</span>
                        </a>
                    </li>
                    <li class="header">SYSTEM</li> 
                    <li class="{{ Request::is('admin/settings*') ? 'active' : '' }}">
                        <a href="{{ route('admin.settings')}}">
                            <i class=" material-icons">settings</i>
                            <span>Settings</span>
                        </a>
                    </li>
                @endif
                {{-- End Admin Dashboard Operation --}}

                {{-- Author Dashboard Operation --}}
                @if (Request::is('author*'))
                    <li class="{{ Request::is('author/dashboard') ? 'active' : '' }}">
                        <a href="{{ route('author.dashboard')}}">
                            <i class="material-icons">dashboard</i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="{{ Request::is('author/post*') ? 'active' : '' }}">
                        <a href="{{ route('author.post.index')}}">
                            <i class=" material-icons">art_track</i>
                            <span>Post</span>
                        </a>
                    </li> 

                    <li class="{{ Request::is('author/comments') ? 'active' : '' }}">
                        <a href="{{ route('author.comment.index')}}">
                            <i class=" material-icons">comment</i>
                            <span>Comments</span>
                        </a>
                    </li>

                    <li class="{{ Request::is('author/favorite') ? 'active' : '' }}">
                        <a href="{{ route('author.favorite.index')}}">
                            <i class=" material-icons">favorite</i>
                            <span>Favorite Post</span>
                        </a>
                    </li>

                    <li class="header">SYSTEM</li> 
                    <li class="{{ Request::is('author/settings*') ? 'active' : '' }}">
                        <a href="{{ route('author.settings')}}">
                            <i class=" material-icons">settings</i>
                            <span>Settings</span>
                        </a>
                    </li>          
                @endif
                {{-- End Author Dashboard Operation --}}

                {{-- User Dashboard Operation --}}
                @if (Request::is('home*'))
                    <li class="{{ Request::is('home') ? 'active' : '' }}">
                        <a href="{{ route('home')}}">
                            <i class="material-icons">dashboard</i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="{{ Request::is('home/settings') ? 'active' : '' }}">
                        <a href="{{ route('user.settings')}}">
                            <i class=" material-icons">settings</i>
                            <span>Profile Settings</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('home/favorite') ? 'active' : '' }}">
                        <a href="{{ route('user.favorite')}}">
                            <i class=" material-icons">favorite</i>
                            <span>Favorite Post</span>
                        </a>
                    </li>
                    <li class="header">SYSTEM</li>
                @endif
                {{-- End User Dashboard Operation --}}
                
                
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                        class="material-icons">input</i>
                    <span>Log Out</span>
                    </a>
                    <form id="logout-form2" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                     
                </li>

            </ul>
        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                &copy; 2019 <a href="javascript:void(0);">Bona Blog</a>.
            </div>
        </div>
        <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->
</section>