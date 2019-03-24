BattleFight
========================

* Create random army form available units
* Run fight simulations between two armies

---

### Install

 - clone project 
 - cd <project_root> && run ´$ composer install´

### Run app 

- cd <project_root>/public && run ´php -S localhost:8000´
- open browser and go to ´http://localhost:8000´

### Run Tests

##### Run unit tests:

All tests 
run command ´$ composer unit´

Filter tests 
run command ´$ composer uf <FILTER>´

##### PhpStan

run command ´$ composer stan´

---

#### Whats next

Roadmap:

  * optimize fight simulation
  * standardize method and class names 
  * write missing tests
  * add feature and integration tests ( refactor test structure )
  * add config loader 
  * create weapons, armor, units, battlefields ... from config
  * add DIC
  * add templating engine and refactor
  * add hooks for battle modifiers
  * add getenv
  * add infrastructure for presisting battle results in database||filesistem
  * refactor and create package
