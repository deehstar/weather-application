<nav class="bg-gray-800 text-white p-4">
    <ul class="flex space-x-4">
        <li><a href="{{ route('weather.show', 'Odense') }}" class="hover:text-yellow-300">Odense</a></li>
        <li><a href="{{ route('weather.show', 'Copenhagen') }}" class="hover:text-yellow-300">Copenhagen</a></li>
        <li><a href="{{ route('weather.show', 'Aarhus') }}" class="hover:text-yellow-300">Aarhus</a></li>
        <li><a href="{{ route('weather.show', 'Aalborg') }}" class="hover:text-yellow-300">Aalborg</a></li>
        <li><a href="{{ route('weather.show', 'Esbjerg') }}" class="hover:text-yellow-300">Esbjerg</a></li>
    </ul>
</nav>
