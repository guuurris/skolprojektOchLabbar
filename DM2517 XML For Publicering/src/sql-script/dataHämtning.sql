#Välj senaste upplagda food (DESC på timestamp fältet) som tillhör ett antal olika Category som angivna user prenemurerar på: 
SELECT Food.id as identifier, 
	   Food.name as food_name,
	   difficulty,
	   cookingTime,
	   description,
	   xprocedure,
	   urlToImage,
	   added
FROM Food 
INNER JOIN Category ON Food.category_id=Category.id
INNER JOIN CategorySubscription ON Category.id=CategorySubscription.category_id 
WHERE user_id='u1sk2ewj'
ORDER BY added DESC;


#Välj maträtt som tillhör en bestämd kategori, viss svårighet, har bild/eller inte och har en maximal tillagningstid


#Välj alla kategorier som finns tillgängliga
SELECT name FROM Category;
#Välj alla ingredienser som finns tillgänglia


#Välj alla ingredienser som tillhör en viss maträtt baserad på maträttens id
SELECT name, quanity, measureUnit FROM Ingredient WHERE food_id=1;

#Hämta de senaste x antal Food (recept) 
SELECT name, difficulty, cookingTime, description, xprocedure, urlToImage, added FROM Food ORDER BY added DESC LIMIT 10;

#Lägga till en maträtt utan bild
INSERT INTO `Food`(`name`, `difficulty`, `cookingTime`, `description`, `xprocedure`, `category_id`, `added`) VALUES ('mjau',3,45,'voff?','inte där','2',CURRENT_TIMESTAMP)

#Välj maträtter efter användarens kriterier sortera efter hur många ingredienser som överenstämde, 
#åtminstone en vald ingrediens ska finnas i receptet
SELECT COUNT(*) as hits , Food.id ,Food.name,  Food.difficulty, Food.cookingTime, description, urlToImage, added, portions, portionType
FROM `Food` INNER JOIN Category ON Category.id=category_id LEFT JOIN Ingredient ON Food.id=Ingredient.food_id
WHERE Category.name='Fish' AND difficulty='3' AND cookingTime<='45' AND (Ingredient.name='Fisk' OR Ingredient.name='Salsa')
GROUP BY Food.id
ORDER BY hits DESC

#Sätt in  alla kategorier som användaren vill prenumererar på
INSERT INTO `CategorySubscription`(`category_id`, `user_id`) SELECT id , 'u1sk2ewj' FROM Category WHERE name IN ('Kyckling','Vilt') 
AND  id NOT IN (SELECT category_id FROM CategorySubscription WHERE user_id='u1sk2ewj' )



#Tar bort alla prenumerationer som inte finns med i listan 
DELETE FROM `CategorySubscription` WHERE user_id=(select id FROM User WHERE id='u1sk2ewj') 
AND category_id NOT IN (SELECT id FROM Category WHERE name IN ('Kyckling','Vilt'))
