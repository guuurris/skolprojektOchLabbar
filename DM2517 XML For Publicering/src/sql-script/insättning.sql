
#Stoppar in rätt där kategorin är Kött
INSERT INTO `Food`(`name`, `difficulty`, `cookingTime`, `description`, `xprocedure`, `category_id`, `added`) 
		SELECT 'Taco',3,45,'voff?','inte där', id , CURRENT_TIMESTAMP
		FROM Category WHERE name='Kött';
		
INSERT INTO `Ingredient`( `name`, `quanity`, `measureUnit`, `food_id`)
			SELECT 'mat', 3, 'dl' , 2 , id FROM Food WHERE name='Taco';
		
		
	   VALUES ('mjau',3,45,'voff?','inte där','2',CURRENT_TIMESTAMP)
