async function fetchData(countryName = 'a') {
    const url = 'https://restcountries.com/v3.1/name/' + countryName + '?fields=flags&fields=name';
    try {
        const response = await fetch(url);
        if (!response.ok) {
            if (response.status === 404) {
                // Handle 404 error here
                console.warn('Country not found:', countryName);
                return []; // Return empty array or handle it according to your use case
            }
            throw new Error('Network response was not ok');
        }
        const data = await response.json();
        return data
    } catch (error) {
        // Lakukan apa pun yang ingin Anda lakukan dengan data di sini
        return data
    }
}

// Panggil fungsi fetchData
// fetchData();
// const country = document.getElementById('country');
// country.addEventListener('change', (event) => {
//     fetchData(event.target.value);
// });
