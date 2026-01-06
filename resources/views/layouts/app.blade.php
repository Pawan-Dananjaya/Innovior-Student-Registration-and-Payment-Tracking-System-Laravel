<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Innovior Student Management System')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @stack('styles')
</head>
<body class="bg-gray-100">
    @if(auth()->check())
    <nav class="bg-blue-600 text-white shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-4">
                    <h1 class="text-2xl font-bold">Innovior Student System</h1>
                    <span class="px-3 py-1 bg-blue-700 rounded-full text-sm">
                        {{ auth()->user()->isAdmin() ? 'Admin' : 'Reception' }}
                    </span>
                </div>
                <div class="flex items-center space-x-6">
                    <span class="text-sm">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded">
                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="flex">
        <aside class="w-64 bg-white h-screen shadow-md">
            <div class="p-4">
                @if(auth()->user()->isAdmin())
                <nav class="space-y-2">
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 hover:bg-blue-50 rounded {{ request()->routeIs('admin.dashboard') ? 'bg-blue-100 text-blue-600' : '' }}">
                        <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                    </a>
                    <a href="{{ route('admin.students') }}" class="block px-4 py-2 hover:bg-blue-50 rounded {{ request()->routeIs('admin.students') ? 'bg-blue-100 text-blue-600' : '' }}">
                        <i class="fas fa-users mr-2"></i>Students
                    </a>
                    <a href="{{ route('admin.payments') }}" class="block px-4 py-2 hover:bg-blue-50 rounded {{ request()->routeIs('admin.payments') ? 'bg-blue-100 text-blue-600' : '' }}">
                        <i class="fas fa-dollar-sign mr-2"></i>Payments
                    </a>
                    <a href="{{ route('admin.attendance') }}" class="block px-4 py-2 hover:bg-blue-50 rounded {{ request()->routeIs('admin.attendance') ? 'bg-blue-100 text-blue-600' : '' }}">
                        <i class="fas fa-calendar-check mr-2"></i>Attendance
                    </a>
                    <a href="{{ route('admin.reports') }}" class="block px-4 py-2 hover:bg-blue-50 rounded {{ request()->routeIs('admin.reports') ? 'bg-blue-100 text-blue-600' : '' }}">
                        <i class="fas fa-file-pdf mr-2"></i>Reports
                    </a>
                </nav>
                @else
                <nav class="space-y-2">
                    <a href="{{ route('reception.dashboard') }}" class="block px-4 py-2 hover:bg-blue-50 rounded {{ request()->routeIs('reception.dashboard') ? 'bg-blue-100 text-blue-600' : '' }}">
                        <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                    </a>
                    <a href="{{ route('reception.register.student') }}" class="block px-4 py-2 hover:bg-blue-50 rounded {{ request()->routeIs('reception.register.student') ? 'bg-blue-100 text-blue-600' : '' }}">
                        <i class="fas fa-user-plus mr-2"></i>Register Student
                    </a>
                    <a href="{{ route('reception.students') }}" class="block px-4 py-2 hover:bg-blue-50 rounded {{ request()->routeIs('reception.students') ? 'bg-blue-100 text-blue-600' : '' }}">
                        <i class="fas fa-users mr-2"></i>Students
                    </a>
                    <a href="{{ route('reception.record.payment') }}" class="block px-4 py-2 hover:bg-blue-50 rounded {{ request()->routeIs('reception.record.payment') ? 'bg-blue-100 text-blue-600' : '' }}">
                        <i class="fas fa-money-bill mr-2"></i>Record Payment
                    </a>
                    <a href="{{ route('reception.payments') }}" class="block px-4 py-2 hover:bg-blue-50 rounded {{ request()->routeIs('reception.payments') ? 'bg-blue-100 text-blue-600' : '' }}">
                        <i class="fas fa-list mr-2"></i>View Payments
                    </a>
                    <a href="{{ route('reception.qr.scanner') }}" class="block px-4 py-2 hover:bg-blue-50 rounded {{ request()->routeIs('reception.qr.scanner') ? 'bg-blue-100 text-blue-600' : '' }}">
                        <i class="fas fa-qrcode mr-2"></i>QR Scanner
                    </a>
                </nav>
                @endif
            </div>
        </aside>

        <main class="flex-1 p-8">
            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
            @endif

            @yield('content')
        </main>
    </div>
    @else
    <main>
        @yield('content')
    </main>
    @endif

    @stack('scripts')
</body>
</html>
