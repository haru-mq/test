#!/bin/bash

echo "デプロイを開始します..."

# Composer依存関係のインストール
docker-compose exec app composer install --no-dev --optimize-autoloader

# npm依存関係のインストール
docker-compose exec app npm install

# Viteビルド
docker-compose exec app npm run build

# キャッシュクリア
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan view:clear

# 最適化
docker-compose exec app php artisan config:cache
docker-compose exec app php artisan route:cache
docker-compose exec app php artisan view:cache

echo "デプロイが完了しました"
