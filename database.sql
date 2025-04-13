-- Create database
CREATE DATABASE IF NOT EXISTS flavor_fusion;
USE flavor_fusion;

-- Users table
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(50),
    bio TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    is_admin BOOLEAN DEFAULT FALSE,
    profile_image VARCHAR(255) DEFAULT 'default-avatar.png',
    email_verified BOOLEAN DEFAULT FALSE,
    verification_token VARCHAR(100),
    reset_token VARCHAR(100),
    reset_token_expires_at DATETIME
);


-- Recipe categories table
CREATE TABLE recipe_categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(50) NOT NULL,
    category_slug VARCHAR(50) NOT NULL UNIQUE,
    description TEXT
);

-- Insert default categories
INSERT INTO recipe_categories (category_name, category_slug, description) VALUES
('Main Course', 'main', 'Primary dishes typically served as the main dish of a meal'),
('Appetizers', 'appetizer', 'Small dishes served before a meal'),
('Desserts', 'dessert', 'Sweet dishes typically served after a meal'),
('Drinks', 'drink', 'Beverages of all types'),
('Breakfast', 'breakfast', 'Morning meal dishes'),
('Lunch', 'lunch', 'Midday meal options'),
('Dinner', 'dinner', 'Evening meal dishes'),
('Snacks', 'snack', 'Small portions of food between meals'),
('Salads', 'salad', 'Dishes with mixed ingredients, usually including vegetables'),
('Soups', 'soup', 'Liquid food typically served warm or hot'),
('Breads', 'bread', 'Baked dough products');

-- Difficulty levels table
CREATE TABLE difficulty_levels (
    difficulty_id INT AUTO_INCREMENT PRIMARY KEY,
    level_name VARCHAR(20) NOT NULL,
    level_slug VARCHAR(20) NOT NULL UNIQUE
);

-- Insert default difficulty levels
INSERT INTO difficulty_levels (level_name, level_slug) VALUES
('Easy', 'easy'),
('Medium', 'medium'),
('Hard', 'hard');

-- Recipes table
CREATE TABLE recipes (
    recipe_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(100) NOT NULL,
    slug VARCHAR(150) NOT NULL UNIQUE,
    description TEXT NOT NULL,
    category_id INT NOT NULL,
    difficulty_id INT NOT NULL,
    prep_time INT NOT NULL,
    cook_time INT NOT NULL,
    servings INT NOT NULL,
    calories INT,
    image_path VARCHAR(255) NOT NULL,
    notes TEXT,
    date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    date_updated TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
    is_approved BOOLEAN DEFAULT FALSE,
    view_count INT DEFAULT 0,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES recipe_categories(category_id),
    FOREIGN KEY (difficulty_id) REFERENCES difficulty_levels(difficulty_id)
);

-- Ingredients table
CREATE TABLE ingredients (
    ingredient_id INT AUTO_INCREMENT PRIMARY KEY,
    recipe_id INT NOT NULL,
    amount VARCHAR(50) NOT NULL,
    name VARCHAR(100) NOT NULL,
    display_order INT NOT NULL,
    FOREIGN KEY (recipe_id) REFERENCES recipes(recipe_id) ON DELETE CASCADE
);

-- Instructions table
CREATE TABLE instructions (
    instruction_id INT AUTO_INCREMENT PRIMARY KEY,
    recipe_id INT NOT NULL,
    step_description TEXT NOT NULL,
    step_order INT NOT NULL,
    FOREIGN KEY (recipe_id) REFERENCES recipes(recipe_id) ON DELETE CASCADE
);

-- Tags table
CREATE TABLE tags (
    tag_id INT AUTO_INCREMENT PRIMARY KEY,
    tag_name VARCHAR(50) NOT NULL UNIQUE,
    tag_slug VARCHAR(50) NOT NULL UNIQUE
);

-- Recipe_tags junction table
CREATE TABLE recipe_tags (
    recipe_id INT NOT NULL,
    tag_id INT NOT NULL,
    PRIMARY KEY (recipe_id, tag_id),
    FOREIGN KEY (recipe_id) REFERENCES recipes(recipe_id) ON DELETE CASCADE,
    FOREIGN KEY (tag_id) REFERENCES tags(tag_id) ON DELETE CASCADE
);

-- Reviews table
CREATE TABLE reviews (
    review_id INT AUTO_INCREMENT PRIMARY KEY,
    recipe_id INT NOT NULL,
    user_id INT NOT NULL,
    rating INT NOT NULL CHECK (rating BETWEEN 1 AND 5),
    review_text TEXT,
    date_posted TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (recipe_id) REFERENCES recipes(recipe_id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    UNIQUE KEY unique_review (recipe_id, user_id)
);

-- Favorites table
CREATE TABLE favorites (
    user_id INT NOT NULL,
    recipe_id INT NOT NULL,
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (user_id, recipe_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (recipe_id) REFERENCES recipes(recipe_id) ON DELETE CASCADE
);

-- User sessions table
CREATE TABLE sessions (
    session_id VARCHAR(128) NOT NULL PRIMARY KEY,
    user_id INT,
    ip_address VARCHAR(45),
    user_agent TEXT,
    last_activity TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- Create indexes for better performance
CREATE INDEX idx_recipes_category ON recipes(category_id);
CREATE INDEX idx_recipes_difficulty ON recipes(difficulty_id);
CREATE INDEX idx_recipes_user ON recipes(user_id);
CREATE INDEX idx_ingredients_recipe ON ingredients(recipe_id);
CREATE INDEX idx_instructions_recipe ON instructions(recipe_id);
CREATE INDEX idx_reviews_recipe ON reviews(recipe_id);
CREATE INDEX idx_reviews_user ON reviews(user_id);

-- Add fulltext search capability
ALTER TABLE recipes ADD FULLTEXT(title, description);
ALTER TABLE ingredients ADD FULLTEXT(name);