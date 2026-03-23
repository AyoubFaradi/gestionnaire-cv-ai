#!/bin/bash

# Gestionnaire Intelligent de CV - Setup Script
# This script helps set up the project for development

set -e

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

echo -e "${GREEN}🚀 Setting up Gestionnaire Intelligent de CV${NC}"
echo ""

# Check if .env exists
if [ ! -f .env ]; then
    echo -e "${YELLOW}📋 Creating .env file from .env.example...${NC}"
    cp .env.example .env
    echo -e "${GREEN}✅ .env created${NC}"
else
    echo -e "${YELLOW}ℹ️  .env already exists${NC}"
fi

# Check if Docker is available
if command -v docker-compose &> /dev/null; then
    echo -e "${GREEN}✅ Docker Compose found${NC}"
    echo ""
    echo -e "${YELLOW}Starting services with Docker Compose...${NC}"
    docker-compose up --build -d
    echo -e "${GREEN}✅ Services started${NC}"

    echo ""
    echo -e "${YELLOW}Running migrations...${NC}"
    docker-compose exec app php artisan migrate --force
    echo -e "${GREEN}✅ Migrations completed${NC}"

    echo ""
    echo -e "${YELLOW}Seeding database...${NC}"
    docker-compose exec app php artisan db:seed
    echo -e "${GREEN}✅ Database seeded${NC}"

    echo ""
    echo -e "${GREEN}✅ Setup complete with Docker!${NC}"
    echo -e "${GREEN}Access your application at: http://localhost${NC}"
else
    echo -e "${RED}❌ Docker Compose not found${NC}"
    echo ""
    echo -e "${YELLOW}Setting up for local development...${NC}"

    # Check PHP version
    if command -v php &> /dev/null; then
        php_version=$(php -v | head -n 1)
        echo -e "${GREEN}✅ Found: $php_version${NC}"
    else
        echo -e "${RED}❌ PHP not found. Please install PHP 8.2+${NC}"
        exit 1
    fi

    # Install Composer dependencies
    echo -e "${YELLOW}Installing Composer dependencies...${NC}"
    composer install
    echo -e "${GREEN}✅ Dependencies installed${NC}"

    # Generate app key
    echo -e "${YELLOW}Generating application key...${NC}"
    php artisan key:generate
    echo -e "${GREEN}✅ Application key generated${NC}"

    # Run migrations
    echo -e "${YELLOW}Running migrations...${NC}"
    php artisan migrate
    echo -e "${GREEN}✅ Migrations completed${NC}"

    # Seed database
    echo -e "${YELLOW}Seeding database...${NC}"
    php artisan db:seed
    echo -e "${GREEN}✅ Database seeded${NC}"

    echo ""
    echo -e "${GREEN}✅ Setup complete!${NC}"
    echo -e "${YELLOW}Start the development server with:${NC}"
    echo -e "${GREEN}php artisan serve${NC}"
fi

echo ""
echo -e "${GREEN}📝 Test credentials:${NC}"
echo -e "   Email: jean.dupont@example.com"
echo -e "   Password: password123"
echo ""
