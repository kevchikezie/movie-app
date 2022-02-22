## Movie App

### Set up

- Clone project from the GitHub repository
```
git clone git@github.com:kevchikezie/movie-app.git
```
- Create a .env file from .env.example
```
cp .env.example .env
```

### To run the project

- Run the sail up command. Before you do this, ensure you have Docker running 
on the background. Then run;
```
./vendor/bin/sail up
```

- Migrate the available tables
```
./vendor/bin/sail artisan migrate
```

- The project should be running on port `8084` as stated in the .env file. So to 
access the homepage run;
```
localhost:8084
```

- Next step is to seed the database by calling an endpoint that will fetch the 
needed data from SWAPI.

```
localhost:8084/swapi
```

