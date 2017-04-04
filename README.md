# Elasticsearch autocomplete

The task is to implement proper autocomplete feature for city field using Elasticsearch as  storage. List of cities is included in the attached CSV file. 
 
In that CSV file, there are two columns: 
1) The name of the city (city column)
2) The total number of occurrences (count column).

The idea is to provide results so that a city with the higher number of occurrences will show up first, following by the second highest number of occurrences, etc. until there are maximum 10 results shown (can be less, if no matches). There should not be duplicate cities, i.e. if one starts typing “new” only one occurrence of “New York” should be displayed.

Additional notes:
It is expected that you install and setup the latest version of Elasticsearch (5.2+) locally, as well as populating an index with city terms
For the interaction with Elasticsearch - Elasticsearch official PHP client must be used (documentation https://www.elastic.co/guide/en/elasticsearch/client/php-api/current/index.html, actual code https://github.com/elastic/elasticsearch-php) 
For autocomplete - completion suggester must be used (https://www.elastic.co/guide/en/elasticsearch/reference/current/search-suggesters-completion.html)
It is allowed to use any library/framework if that helps completing the task successfully etc. (recommendations: Composer and jQuery)

Finally, you should deliver:
The part of code that is responsible for autocomplete feature (HTML, JS, PHP)
The part of code that is indexing city terms into Elasticsearch (PHP)
A short recorded video, showing the functionality (no sound and no more than 2 minutes)

Time to execute this task - 3 days. 
During the technical interview you need to explain the thought 
- process,
- ideas and
- functionality.
