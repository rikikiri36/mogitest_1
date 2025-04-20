# coachtechフリマ
---


## 環境構築

### １.Dockerビルド
1. git clone https://github.com/rikikiri36/mogitest_1
2. docker compose up -d --build

### ２.Laravel環境構築
1. srcに移動してcomposer installを実行
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
6. mkdir -p storage/app/public/images/items
7. https://docs.google.com/spreadsheets/d/1x7wLGoMWcLpIAZPfdQYFAsd5p2vb9eY2_bTFU2pWEpI/edit?gid=1952069169#gid=1952069169
　　↑ここから商品画像をDLして６のパスに保存する
8. php artisan storage:link


※テストを実施する際はsrc上で docker compose exec php php artisan test   を実行する



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
