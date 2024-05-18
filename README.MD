# Parent Backend Assessement Task

You can find the code in the following folder:
- Modules/UsersModule
- Plugins/FilesReader
- config/json.php

You can add you own json files at the following path [storage/app/DataProvides] or copy files from [demo/DataProvides]

## Features

- :white_check_mark: API docs.
- :white_check_mark: Docker.
- :white_check_mark: Unit tests.



## Installation

```bash
- git clone git@github.com:kemox5/parent-task.git
- cd parent-task
- cp .env.example .env #update db password
- docker compose up -d
- docker exec json-reader-app bash ./setup.bash
```

## Usage
- See Api docs http://localhost/docs/api


## Testing
```bash
- php artisan test
```
