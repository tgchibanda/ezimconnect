@php
    $userData = App\Helpers\ProfileHelper::GetAuthUserData();      
    $titleAndFolderPath = $userData->getTitleAndFolderPath();
    $folderPath = $titleAndFolderPath['folderPath'];
    $title = $titleAndFolderPath['title'];
@endphp
<header>
    <div class="topbar d-flex align-items-center">
        <nav class="navbar navbar-expand">
            <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
            </div>
            <div class="search-bar flex-grow-1">
                <div class="position-relative search-bar-box">
                    <input type="text" class="form-control search-control" placeholder="Type to search..."> <span class="position-absolute top-50 search-show translate-middle-y"><i class='bx bx-search'></i></span>
                    <span class="position-absolute top-50 search-close translate-middle-y"><i class='bx bx-x'></i></span>
                </div>
            </div>
            <div class="top-menu ms-auto">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item mobile-search-icon">
                        <a class="nav-link" href="#"> <i class='bx bx-search'></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown dropdown-large">
                        
                        
                    </li>
                    <li class="nav-item dropdown dropdown-large">
                        
                        <div class="dropdown-menu dropdown-menu-end">
                            
                            <div class="header-notifications-list">
                                
                                
                            </div>
                            <a href="javascript:;">
                                
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown dropdown-large">
                        
                        <div class="dropdown-menu dropdown-menu-end">
                            
                            <div class="header-message-list">
                                
                                
                            </div>
                            
                        </div>
                    </li>
                </ul>
            </div>
            
            <div class="user-box dropdown">
                <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">

                <img src="{{ !empty($userData->photo) ? asset($userData->photo) : asset('upload/no_image.jpg') }}"  class="user-img" height="10" width="20" alt="user avatar">
                    
                    
                    <div class="user-info ps-3">
                        <p class="user-name mb-0">{{ Auth::user()->name }}</p>
                        <p class="designattion mb-0">{{ Auth::user()->username }}</p>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ route('index.profile')  }}"><i class="bx bx-user"></i><span>Profile</span></a>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('index.change.password') }}"><i class="bx bx-cog"></i><span>Change Password</span></a>
                    </li>
                    <li>
                        <div class="dropdown-divider mb-0"></div>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('index.logout') }}"><i class='bx bx-log-out-circle'></i><span>Logout</span></a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>