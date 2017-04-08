Step 1. Run this command in the cmd prompt "mongoimport -d cities -c cities --type csv --file cities.csv --headerline"


Step 2. Put in the mappings and settings using sense.


Step 3. Run the python script for indexing "python cities_autocomplete.py"


Step 4. Run the autocomplete query in sense.


Settings for step 2.
PUT /cities_autocomplete
{
   "settings": {
      "index": {
         "number_of_shards": "6",
         "number_of_replicas": "1"
      }
   }
}

Mappings for step 2.
PUT /cities_autocomplete/sample_data/_mapping
{
   "sample_data": {
      "properties": {
         "name_suggest": {
            "max_input_length": 200,
            "analyzer": "standard",
            "preserve_position_increments": true,
            "type": "completion",
            "preserve_separators": true
         },
         "name": {
            "type": "string"
         }
      }
   }
}

Query for step 4.
GET /cities_autocomplete/_search
{
    "suggest": {
        "name_suggest" : {
            "prefix" : "New D"
            "completion" : {
                "field" : "name_suggest",
                "size": 10
            }
        }
    }
}
