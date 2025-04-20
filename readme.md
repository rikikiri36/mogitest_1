# coachtechフリマ
---


## 環境構築

### １.Dockerビルド
1. git clone https://github.com/rikikiri36/mogitest_1
2. docker compose up -d --build

### ２.Laravel環境構築
1. composer install
2. 「.env.example」をコピーして「.env」ファイルを作成し、下記環境変数の変更・stripeのAPIキーを入力する
  - DB_HOST=mysql
  - DB_DATABASE=laravel_db
  - DB_USERNAME=laravel_user
  - DB_PASSWORD=laravel_pass
  - STRIPE_KEY=pk_test_XXXXXXX
  - STRIPE_SECRET=sk_test_XXXXXX
3. php artisan key:generate
4. php artisan migrate:fresh
5. php artisan db:seed

## 使用技術

- PHP 8.4.1
- Laravel Framework 8.83.29
- MySQL 8.0.41
- Docker 27.5.1
- Stripe 17.1.1

## URL

1. 開発環境
   http://localhost/
2. phpMyAdmin
   http://localhost:8080/
