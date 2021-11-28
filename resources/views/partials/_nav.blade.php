<div class="md:hidden flex items-center">
    <button class="outline-none mobile-menu-button">
        <svg
            class="w-6 h-6 text-gray-500"
            x-show="!showMenu"
            fill="none"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            viewBox="0 0 24 24"
            stroke="currentColor"
        >
            <path d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </button>

    <div class="hidden mobile-menu">
        <ul class="">
            <li class="active"><a href="{{route('record.index')}}" class="block text-sm px-2 py-4 text-white bg-green-500 font-semibold">Home</a></li>
            <li><a href="#" class="block text-sm px-2 py-4 hover:bg-green-500 transition duration-300">New Record</a></li>
        </ul>
    </div>
</div>

<nav class="bg-white shadow-lg">
    <div class="hidden md:block max-w-6xl mx-auto px-4">
        <div class="flex justify-between">
            <div class="flex space-x-7">
                <div>
                    <a href="{{route('record.index')}}" class="flex items-center uppercase py-4 px-2">
                        call records
                    </a>
                </div>

                <div class="hidden md:flex items-center space-x-1">
                    <a href="{{route('record.index')}}"
                       class="py-4 px-2 font-semibold transition duration-300 {{\Illuminate\Support\Facades\Request::routeIs('record.index') ? 'active-nav-link' : 'inactive-nav-link'}}"
                    >Home</a>
                    <a href="{{route('record.create')}}"
                       class="py-4 px-2 font-semibold transition duration-300 {{\Illuminate\Support\Facades\Request::routeIs('record.create') || \Illuminate\Support\Facades\Request::routeIs('record.view') ? 'active-nav-link' : 'inactive-nav-link'}}"
                    >Record</a>
                </div>
            </div>
        </div>
    </div>
</nav>
