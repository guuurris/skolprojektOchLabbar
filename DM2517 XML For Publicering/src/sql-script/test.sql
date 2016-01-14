SELECT ( SELECT 
name FROM Ingredient AS 'name',
measureUnit FROM Ingredient AS 'quantity/@measureUnit',
quantity FROM Ingredient AS 'quantity'
FOR
XML PATH('ingredient'),
TYPE
),
( SELECT
name FROM Food AS 'name',
difficulty FROM Food AS 'difficulty',
cookingTime FROM Food AS 'cookingTime',
description FROM Food AS 'description',
procedure FROM Food AS 'procedure',
urlToImage FROM Food AS 'image',
FOR
XML PATH('food'),
TYPE
),
( SELECT
name FROM Category AS 'name',
FOR
XML PATH('category'),
TYPE
)
FOR XML PATH('')
ROOT('xrecipe')
GO