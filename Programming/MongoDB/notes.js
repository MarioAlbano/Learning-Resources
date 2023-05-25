/*//MongoDB
-Banco de dados não estruturado
-Flexibilidade, escalabilidade horizontal, performance
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
 */
