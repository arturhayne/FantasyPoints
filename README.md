# Fantasy Points
This is a script to parse an attached projections json file, doing for each event in the file the following:

 1. Organize the data according to the heirarchy diagram below
 2. Score each player with the given scoring system and assign them a "FantasyPoints" projection with the value. 
 Change the display name for the stats to a formatted version of the represented stat
 3. Sort the players in each team by FantasyPoints descending

Output should be saved as a JSON file hierarchically organized as follows:


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
## Reference
You can check the fantasy points using [Points Calculator](https://simulatedfootball.com/leagues/points-calculator.html) with "BestBall10s" Scoring System.

 
 ## How to Run 
 1. docker-compose up -d
 2. docker run --rm -it --volume %cd%:/app php bash -c "cd app/; php index.php"
   - Using this command 
        - Default source file is events.json
        - Default target file is result.json
   - You can specify a source and target file using the path like:
        - docker run --rm -it --volume %cd%:/app php bash -c "cd app/; php index.php source.json target.json"   
   
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
