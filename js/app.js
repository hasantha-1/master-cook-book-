class RecipeApp {
    constructor() {
        this.initEventListeners();
        this.recipes = [];
        this.categories = [
            'Breakfast', 'Lunch', 'Dinner', 
            'Dessert', 'Vegetarian', 'Vegan', 
            'Gluten-Free', 'Quick Meals'
        ];
        this.loadInitialContent();
    }

    initEventListeners() {
        document.getElementById('searchBtn')?.addEventListener('click', this.searchRecipes.bind(this));
        document.getElementById('recipeSearch')?.addEventListener('keyup', (e) => {
            if (e.key === 'Enter') this.searchRecipes();
        });

        document.getElementById('loginBtn')?.addEventListener('click', this.openAuthModal.bind(this));
        document.getElementById('addRecipe')?.addEventListener('click', this.navigateToAddRecipe.bind(this));
        document.getElementById('myRecipes')?.addEventListener('click', this.navigateToMyRecipes.bind(this));
    }

    loadInitialContent() {
        this.populateCategories();
        this.fetchFeaturedRecipes();
        this.updateImages();
    }

    populateCategories() {
        const categoriesContainer = document.getElementById('categoriesContainer');
        if (categoriesContainer) {
            categoriesContainer.innerHTML = this.categories.map(category => `
                <div class="col-6 col-md-3 mb-4 text-center">
                    <div class="category-card" data-category="${category}">
                        <img src="${this.getPlaceholderImage(category)}" alt="${category}">
                        <h3 class="mt-3">${category}</h3>
                    </div>
                </div>
            `).join('');
        }
    }

    fetchFeaturedRecipes() {
        const featuredRecipes = [
            {
                id: 1,
                name: 'Spicy Vegetable Curry',
                difficulty: 'Medium',
                time: '45 mins'
            },
            {
                id: 2,
                name: 'Classic Chocolate Cake',
                difficulty: 'Easy',
                time: '60 mins'
            }
        ];

        const recipesContainer = document.getElementById('featuredRecipesContainer');
        if (recipesContainer) {
            recipesContainer.innerHTML = featuredRecipes.map(recipe => `
                <div class="col-md-6 mb-4">
                    <div class="recipe-card card">
                        <img src="https://i.etsystatic.com/9684337/r/il/5c0f82/726795730/il_fullxfull.726795730_km9q.jpg" alt="${recipe.name}" class="card-img-top">
                        <div class="card-body">
                            <h3 class="card-title">${recipe.name}</h3>
                            <div class="d-flex justify-content-between">
                                <span>Difficulty: ${recipe.difficulty}</span>
                                <span>Time: ${recipe.time}</span>
                            </div>
                            <button class="btn btn-primary mt-3">View Recipe</button>
                        </div>
                    </div>
                </div>
            `).join('');
        }
    }

    getPlaceholderImage(category) {
        const placeholders = {
            'Breakfast': 'https://images.services.kitchenstories.io/gxInWDQniM21aQiVgvnXmDrMnvo=/3840x0/filters:quality(85)/images.kitchenstories.io/communityImages/f4604e05f6a9eaca99afddd69e849005_c02485d4-0841-4de6-b152-69deb38693f2.jpg',
            'Lunch': 'https://simply-delicious-food.com/wp-content/uploads/2018/07/mexican-lunch-bowls-3.jpg', 
            'Dinner': 'https://images.immediate.co.uk/production/volatile/sites/30/2022/03/Quick-dinner-recipes-c7ca11c.jpg',
            'Dessert': 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/ab/Desserts.jpg/330px-Desserts.jpg',
            'Vegetarian': 'https://batonrougeclinic.com/wp-content/uploads/2021/10/Baldwin-10.-The-Pros-and-Cons-of-Vegetarian-Diets.jpg',
            'Vegan': 'https://images.immediate.co.uk/production/volatile/sites/30/2023/06/GettyImages-1416818056-6ecd1e0.jpg?quality=90&resize=556,505',
            'Gluten-Free': 'https://hips.hearstapps.com/hmg-prod/images/creamy-gochujang-white-chicken-chili1-1671199708.jpg',
            'Quick Meals': 'https://hips.hearstapps.com/hmg-prod/images/mexican-beef-n-rice-skillet1-1665593962.jpg?crop=0.668xw:1.00xh;0.212xw,0&resize=640:*'
        };
        return placeholders[category] || 'https://via.placeholder.com/100';
    }

    updateImages() {
        const categoryCards = document.querySelectorAll('.category-card img');
        categoryCards.forEach(img => {
            const category = img.closest('.category-card').dataset.category;
            img.src = this.getPlaceholderImage(category);
        });
    }

    searchRecipes() {
        const searchTerm = document.getElementById('recipeSearch').value.toLowerCase();
        alert(`Searching for: ${searchTerm}`);
    }

    openAuthModal() {
        const modal = new bootstrap.Modal(document.getElementById('authModal'));
        modal.show();
    }

    navigateToAddRecipe() {
        alert('Navigating to Add Recipe');
    }

    navigateToMyRecipes() {
        alert('Navigating to My Recipes');
    }
}

document.addEventListener('DOMContentLoaded', () => {
    new RecipeApp();

    
});