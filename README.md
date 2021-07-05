# Jela-Svijeta
This API lets you search the different meals and dishes.
You can filter the results by choosing multiple tags or one category associated with certain meals.
You can also choose which data you want to be shown. You can choose if you want to see ingredients, category or tags or some combination of those.

# Run the app
Migrate and seed the database.
Then run the app.

# Sending the request
Here is an example of a GET request to this api:
/api?lang=en&category=1&tags=1,4&with=category,ingredients,tags

This means that you want to get meals in english language that have category_id 1 and two tags with ids 1 and 4. "With" parameter specifies which data you want in your response along with title,description and id.

Parameters:
lang - language en/hrv/ita/deu - required
category - category id - 1/2/3 - optional
tags - tags ids - 1 - 8 - optional
with - category/tags/ingredients - optional
