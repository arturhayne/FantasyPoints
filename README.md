# Fantasy Points
 - This is a script Parsing a json file with NFL players projections from an event game. 
 - This script generates another json file scoring and sorting descending players in his team by his "FantasyPoints" in the match.
 - The json file generate obey the following structure:
 ```
Events
	<Event Details>
	Teams:
		<Team Details>
			Players:
				<Player Details>
				Projections:
					<Player Projections>
				<Player Details>
				Projections:
					<Player Projections>
				...
		<Team Details>
			Players:
				<Player Details>
				Projections:
					<Player Projections>
				<Player Details>
				Projections:
					<Player Projections>
				...
	...
 ```			
Fantasy pointins is calculating accoring follwoing scoring Guidelines:

 ```
Scoring Guidelines
Passing Yards: +0.04
Passing Touchdowns: +4.00
Rushing Yards: +0.10
Rushing Touchdowns: +6.00
Receptions: +1.00
Receiving Yards: +0.10
Receiving Touchdowns: +6.00
 ```
Source json file comes with different variable names that is translated in the target file according following dictionary:
 ```		
Stat Translation Dictionary
pas_att : PassingAttempts
pas_cmp : PassingCompletions
pas_tds : PassingTouchdowns
pas_yds : PassingYards
rus_att : RushingAttempts
rus_tds : RushingTouchdowns
rus_yds : RushingYards
rec_rec : Receptions
rec_tds : ReceivingTouchdowns
rec_yds : ReceivingYards
```
 
 ## How to Run 
 1. docker-compose up -d
 2. docker-compose exec web bash
 3. composer install (inside container)
 4. php index (inside container) 
   - Using this command 
        - Default source file is events.json
        - Default target file is result.json
   - You can specify a source and target file using the path like:
        - php index.php source.json target.json 
   - Outside Container: docker run --rm -it --volume %cd%:/app php bash -c "cd app/; php index.php"
       
   
 ### Run tests
 - docker run --rm -it --volume %cd%:/app php bash -c "cd app/; php vendor/bin/phpunit" 
 
 ```
PHPUnit 9.5.10 by Sebastian Bergmann and contributors.

Events (Tests\Events)
 ✔ It should create games from json

Player (Tests\Player)
 ✔ It should return fantasy points according scoring guidelines

Team (Tests\Team)
 ✔ It should sort team players by fantasy points descending

Deprecated: uasort(): Returning bool from comparison function is deprecated, return an integer less than, equal to, or greater than zero in /app/src/Domain/Team.php on line 98

Time: 00:00.054, Memory: 6.00 MB

OK (3 tests, 6 assertions)
```

## Reference
You can check the fantasy points using [Points Calculator](https://simulatedfootball.com/leagues/points-calculator.html) with "BestBall10s" Scoring System.						
