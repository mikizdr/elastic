import sys
reload(sys)
sys.setdefaultencoding('utf8')
from pymongo import MongoClient
from elasticsearch import helpers
from bson import json_util
import json
import elasticsearch
import collections
import ast
# elasticsearch client
es = elasticsearch.Elasticsearch()

# connection to mongoDB
connection = MongoClient()

# getting collection from database
db = connection.cities
coll = db.cities

from pprint import pprint

def insert():
	c = 0
	for i in coll.find():
		break

def get_data(x,random):
    _id = str(x['_id'])
    del x['_id']
    try:
        kk = {
            "name":str(x['city']),
            "name_suggest":{
                "input":str(x['city']),
                "weight":x['count']
            }
        }
    except Exception:
        kk = {
        "name" :"rohit"+str(random),
        "name_suggest" : {
	          "input" : "rohit"+str(random),
	          "weight" : 0
              }
        }
	#b = kk['name_suggest']['input'].split()
	#b.append(kk['name_suggest']['input'])
	#kk['name_suggest']['input'] = b
	#print b



    action = {"_index" : "cities_autocomplete",
          "_type" : "sample_data",
          "_id" : _id,
          "_source": kk
          }
    return action



def get_all_ids():
    object_ids = []
    limit = 50000
    skip = 0
    bulk_op = []
    c = 0
    actions = []
    random = 1000
    for i in coll.find():
        random +=1
        if c%5000 == 0 and not c == 0:
           helpers.bulk(es, actions, chunk_size= 500,request_timeout=100)
           actions = []
           d = get_data(i,random)
           actions.append(d)
           c += 1
        else:
            d = get_data(i,random)
            actions.append(d)
            c += 1
        print (c)
    helpers.bulk(es, actions, chunk_size= 500,request_timeout=100)

if __name__=="__main__":
	get_all_ids()
