/*//MongoDB
-document: objects, collection: group of documents, database: group of collections

//Installing
-MongoDbcompass
-Mongoshell
-add mongosh in Environment variables
-install mongodb in vscode, click to connect in extensions tab
-right click and "launch mongodb shell"
-now we can use 'mongosh' to start mongodb

//databases
-show dbs
-use name_database
-db.createCollection("")
-db.dropDatabase()
-we can use mongodbcompass for it

//inserting
-one document: db.name_collection.insertOne({})
-more documents: db.name_collection.insertMany([{},{}])
-finding: db.name_collection.find()
-we can use mongodbcompass for it

//Data type
-String, number, boolean, ObjectId, date, array, embedded document, null, regular expression, binary data

//Sorting and limiting
-db.name_collection.find().sort({})
-db.name_collection.find().limit()
-Can do the same in "more options" in mongodbcompass

//find
-db.name_collection.find({filter})
-db.name_collection.find({filter, another_filter_for_field})
-db.name_collection.find({}, {name:true, _id: false})

//update
-db.students.updateOne({ex: id}, {$set:{ ex: fied_name: false}})

//delete
-Before deleting: export collection first
-db.name_collection.deleteOne({parameter})
-db.name_collection.deleteMany({parameter})
-to add backup in our file: compass, add data, 

//comparison operators
-not equal: db.collection_name.find({name:{$ne: "name_here"}})
-last then: db.collection_name.find({age:{$lt:27}})
-last then or equal: db.collection_name.find({age:{$lte:27}})
-greater then: db.collection_name.find({age:{$gt:27}}})
-greater then or equal: db.collection_name.find({age:{$gte:27}}})
-greater then or equal AND less then and equal: db.collection_name.find({age:{$gte:27, $lte:40}}})
-verify values in: db.name_collection.find({name:{$in: [value1, value2, value3]}})
-verify values not in: db.name_collection.find({name:{$nin: [value1, value2, value3]}})

//logical operators
-find{$and: [{},{}]}
-find{$or: [{},{}]}
-find{$nor: [{},{}]}
-find{age:{$not:{$condition: 30}}}

//Indexes
-data structures that help improve the performance of queries by enabling faster data retrieval
-db.collection_name.createIndex({name:1}) 
-db.collection_name.getIndexes()
-db.collection_name.dropIndex("name_1")

//collections
-show collections
-db.createCollection('teachers', {capped:true, size:10000000, max:100}, {autoIndexId: false})
-db.collection_name.drop()
 */
