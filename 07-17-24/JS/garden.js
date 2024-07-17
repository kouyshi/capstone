function toggleContent(contentId) {
    var containers = document.querySelectorAll('.card-container');
    containers.forEach(function(container) {
        container.classList.toggle('active', container.id === contentId);
    });
}
toggleContent('planning');

// Weather

document.addEventListener('DOMContentLoaded', () => {
    const apiKey = '5655866bd861c678b8b865a61c4edfe1';

    function fetchWeather(lat, lon) {
        const apiUrl = `http://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&units=metric&appid=${apiKey}`;
        fetch(apiUrl)
            .then(response => response.json())
            .then(data => {
                const temperature = data.main.temp;
                const description = data.weather[0].description;
                const icon = data.weather[0].icon;
                const location = data.name;
                const date = new Date().toLocaleString('en-US', {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: 'numeric',
                    minute: 'numeric'
                });

                document.getElementById('location').textContent = location;
                document.getElementById('date').textContent = date;
                document.getElementById('temperature').textContent = `${temperature}°C`;
                document.getElementById('description').textContent = description.charAt(0).toUpperCase() + description.slice(1);
                document.getElementById('icon').src = `http://openweathermap.org/img/wn/${icon}.png`;
            })
            .catch(error => console.error('Error fetching the weather data:', error));
    }

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition((position) => {
                const lat = position.coords.latitude;
                const lon = position.coords.longitude;
                fetchWeather(lat, lon);
            }, (error) => {
                console.error('Error getting the location:', error);
                document.getElementById('location').textContent = 'Unable to identify location';
            });
        } else {
            console.error('Geolocation is not supported by this browser.');
            document.getElementById('location').textContent = 'Geolocation not supported';
        }
    }

    getLocation();
});
