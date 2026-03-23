.PHONY: help setup install serve test lint analyze security clean build deploy

# Variables
DOCKER_COMPOSE := docker-compose
PHP := $(DOCKER_COMPOSE) exec -T app php
ARTISAN := $(PHP) artisan

help: ## Show this help message
	@echo "Gestionnaire Intelligent de CV - Commandes utiles"
	@echo "=================================================="
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-20s\033[0m %s\n", $$1, $$2}'

# Setup & Installation
setup: ## Setup initial project avec Docker
	@echo "🚀 Setting up project..."
	@cp .env.example .env 2>/dev/null || true
	@chmod +x setup.sh
	@./setup.sh

install: ## Install dependencies (Composer + NPM)
	@echo "📦 Installing dependencies..."
	@$(PHP) -d memory_limit=-1 composer install
	@npm install

dev: ## Start development server
	@echo "🟢 Starting development server..."
	@$(DOCKER_COMPOSE) up -d
	@echo "✅ Development server started"
	@echo "   URL: http://localhost"

# Testing & Quality
test: ## Run tests
	@echo "🧪 Running tests..."
	@$(ARTISAN) test

test-coverage: ## Run tests with coverage report
	@echo "📊 Running tests with coverage..."
	@vendor/bin/phpunit --coverage-text --coverage-html=coverage

lint: ## Check code style
	@echo "🎨 Checking code style..."
	@vendor/bin/php-cs-fixer fix --dry-run --diff

lint-fix: ## Fix code style
	@echo "🎨 Fixing code style..."
	@vendor/bin/php-cs-fixer fix

analyze: ## Run static analysis
	@echo "🔍 Running static analysis..."
	@vendor/bin/phpstan analyse

security: ## Check security vulnerabilities
	@echo "🔒 Checking security..."
	@vendor/bin/security-checker security:check

ci: test lint analyze security ## Run all checks (CI pipeline)
	@echo "✅ All checks passed!"

# Database
migrate: ## Run database migrations
	@echo "📊 Running migrations..."
	@$(ARTISAN) migrate --force

migrate-fresh: ## Reset database and run migrations
	@echo "🔄 Refreshing database..."
	@$(ARTISAN) migrate:fresh --force

seed: ## Seed database
	@echo "🌱 Seeding database..."
	@$(ARTISAN) db:seed

fresh: migrate-fresh seed ## Reset and seed database
	@echo "✅ Database refreshed!"

# Logs & Debug
logs: ## Show application logs
	@$(DOCKER_COMPOSE) logs -f app

logs-nginx: ## Show Nginx logs
	@$(DOCKER_COMPOSE) logs -f nginx

logs-db: ## Show Database logs
	@$(DOCKER_COMPOSE) logs -f db

logs-all: ## Show all logs
	@$(DOCKER_COMPOSE) logs -f

# Cache & Commands
cache-clear: ## Clear all cache
	@echo "🧹 Clearing cache..."
	@$(ARTISAN) cache:clear
	@$(ARTISAN) config:clear
	@$(ARTISAN) view:clear
	@$(ARTISAN) route:clear
	@echo "✅ Cache cleared!"

tinker: ## Open Tinker shell
	@$(ARTISAN) tinker

# Docker
docker-build: ## Build Docker images
	@echo "🐳 Building Docker images..."
	@$(DOCKER_COMPOSE) build

docker-up: ## Start Docker containers
	@echo "🟢 Starting Docker containers..."
	@$(DOCKER_COMPOSE) up -d

docker-down: ## Stop Docker containers
	@echo "🔴 Stopping Docker containers..."
	@$(DOCKER_COMPOSE) down

docker-clean: ## Remove all Docker containers, volumes and networks
	@echo "🗑️  Cleaning Docker..."
	@$(DOCKER_COMPOSE) down -v

docker-shell: ## Open shell in app container
	@$(DOCKER_COMPOSE) exec app sh

docker-root: ## Open shell as root in app container
	@$(DOCKER_COMPOSE) exec -u root app sh

# Production
build: ## Build production assets
	@echo "🔨 Building production assets..."
	@npm run build

optimize: ## Optimize application for production
	@echo "⚡ Optimizing for production..."
	@$(ARTISAN) config:cache
	@$(ARTISAN) route:cache
	@$(ARTISAN) view:cache
	@$(ARTISAN) event:cache
	@echo "✅ Optimization complete!"

deploy: ## Deploy to production (see DEPLOYMENT.md)
	@echo "🚀 Starting deployment..."
	@echo "ℹ️  See DEPLOYMENT.md for instructions"

# Cleaning
clean: ## Clean up generated files
	@echo "🧹 Cleaning..."
	@rm -rf storage/logs/*
	@rm -rf bootstrap/cache/*
	@rm -rf coverage/*
	@echo "✅ Cleaned!"

clear-all: clean cache-clear ## Complete cleanup
	@echo "✅ Complete cleanup done!"

# Shortcuts
s: setup ## Alias for setup
i: install ## Alias for install
t: test ## Alias for test
l: lint ## Alias for lint
a: analyze ## Alias for analyze
c: cache-clear ## Alias for cache-clear
d: docker-down ## Alias for docker-down
u: docker-up ## Alias for docker-up
