class AddRecipeForm {
    constructor() {
        this.form = document.getElementById('addRecipeForm');
        this.ingredientsContainer = document.getElementById('ingredientsContainer');
        this.addIngredientBtn = document.getElementById('addIngredientBtn');

        this.initEventListeners();
    }

    initEventListeners() {
        this.addIngredientBtn.addEventListener('click', () => this.addIngredientField());
        this.ingredientsContainer.addEventListener('click', (e) => {
            if (e.target.classList.contains('remove-ingredient')) {
                this.removeIngredientField(e.target.closest('.input-group'));
            }
        });
        this.form.addEventListener('submit', (e) => this.handleSubmit(e));
    }

    addIngredientField() {
        const newIngredientGroup = document.createElement('div');
        newIngredientGroup.className = 'input-group mb-2';
        newIngredientGroup.innerHTML = `
            <input type="text" class="form-control ingredient-input" placeholder="Enter ingredient">
            <button class="btn btn-outline-secondary remove-ingredient" type="button">Remove</button>
        `;
        this.ingredientsContainer.appendChild(newIngredientGroup);
    }

    removeIngredientField(ingredientGroup) {
        if (this.ingredientsContainer.children.length > 1) {
            ingredientGroup.remove();
        }
    }

    handleSubmit(e) {
        e.preventDefault();

        // Collect form data
        const recipeName = document.getElementById('recipeName').value;
        const recipeCategory = document.getElementById('recipeCategory').value;
        const ingredients = Array.from(document.querySelectorAll('.ingredient-input'))
            .map(input => input.value)
            .filter(value => value.trim() !== '');
        const instructions = document.getElementById('instructions').value;
        const cookingTime = document.getElementById('cookingTime').value;
        const difficulty = document.getElementById('difficulty').value;

        // Basic validation
        if (!recipeName || !recipeCategory || ingredients.length === 0 || !instructions) {
            alert('Please fill in all required fields');
            return;
        }

        // Prepare recipe object
        const newRecipe = {
            name: recipeName,
            category: recipeCategory,
            ingredients: ingredients,
            instructions: instructions,
            cookingTime: cookingTime,
            difficulty: difficulty
        };

        // Here you would typically send the recipe to a backend API
        console.log('New Recipe:', newRecipe);
        alert('Recipe submitted successfully!');
        
        // Reset form
        this.form.reset();
    }
}

document.addEventListener('DOMContentLoaded', () => {
    new AddRecipeForm();
});