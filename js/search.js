class RecipeSearch {
    constructor() {
        this.recipes = [
            {
                id: 1,
                name: 'Spicy Vegetable Curry',
                category: 'dinner',
                cuisine: 'Indian',
                ingredients: ['vegetables', 'curry paste', 'coconut milk'],
                difficulty: 'Medium',
                time: '45 mins',
                image: 'https://example.com/curry.jpg'
            },
            {
                id: 2,
                name: 'Classic Chocolate Cake',
                category: 'dessert',
                cuisine: 'American',
                ingredients: ['flour', 'sugar', 'cocoa', 'eggs'],
                difficulty: 'Easy',
                time: '60 mins',
                image: 'https://example.com/cake.jpg'
            },
            {
                id: 3,
                name: 'Vegetarian Buddha Bowl',
                category: 'lunch',
                cuisine: 'Fusion',
                ingredients: ['quinoa', 'roasted vegetables', 'hummus'],
                difficulty: 'Easy',
                time: '30 mins',
                image: 'https://example.com/buddha-bowl.jpg'
            }
        ];

        this.initEventListeners();
    }

    initEventListeners() {
        const searchBtn = document.getElementById('searchBtn');
        const searchInput = document.getElementById('recipeSearch');
        const categoryFilter = document.getElementById('categoryFilter');

        searchBtn?.addEventListener('click', () => this.performSearch());
        searchInput?.addEventListener('keyup', (e) => {
            if (e.key === 'Enter') this.performSearch();
        });
        categoryFilter?.addEventListener('change', () => this.performSearch());
    }

    performSearch() {
        const searchTerm = document.getElementById('recipeSearch').value.toLowerCase();
        const categoryFilter = document.getElementById('categoryFilter').value.toLowerCase();
        const resultsContainer = document.getElementById('recipesContainer');
        const resultsHeader = document.getElementById('resultsHeader');

        const filteredRecipes = this.recipes.filter(recipe => 
            (searchTerm === '' || 
                recipe.name.toLowerCase().includes(searchTerm) || 
                recipe.ingredients.some(ing => ing.toLowerCase().includes(searchTerm)) ||
                recipe.cuisine.toLowerCase().includes(searchTerm)
            ) &&
            (categoryFilter === '' || recipe.category === categoryFilter)
        );

        resultsHeader.textContent = `${filteredRecipes.length} Recipe${filteredRecipes.length !== 1 ? 's' : ''} Found`;

        resultsContainer.innerHTML = filteredRecipes.length > 0 
            ? filteredRecipes.map(recipe => this.createRecipeCard(recipe)).join('')
            : '<p class="text-center w-100">No recipes found. Try a different search.</p>';
    }

    createRecipeCard(recipe) {
        return `
            <div class="col-md-4 mb-4">
                <div class="card recipe-card">
                    <img src="${recipe.image}" alt="${recipe.name}" class="card-img-top">
                    <div class="card-body">
                        <h3 class="card-title">${recipe.name}</h3>
                        <div class="recipe-details">
                            <span class="badge bg-secondary">${recipe.category}</span>
                            <span class="badge bg-info">${recipe.cuisine}</span>
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <span>Difficulty: ${recipe.difficulty}</span>
                            <span>Time: ${recipe.time}</span>
                        </div>
                        <button class="btn btn-primary mt-3">View Recipe</button>
                    </div>
                </div>
            </div>
        `;
    }
}

document.addEventListener('DOMContentLoaded', () => {
    new RecipeSearch();
});