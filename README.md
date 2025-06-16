## river

river の API サーバーのリポジトリです。
user 情報等の API を提供します。

## 環境

- 言語：PHP8.2
- フレームワーク：Laravel 10

## 環境構築

下記の流れに従って、環境構築を行なってください。

#### clone

```
git clone git@github.com:NarumiNaito/river-api-server.git
```

#### .env「.env.example をコピーし.env にリネームして下さい.」

```
cp .env.example .env
```

#### build

```
docker compose build
```

#### コンテナ作成

```
docker compose up -d
```

#### コンテナへの接続

```
docker compose exec -it app bin/bash
```
