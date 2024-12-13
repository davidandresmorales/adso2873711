const pokemonGrid = document.getElementById('pokemon-grid');
const searchInput = document.getElementById('search-input');
const pokemonModal = document.getElementById('pokemon-modal');
const modalClose = document.querySelector('.modal-close');
const pokemonDetails = document.getElementById('pokemon-details');

// Paleta de colores para tipos de Pokémon
const typeColors = {
    'normal': '#A8A878',
    'fire': '#F08030',
    'water': '#6890F0',
    'electric': '#F8D030',
    'grass': '#78C850',
    'ice': '#98D8D8',
    'fighting': '#C03028',
    'poison': '#A040A0',
    'ground': '#E0C068',
    'flying': '#A890F0',
    'psychic': '#F85888',
    'bug': '#A8B820',
    'rock': '#B8A038',
    'ghost': '#705898',
    'dragon': '#7038F8',
    'dark': '#705848',
    'steel': '#B8B8D0',
    'fairy': '#EE99AC'
};

// First generation Pokémon (1-151)
const fetchPokemon = async () => {
    pokemonGrid.innerHTML = '';
    const promises = [];
    
    for (let i = 1; i <= 151; i++) {
        promises.push(fetch(`https://pokeapi.co/api/v2/pokemon/${i}`).then(response => response.json()));
    }

    const pokemonData = await Promise.all(promises);
    displayPokemon(pokemonData);
};

const displayPokemon = (pokemons) => {
    pokemons.forEach(pokemon => {
        const pokemonCard = document.createElement('div');
        pokemonCard.classList.add('pokemon-card');
        
        // Crear elementos de tipos
        const typesHtml = pokemon.types.map(type => 
            `<span class="pokemon-type" style="background-color:${typeColors[type.type.name]}">${type.type.name}</span>`
        ).join('');

        pokemonCard.innerHTML = `
            <img src="${pokemon.sprites.other['official-artwork'].front_default}" alt="${pokemon.name}">
            <div class="pokemon-info">
                <p class="pokemon-id">#${pokemon.id.toString().padStart(3, '0')}</p>
                <h2 class="pokemon-name">${pokemon.name}</h2>
                <div class="pokemon-types">${typesHtml}</div>
            </div>
        `;
        pokemonCard.addEventListener('click', () => showPokemonDetails(pokemon));
        pokemonGrid.appendChild(pokemonCard);
    });
};

const showPokemonDetails = (pokemon) => {
    // Crear elementos de tipos para detalles
    const typesHtml = pokemon.types.map(type => 
        `<span class="pokemon-type" style="background-color:${typeColors[type.type.name]}">${type.type.name}</span>`
    ).join('');

    pokemonDetails.innerHTML = `
        <img src="${pokemon.sprites.other['official-artwork'].front_default}" alt="${pokemon.name}">
        <h2>${pokemon.name.toUpperCase()} #${pokemon.id.toString().padStart(3, '0')}</h2>
        <div class="pokemon-types">${typesHtml}</div>
        <div class="stat-container">
            ${pokemon.stats.map(stat => `
                <div class="stat-row">
                    <div class="stat-name">${stat.stat.name.toUpperCase()}</div>
                    <div class="stat-bar">
                        <div class="stat-bar-fill" style="width: ${(stat.base_stat / 255) * 100}%; background-color: ${getStatColor(stat.stat.name)}"></div>
                    </div>
                    <div class="stat-value">${stat.base_stat}</div>
                </div>
            `).join('')}
        </div>
    `;
    pokemonModal.style.display = 'flex';
};

const getStatColor = (statName) => {
    const colorMap = {
        'hp': '#FF5959',
        'attack': '#F5AC78',
        'defense': '#FAE078',
        'special-attack': '#9DB7F5',
        'special-defense': '#A7DB8D',
        'speed': '#FA92B2'
    };
    return colorMap[statName] || '#4CAF50';
};

modalClose.addEventListener('click', () => {
    pokemonModal.style.display = 'none';
});

searchInput.addEventListener('input', () => {
    const searchTerm = searchInput.value.toLowerCase();
    const pokemonCards = document.querySelectorAll('.pokemon-card');
    
    pokemonCards.forEach(card => {
        const pokemonName = card.querySelector('.pokemon-name').textContent.toLowerCase();
        const pokemonId = card.querySelector('.pokemon-id').textContent;
        
        if (pokemonName.includes(searchTerm) || pokemonId.includes(searchTerm)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
});

// Fetch Pokémon when page loads
fetchPokemon();