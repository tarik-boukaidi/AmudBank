<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyBank - User Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/client.css') }}">
     @yield('styles')
</head>

<body>
    <header>
        <div class="container header-container">
            <div class="logo">
            <img src="{{ asset('logo.png') }}" alt="Image">
            <span>AmurBank</span>
            </div>
            <nav>
                <ul>
                    <li><a href="#"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li><a href="#"><i class="fas fa-credit-card"></i> Cards</a></li>
                    <li><a href="#"><i class="fas fa-exchange-alt"></i> Transfers</a></li>
                    <li><a href="#" class="active"><i class="fas fa-user"></i> Profile</a></li>
                    <li>                
                    <a href="#"
                    onclick="handleLogout(event)">
                    <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                
                    </li>
                </ul>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </nav>
        </div>
    </header>

    <div class="container">
        <div class="profile-container">
            <div class="profile-sidebar">
                <!-- <div class="profile-header">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Profile Picture" class="profile-pic">
                    <h3 class="profile-name">John Doe</h3>
                    <p class="profile-email">john.doe@example.com</p>
                    <button class="btn btn-primary"><i class="fas fa-camera"></i> Change Photo</button>
                </div> -->
                <ul class="profile-menu">
                    <li><a href="{{ route('client') }}" class="{{ request()->routeIs('client') ? 'active' : '' }}"><i class="fas fa-chart-pie"></i> Overview</a></li>
                    <li><a href="{{ route('accounts') }}" class="{{ request()->routeIs('accounts') ? 'active' : '' }}"><i class="fas fa-wallet"></i> Accounts</a></li>
                    <li><a href="{{ route('transactions') }}" class="{{ request()->routeIs('transactions') ? 'active' : '' }}"><i class="fas fa-exchange-alt"></i> Transactions</a></li>
                    <li><a href="{{ route('transactionsHistory') }}" class="{{ request()->routeIs('transactionsHistory') ? 'active' : '' }}"><i class="fas fa-exchange-alt"></i> Transaction History </a></li>
                    <li><a href="{{ route('settings') }}" class="{{ request()->routeIs('settings') ? 'active' : '' }}"><i class="fas fa-cog"></i> Settings</a></li>
                </ul>
            </div>

            <div class="profile-content">

                <!-- Transactions Tab -->
                @yield('content')

            

                <!-- Security Tab -->
                <!-- <div id="security" class="tab-content">
                    <h2 class="section-title"><i class="fas fa-shield-alt"></i> Security Settings</h2>
                    <div style="background-color: var(--light-color); padding: 20px; border-radius: 8px; margin-bottom: 20px;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                            <div>
                                <p style="font-weight: 500;">Password</p>
                                <p style="font-size: 14px; color: #7f8c8d;">Last changed 3 months ago</p>
                            </div>
                            <button class="btn btn-primary">Change Password</button>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                            <div>
                                <p style="font-weight: 500;">Two-Factor Authentication</p>
                                <p style="font-size: 14px; color: #7f8c8d;">Add an extra layer of security</p>
                            </div>
                            <label class="switch">
                                <input type="checkbox" checked>
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div>
                                <p style="font-weight: 500;">Login Alerts</p>
                                <p style="font-size: 14px; color: #7f8c8d;">Get notified of new logins</p>
                            </div>
                            <label class="switch">
                                <input type="checkbox" checked>
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>

                    <h3 class="section-title"><i class="fas fa-lock"></i> Active Sessions</h3>
                    <table class="transaction-table" style="margin-bottom: 20px;">
                        <thead>
                            <tr>
                                <th>Device</th>
                                <th>Location</th>
                                <th>Last Active</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Chrome on Windows</td>
                                <td>New York, USA</td>
                                <td>Just now</td>
                                <td><button class="btn btn-sm" style="color: var(--accent-color);">Logout</button></td>
                            </tr>
                            <tr>
                                <td>Safari on iPhone</td>
                                <td>Boston, USA</td>
                                <td>2 hours ago</td>
                                <td><button class="btn btn-sm" style="color: var(--accent-color);">Logout</button></td>
                            </tr>
                            <tr>
                                <td>Firefox on Mac</td>
                                <td>San Francisco, USA</td>
                                <td>1 week ago</td>
                                <td><button class="btn btn-sm" style="color: var(--accent-color);">Logout</button></td>
                            </tr>
                        </tbody>
                    </table>

                    <button class="btn" style="color: var(--accent-color);"><i class="fas fa-sign-out-alt"></i> Logout All Devices</button>
                </div>
            </div> -->
        </div>
    </div>
     <!-- <script src="{{ asset('js/client.js') }}"></script> -->
<script>
    function handleLogout(event) {
    event.preventDefault();

    // Définir 'menuactive' dans localStorage
    localStorage.setItem('menuactive', 'overview');

    // Soumettre le formulaire de logout
    document.getElementById('logout-form').submit();
}

    </script>
</body>
</html>